<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\FunctionType;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();
        return view('admin.all-customers', ['customers'=>$customers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create-customer');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'bill_nulber'=>['nullable'],
            'function_type_id'=>['required'],
            'name'=>['required'],
            'address'=>['required'],
            'mob_no1'=>['required'],
            'mob_no2'=>['nullable'],
            'wedding_date'=>['nullable'],
            'wedding_location'=>['nullable'],
            'home_com_date'=>['nullable'],
            'home_com_location'=>['nullable'],

            // 'event_type'=>['nullable'],

            'event_date'=>['nullable'],
            'event_location'=>['nullable'],
            'photo_shoot_date'=>['nullable'],
            'photo_shoot_location'=>['nullable'],
            'total_payment'=>['nullable'],
            'discount'=>['nullable'],
            'advance_payment'=>['nullable'],
        ]);

        $function_type = FunctionType::find($request->function_type_id);
        $customer = $function_type->customers()->create($validated);
        return redirect()->route('customer.show', $customer);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::find($id);
        return view('admin.customer-profile', ['customer'=>$customer]);
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
