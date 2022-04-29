<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\FunctionType;
use App\Models\Item;
use App\Models\Package;
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
        $ids = [];
        foreach($customer->items as $item){
            array_push($ids, $item->id);
        }
        $items = Item::where('function_type_id', '=', $customer->function_type_id)->whereNotIn('id', $ids)->get();

        $ids = [];
        foreach($customer->packages as $package){
            array_push($ids, $package->id);
        }
        $packages = Package::where('function_type_id', '=', $customer->function_type_id)->whereNotIn('id', $ids)->get();
        $notes = $customer->notes;

        return view('admin.customer-profile', ['customer'=>$customer, 'items'=>$items, 'packages'=>$packages, 'notes'=>$notes]);
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

    public function item_detach(Request $request, $id) {
        $request->validate([
            'detach_items'=>'required',
        ]);
        $customer = Customer::find($id);
        $customer->items()->detach($request->detach_items);

        $total_item_price = 0;
        if ($customer->total_item_price != NULL) {
            $total_item_price = $customer->total_item_price;
        }
        
        foreach ($request->detach_items as $detach_items) {
            $item = Item::find($detach_items);
            $total_item_price = $total_item_price - $item->item_price;
        }
        $r = $customer->update([
            'total_item_price'=>$total_item_price,
        ]);

        return back();
    }

    public function item_attach(Request $request, $id) {
        $request->validate([
            'attach_items'=>'required',
        ]);
        $customer = Customer::find($id);
        $customer->items()->attach($request->attach_items);

        $total_item_price = 0;
        if ($customer->total_item_price != NULL) {
            $total_item_price = $customer->total_item_price;
        }

        foreach ($request->attach_items as $attach_items) {
            $item = Item::find($attach_items);
            $total_item_price = $total_item_price + $item->item_price;
        }
        $r = $customer->update([
            'total_item_price'=>$total_item_price,
        ]);
        
        return back();
    }


    public function package_detach(Request $request, $id) {
        $request->validate([
            'detach_packages'=>'required',
        ]);
        $customer = Customer::find($id);
        $customer->packages()->detach($request->detach_packages);

        $total_package_price = 0;
        if ($customer->total_package_price != NULL) {
            $total_package_price = $customer->total_package_price;
        }
        
        foreach ($request->detach_packages as $detach_packages) {
            $package = Package::find($detach_packages);
            $total_package_price = $total_package_price - $package->package_price;
        }
        $r = $customer->update([
            'total_package_price'=>$total_package_price,
        ]);

        return back();
    }

    public function package_attach(Request $request, $id) {
        $request->validate([
            'attach_packages'=>'required',
        ]);
        $customer = Customer::find($id);
        $customer->packages()->attach($request->attach_packages);

        $total_package_price = 0;
        if ($customer->total_package_price != NULL) {
            $total_package_price = $customer->total_package_price;
        }

        foreach ($request->attach_packages as $attach_packages) {
            $package = Package::find($attach_packages);
            $total_package_price = $total_package_price + $package->package_price;
        }
        $r = $customer->update([
            'total_package_price'=>$total_package_price,
        ]);
        
        return back();
    }

}
