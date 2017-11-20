<?php

namespace App\Http\Controllers;

use App\models\Queue;
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

        return view('pages.queues.addinvoice',array(
            'queue' => $queue,
            'medicines' => $medicines
        ));
    }
    public function show()
    {
        //
    }

    /*ajax functions*/

    public function drug_press()
    {
        //return 'ok';
        $drugs = Medicine::findOrFail(request()->drug);
        return response()->json($drugs);
    }
}
