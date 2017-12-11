<?php

namespace App\Http\Controllers;

use App\models\ClinicService;
use App\models\Invoice;
use App\models\Patient;
use App\models\Prescription;
use App\models\Queue;
use App\models\ServiceCategory;
use App\models\UserInformation;
use Illuminate\Http\Request;
use App\models\Medicine;
use Auth;

class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('user_privilage',['except'=>['store','update','add_invoice']]);
    }
    public function index()
    {
        $invoice = Invoice::with('payments','user_informations','patients')
            ->where('entity_id','=',Auth::user()->entity_id)->get();

        //dd($invoice);

        $patients = Patient::with('users')
            ->where('entity_id','=',Auth::user()->entity_id)->get();

        $doctor = UserInformation::with('users')
            ->whereNotNull('doctor_info')
            ->whereHas('users',function ($query){
                $query->where('entity_id','=',Auth::user()->entity_id);
            })->get();


        return view('pages.invoices.ManageInvoice',array(
            'invoices' => $invoice,
            'patients' => $patients,
            'doctors' => $doctor
        ));
    }

    public function add_invoice(Request $request)
    {
        $patient = Patient::findOrFail($request->patient_id);

        $doctor = UserInformation::with('users')->where('user_id','=',$request->doctor_id)->first();

        $medicines = Medicine::where('entity_id','=',Auth::user()->entity_id)->get();

        $services = ServiceCategory::where('entity_id','=',Auth::user()->entity_id)->get();

        return redirect('invoice_add/'.$patient->id.'/'.$doctor->id);

    }

    public function create_invoice($patient_id , $doctor_id)
    {
        $patient = Patient::findOrFail($patient_id);

        $doctor = UserInformation::with('users')->where('id','=',$doctor_id)->first();

        $medicines = Medicine::where('entity_id','=',Auth::user()->entity_id)->get();

        $services = ServiceCategory::where('entity_id','=',Auth::user()->entity_id)->get();

        return view('pages.invoices.createInvoice',array(
            'patients' => $patient,
            'doctor' => $doctor,
            'medicines' => $medicines,
            'services' => $services
        ));
    }

    public function store(Request $request)
    {
        //dd($request->queue_id);
        $request->validate([
            'pres_type' => 'required'
        ]);



        $invoice = new Invoice;
        $invoice->invoice_code = 'PI-'.str_random(4).'-'.str_random(2);
        $invoice->doctor_id = $request->doctor_id;
        $invoice->patient_id = $request->patient_id;
        $invoice->entity_id = Auth::user()->entity_id;
        $invoice->queue_id = $request->queue_id;
        $invoice->net_total = $request->net_total;
        $invoice->total_discount = $request->total_discount;
        $invoice->after_discount = $request->after_discount;
        $invoice->total_gst = $request->total_gst;
        $invoice->grand_total = $request->grand_total;
        $invoice->paid = 0;
        $invoice->balance = $request->grand_total;
        $invoice->invoice_comment = $request->invoice_comment;

        $pres=[];
        for ($i=0; $i < sizeof($request->pres_type); $i++)
        {

            $abc = [
                'drug_id' => $request->drug_id[$i],
                'drug_name' => $request->drug_name[$i],
                'drug_qnt' => $request->drug_qnt[$i],
                'price' => $request->price[$i],
                'sub_total' => $request->sub_total[$i],
                'discount' => $request->discount[$i],
                'remark' => $request->remark[$i],
                'gst' => $request->gst[$i],
                'line_total' => $request->line_total[$i],
                'pres_type' => $request->pres_type[$i],
                'days' => $request->days[$i],
                'instruction' => $request->instruction[$i],
                'dosage_qnt' => $request->dosage_qnt[$i],
                'dosage_unit' => $request->dosage_unit[$i]
            ];

            array_push($pres,$abc);

        }
        $invoice->prescriptions = $pres;

        $invoice->save();

        $prescription = new Prescription;
        $prescription->doctor_id = $request->doctor_id;
        $prescription->patient_id = $request->patient_id;
        $prescription->entity_id = Auth::user()->entity_id;
        $prescription->prescriptions = $pres;

        $prescription->save();

        if($invoice->queue_id !== null) {

            $queue = Queue::findOrFail($invoice->queue_id);
            $queue->status = 2;
            $queue->bill = $request->grand_total;
            $queue->paid = 0;
            $queue->save();
        }

        if ($request->payment == 0)
        {
            return redirect('invoices/'.$invoice->id)
                ->with('message','Successfully Created Invoice');
        }
        else if ($request->payment == 1)
        {
            return redirect('payments/'.$invoice->id)
                ->with('message','Successfully Created Invoice Now Add Payment');
        }
    }

    public function edit($id)
    {

        $invoice = Invoice::with('patients','user_informations','queues')
            ->where('id','=',$id)->first();
        if($invoice->paid ==  $invoice->grand_total)
        {
            return abort(404);
        }
        else{
            $medicines = Medicine::where('entity_id','=',Auth::user()->entity_id)->get();

            $services = ServiceCategory::where('entity_id','=',Auth::user()->entity_id)->get();

            return view('pages.invoices.editInvoice',array(
                'invoice' => $invoice,
                'medicines' => $medicines,
                'services' => $services
            ));
        }



    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'pres_type' => 'required'
        ]);



        $invoice = Invoice::findOrFail($id);

        $invoice->net_total = $request->net_total;
        $invoice->total_discount = $request->total_discount;
        $invoice->after_discount = $request->after_discount;
        $invoice->total_gst = $request->total_gst;
        $invoice->grand_total = $request->grand_total;
        $invoice->paid = 0;
        $invoice->balance = $request->grand_total;
        $invoice->invoice_comment = $request->invoice_comment;

        $pres=[];
        for ($i=0; $i < sizeof($request->pres_type); $i++)
        {

            $abc = [
                'drug_id' => $request->drug_id[$i],
                'drug_name' => $request->drug_name[$i],
                'drug_qnt' => $request->drug_qnt[$i],
                'price' => $request->price[$i],
                'sub_total' => $request->sub_total[$i],
                'discount' => $request->discount[$i],
                'remark' => $request->remark[$i],
                'gst' => $request->gst[$i],
                'line_total' => $request->line_total[$i],
                'pres_type' => $request->pres_type[$i],
                'days' => $request->days[$i],
                'instruction' => $request->instruction[$i],
                'dosage_qnt' => $request->dosage_qnt[$i],
                'dosage_unit' => $request->dosage_unit[$i]
            ];

            array_push($pres,$abc);

        }
        $invoice->prescriptions = $pres;

        $invoice->save();

        $prescription = new Prescription;
        $prescription->doctor_id = $request->doctor_id;
        $prescription->patient_id = $request->patient_id;
        $prescription->entity_id = Auth::user()->entity_id;
        $prescription->prescriptions = $pres;

        $prescription->save();

        if($invoice->queue_id !== null)
        {
            $queue = Queue::findOrFail($invoice->queue_id);
            $queue->status = 2;
            $queue->bill = $request->grand_total;
            $queue->paid = 0;
            $queue->save();
        }


            return redirect('invoices/'.$invoice->id)
                ->with('message','Successfully Edited Invoice');

    }


    public function show($id)
    {


        $invoice = Invoice::with('user_informations','patients')
            ->where('id','=',$id)->first();

        return view('pages.queues.showInvoice',array(
            'invoice' => $invoice,

        ));
    }

    public function drug_press()
    {
        //return 'ok';
        $drugs = Medicine::findOrFail(request()->drug);
        return response()->json($drugs);
    }

    public function service_press()
    {
        //return 'ok';
        $cats = ServiceCategory::with('clinic_services')
            ->where('id','=',request()->category_id)->first();

        return response()->json($cats);
    }

    public function service_price()
    {
        //return 'ok';
        $cats = ClinicService::findOrFail(request()->service_id);

        return response()->json($cats);
    }
}
