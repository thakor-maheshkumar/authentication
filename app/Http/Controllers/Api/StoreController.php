<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store;
use Validator;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $store=Store::orderBy('id','DESC')->get();
        return response()->json(['Store list'=>$store]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->all();
        $validator=Validator::make($data,[
            'category_id'=>'required',
            'business_name'=>'required',
            'head_office_address'=>'required'
        ]);
        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()]);
        }
        $store=Store::create($request->all());
        return response()->json(['success'=>'Store Has been successfully stored']);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data=$request->all();
        $validator=Validator::make($data,[
            'category_id'=>'required',
            'business_name'=>'required',
            'head_office_address'=>'required'
        ]);
        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()]);
        }
        $store=Store::find($request->id);
        $store->category_id=$request->category_id;
        $store->business_name=$request->business_name;
        $store->head_office_address=$request->head_office_address;
        $store->phone_number=$request->phone_number;
        $store->website_address=$request->website_address;
        $store->company_status=$request->company_status;
        $store->contact_information=$request->contact_information;
        $store->date_of_create=$request->date_of_create;
        $store->main_activity=$request->main_activity;
        $store->main_product=$request->main_product;
        $store->main_service=$request->main_service;
        $store->principal_customer=$request->principal_customer;
        $store->business_organization=$request->business_organization;
        $store->number_of_employee=$request->number_of_employee;
        $store->financial_circumstance=$request->financial_circumstance;
        $store->company_capacity=$request->company_capacity;
        $store->reference=$request->reference;
        $store->update();
        return response()->json(['success'=>'Store has been successfully updated']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $storeData=Store::find($id);
        $storeData->delete();
        return response()->json(['success'=>'Store has been successfully deleted']);
    }
}
