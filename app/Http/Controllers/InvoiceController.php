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
use Yajra\DataTables\DataTables;

class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('user_privilage',['except'=>['store','update',
            'add_invoice','service_price','service_press','drug_press','datatable']]);
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

    public function datatable()
    {
        $invoices = Invoice::with('payments','user_informations','patients')
            ->where('entity_id','=',Auth::user()->entity_id)->get();

        return DataTables::of($invoices)
            ->addIndexColumn()
            ->addColumn('patient_name',function ($invoice){
                return $invoice->patients->patient_info['full_name'];
            })
            ->addColumn('users_name',function ($invoice){
                return $invoice->user_informations->users['name'];
            })
            ->addColumn('grand_total',function ($invoice){
                return $invoice->grand_total.'.'.Auth::user()->entities->currency;
            })
            ->addColumn('balance',function ($invoice){
                return '<span style="color:#ac2925">'.$invoice->balance.'.'.Auth::user()->entities->currency.'</span>';
            })
            ->addColumn('paid',function ($invoice){
                return '<span style="color: #2ca02c; ">'.$invoice->paid.'.'.Auth::user()->entities->currency;
            })
            ->addColumn('status',function ($invoice){
                if($invoice->paid < $invoice->grand_total)
                {
                    return 'Unpaid';
                }
                elseif($invoice->paid == $invoice->grand_total)
                {
                    return 'paid';
                }
            })
            ->addColumn('action',function ($invoice){
                if($invoice->paid < $invoice->grand_total)
                {
                    $pays = '<a href="'.url('payments/'.$invoice->id).'"
                       style="font-weight: bold; font-size: 140%;color: #2b4a95"
                       data-toggle="tooltip" data-placement="top" title=""
                       data-original-title="Add Payment"><i class="fa fa-dollar"></i></a>';
                }
                elseif($invoice->paid == $invoice->grand_total)
                {
                    $pays = '<a
                       style="font-weight: bold; font-size: 120%;color: #2abfcc"
                       disabled="disabled"><i class="fa fa-dollar"></i></a>';
                }

                if($invoice->paid !==  $invoice->grand_total && $invoice->user_informations->user_id == Auth::user()->id)
                {
                    $paid = '
                    <a href="'.url('invoices/'.$invoice->id.'/edit').'"
                        style="font-weight: bold; font-size: 120%;color: #2b4a95"
                        data-toggle="tooltip" data-placement="top" title=""
                        data-original-title="Edit Invoice"><i class="fa fa-pencil"></i></a>
                    ';
                }
                else
                {
                    $paid = '<a
                       style="font-weight: bold; font-size: 120%;color: #2abfcc"
                       ><i class="fa fa-pencil"></i></a>';
                }

                $payment_loop = '';
                $i=1;
                foreach($invoice->payments as $payment)
                {
                    $payment_loop.= '
                        <tr>
                            <td>'.$i.'</td>
                            <td>'.$invoice->patients->patient_info['full_name'].'</td>

                            <td>'.$payment->receipt_no.'</td>
                            <td>'.date('d-M-Y',strtotime($payment->created_at)).'</td>

                            <td style="color: green;">'.$payment->paid_amount .'.'.Auth::user()->entities->currency.'</td>

                            <td>

                                <a href="'.url('payments_print/'.$payment->id).'"
                                   class="btn btn-inverse"
                                   target="_blank"
                                   data-toggle="tooltip" data-placement="top" title=""
                                   data-original-title="Print Payment"><i class="fa fa-print"></i></a>

                            </td>
                        </tr>
                    ';
                    $i++;
                }

                return '
                    '.$pays.'

                    &nbsp;

                    <a href="'.url('invoices/'.$invoice->id).'}"
                       style="font-weight: bold; font-size: 120%;color: #2b4a95"
                       data-toggle="tooltip" data-placement="top" title=""
                       data-original-title="Show Invoice"><i class="fa fa-eye"></i></a>
                        &nbsp;

                    '.$paid.'
                        &nbsp;

                        &nbsp;

                    <button
                       style="font-weight: bold; border: none; background: none; font-size: 120%;color: #2b4a95"
                       data-toggle="modal" data-target="#full-width-modal'.$invoice->id.'"><i class="fa fa-list"></i></button>

                    <div id="full-width-modal'.$invoice->id.'" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="full-width-modalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-full">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title" id="full-width-modalLabel">Receipts List</h4>
                                </div>
                                <div class="modal-body">
                                    <table class="table m-t-30">
                                        <thead>
                                        <tr>
                                            <th width="1%">Sr.No</th>
                                            <th width="14%">Patient Name</th>
                                            <th width="14%">Receipt No</th>
                                            <th width="14%">Payment Date</th>
                                            <th width="10%">Paid Amount</th>
                                            <th width="5%">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            '.$payment_loop.'
                                        </tbody>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>

                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                ';
            })
            ->rawColumns(['action','balance','paid'])
            ->make(true);
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
        dd($request->all());
        $request->validate([
            'pres_type' => 'required'
        ]);



        $invoice = new Invoice;
        $invoice->invoice_code = 'PI-'.str_random(4).'-'.str_random(2);
        $invoice->doctor_id = $request->doctor_id;
        $invoice->patient_id = $request->patient_id;
        $invoice->prescription_id = $request->prescription_id;
        $invoice->entity_id = Auth::user()->entity_id;
        $invoice->net_total = $request->net_total;
        $invoice->total_discount = $request->total_discount;
        $invoice->after_discount = $request->after_discount;
        $invoice->total_gst = $request->total_gst;
        $invoice->grand_total = $request->grand_total;
        $invoice->paid = $request->paid;
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

        if($invoice->queue_id !== null) {

            $queue = Queue::findOrFail($request->queue_id);
            $queue->status = 3;
            $queue->bill = $request->grand_total;
            $queue->paid = $request->paid;
            $queue->save();
        }


        return redirect('invoices/'.$invoice->id)
            ->with('message','Successfully Created Invoice');

    }

    public function edit($id)
    {
        $prescriptions = Prescription::with('patients','patients')
            ->where('id','=',$id)->first();

        $queue = Queue::where('queue_code','=',$prescriptions->queue_code)->first();

        $queue->status = 1;
        $queue->save();

        $medicines = Medicine::where('entity_id','=',Auth::user()->entity_id)->get();

        $services = ServiceCategory::where('entity_id','=',Auth::user()->entity_id)->get();

        return view('pages.invoices.addinvoice',array(
            'prescriptions' => $prescriptions,
            'medicines' => $medicines,
            'services' => $services,
            'queue' => $queue
        ));
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
