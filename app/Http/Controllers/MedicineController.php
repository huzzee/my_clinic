<?php

namespace App\Http\Controllers;

use App\models\Adjustment;
use App\models\Medicine;
use Illuminate\Http\Request;
use App\models\UserInformation;
use App\models\Entity;
use App\User;
use Illuminate\Support\Facades\DB;
use Auth;
use App\models\DrugCategory;
use App\models\DrugStockUnit;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $drugs = Medicine::where('entity_id','=',Auth::user()->entity_id)->get();

        return view('pages.drugs.manageDrug',array(
            'drugs' => $drugs,
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $drugUnit = DrugStockUnit::where('entity_id','=',Auth::user()->entity_id)->get();
        $drugType = DrugCategory::where('entity_id','=',Auth::user()->entity_id)->get();

        return view('pages.drugs.createDrug',array(
            'drugUnits' => $drugUnit,
            'drugTypes' => $drugType
        ));
    }


    public function drugCategory()
    {
        $drugType = DrugCategory::where('entity_id','=',Auth::user()->entity_id)->get();

        return view('pages.drugs.drugCategory',array(
            'drugTypes' => $drugType
        ));
    }

    public function drugCategoryStore(Request $request)
    {
        $request->validate([
            'drug_type' => 'required'
        ]);

        $drug = new DrugCategory([
           'category_name' => $request['drug_type'],
           'entity_id' => Auth::user()->entity_id
        ]);

        $drug->save();

        return redirect('drugCategory')->with('message','Successfully Added Type');
    }

    public function drugCategoryDestroy($id)
    {
        $drug = DrugCategory::findOrFail($id);

        $drug->delete();

        return redirect('drugCategory')->with('message','Successfully deleted Type');
    }


    /*Drug Stock handle here*/

    public function drugStock()
    {
        $drugType = DrugStockUnit::where('entity_id','=',Auth::user()->entity_id)->get();

        return view('pages.drugs.drugStock',array(
            'drugTypes' => $drugType
        ));
    }

    public function drugStockStore(Request $request)
    {
        $request->validate([
            'unit_name' => 'required'
        ]);

        $drug = new DrugStockUnit([
            'unit_name' => $request['unit_name'],
            'entity_id' => Auth::user()->entity_id
        ]);

        $drug->save();

        return redirect('drugStock')->with('message','Successfully Added Stock Unit');
    }

    public function drugStockDestroy($id)
    {
        $drug = DrugStockUnit::findOrFail($id);

        $drug->delete();

        return redirect('drugStock')->with('message','Successfully deleted Stock Unit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'drug_name' => 'required',
            'drug_type' => 'required',
            'dosage_unit' => 'required',
            'dosage_amount' => 'required',
            'retail_price' => 'required',
            'stock_unit' => 'required',
            'min_qnt' => 'required'
        ]);

        $upload_dir = base_path() . '/public/uploads';

        if ($request->drug_image !== null)
        {
            $file = $request->file('drug_image');
            $ext = $file->getClientOriginalName();
            $filename = $ext;
            $file->move($upload_dir, $filename);
        }
        else{
            $filename = null;
        }

        if(!$request->has('status'))
        {
            $status = 0;
        }
        else{
            $status = 1;
        }

        $drug = new Medicine;

        $drug->entity_id = Auth::user()->entity_id;
        $drug->medicine_info = [
            'drug_name' => $request['drug_name'],
            'drug_type' => $request['drug_type'],
            'dosage_unit' => $request['dosage_unit'],
            'dosage_amount' => $request['dosage_amount'],
            'purchase_price' => $request['purchase_price'],
            'purchase_gst' => $request['purchase_gst'],
            'retail_price' => $request['retail_price'],
            'retail_gst' => $request['retail_gst'],
            'generic' => $request['generic'],
            'company' => $request['company'],
            'stock_unit' => $request['stock_unit'],
            'min_qnt' => $request['min_qnt'],
            'current_qnt' => 0,
            'used_qnt' => 0,
            'bought_qnt' => 0,
            'precaution' => $request['precaution'],
            'drug_image' => $filename,
            'status' => $status,
            'expiry_date' => null
        ];

        $drug->save();

        return redirect('drugs')->with('message','Drug Successfully Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $drug = Medicine::with('adjustments')->where('id','=',$id)->first();



        return view('pages.drugs.showDrug',array(
            'drug' => $drug
        ));

    }


    public function updateStock(Request $request,$id)
    {
        $drug = Medicine::findOrFail($id);

        if($request->adjust == 0) {
            $drug['medicine_info->bought_qnt'] = $drug->medicine_info['bought_qnt'] + $request->qnt;
            $drug['medicine_info->current_qnt'] = $drug->medicine_info['current_qnt'] + $request->qnt;
            $drug['medicine_info->expiry_date'] = $request->expiry_date;
        }
        else
        {
            $drug['medicine_info->bought_qnt'] = $drug->medicine_info['bought_qnt'] - $request->qnt;
            $drug['medicine_info->current_qnt'] = $drug->medicine_info['current_qnt'] - $request->qnt;
            $drug['medicine_info->expiry_date'] = $request->expiry_date;
        }

        $drug->save();

        $adjustment = new Adjustment;
        $adjustment->medicine_id = $id;
        $adjustment->user_id = Auth::user()->id;
        if($request->adjust == 0) {
            $adjustment->adjust = 0;
            $adjustment->bought_qnt += $request->qnt;
        }
        else
        {
            $adjustment->adjust = 1;
            $adjustment->bought_qnt -= $request->qnt;
        }
        $adjustment->save();

        return redirect('drugs/'.$id);

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $drug = Medicine::findOrFail($id);
        $drugType = DrugCategory::where('entity_id','=',Auth::user()->entity_id)->pluck('category_name','category_name');
        $drugStock = DrugStockUnit::where('entity_id','=',Auth::user()->entity_id)->pluck('unit_name','unit_name');

        return view('pages.drugs.editDrug',array(
            'drug' => $drug,
            'drugType' => $drugType,
            'drugStock' => $drugStock
        ));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $upload_dir = base_path() . '/public/uploads';

        if ($request->drug_image !== null)
        {
            $file = $request->file('drug_image');
            $ext = $file->getClientOriginalName();
            $filename = $ext;
            $file->move($upload_dir, $filename);
        }
        else{
            $filename = null;
        }

        if(!$request->has('status'))
        {
            $status = 0;
        }
        else{
            $status = 1;
        }

        $drug = Medicine::findOrFail($id);

        $drug['medicine_info->drug_name'] = $request->medicine_info['drug_name'];
        $drug['medicine_info->drug_type'] = $request->medicine_info['drug_type'];
        $drug['medicine_info->dosage_unit'] = $request->medicine_info['dosage_unit'];
        $drug['medicine_info->dosage_amount'] = $request->medicine_info['dosage_amount'];
        $drug['medicine_info->purchase_price'] = $request->medicine_info['purchase_price'];
        $drug['medicine_info->purchase_gst'] = $request->medicine_info['purchase_gst'];
        $drug['medicine_info->retail_price'] = $request->medicine_info['retail_price'];
        $drug['medicine_info->retail_gst'] = $request->medicine_info['retail_gst'];
        $drug['medicine_info->generic'] = $request->medicine_info['generic'];
        $drug['medicine_info->company'] = $request->medicine_info['company'];
        $drug['medicine_info->stock_unit'] = $request->medicine_info['stock_unit'];
        $drug['medicine_info->min_qnt'] = $request->medicine_info['min_qnt'];
        $drug['medicine_info->precaution'] = $request->medicine_info['precaution'];
        $drug['medicine_info->drug_image'] = $filename;
        $drug['medicine_info->status'] = $status;

        $drug->save();

        return redirect('drugs')->with('message','Drug Successfully Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $drug = Medicine::findOrFail($id);
        $drug->delete();
        return redirect('drugs')->with('message','Drug Successfully Added');
    }
}
