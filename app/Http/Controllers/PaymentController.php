<?php

namespace App\Http\Controllers;

use App\models\Invoice;
use App\models\Payment;
use App\models\Queue;
use App\models\ServiceCategory;
use Illuminate\Http\Request;
use App\models\Medicine;
use Auth;



class PaymentController extends Controller
{
    public function edit($id)
    {

        $queue = Queue::with('patients','user_informations')
            ->where('id','=',$id)->first();

        $queue->status = 1;
        $queue->save();

        $medicines = Medicine::where('entity_id','=',Auth::user()->entity_id)->get();

        $services = ServiceCategory::where('entity_id','=',Auth::user()->entity_id)->get();

        return view('pages.queues.addinvoice',array(
            'queue' => $queue,
            'medicines' => $medicines,
            'services' => $services
        ));
    }
    public function show($id)
    {
        $invoice = Invoice::with('user_informations','patients')
            ->where('id','=',$id)->first();

        return view('pages.payments.addPayments',array(
            'invoice' => $invoice
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'payment_cash' => 'required|min:1'
        ]);



        $invoice = Invoice::findOrFail($request->invoice_id);
        $invoice->paid = $invoice->paid + $request->payment_cash;
        $invoice->balance = $invoice->grand_total - $invoice->paid;
        $invoice->save();




        $payment = new Payment;
        $payment->receipt_no = 'RC-'.str_random(4).'-'.str_random(2);
        $payment->doctor_id = $request->doctor_id;
        $payment->invoice_id = $request->invoice_id;
        $payment->entity_id = Auth::user()->entity_id;
        $payment->paid_amount = $request->payment_cash;
        $payment->prescriptions = $invoice->prescriptions;
        $payment->save();

        if ($request->blnc == $request->paid)
        {

            for ($i = 0; $i < sizeof($payment->prescriptions); $i++) {
                if ($payment->prescriptions[$i]['pres_type'] == 0) {
                    $drug = Medicine::findOrFail($payment->prescriptions[$i]['drug_id']);
                    $drug['medicine_info->used_qnt'] = $drug->medicine_info['used_qnt'] + $payment->prescriptions[$i]['drug_qnt'];
                    $drug['medicine_info->current_qnt'] = $drug->medicine_info['current_qnt'] - $payment->prescriptions[$i]['drug_qnt'];
                    $drug->save();
                }
            }


            $queue = Queue::findOrFail($invoice->queues_id);
            $queue->status = 4;
            $queue->save();

            return redirect('invoices/'.$invoice->id)->with('message','Payment Complete');
        }
        elseif ($invoice->balance > 0)
        {
            return redirect('invoices/'.$invoice->id)->with('message2','Payment InComplete');
        }


    }

    /*ajax functions*/


}
