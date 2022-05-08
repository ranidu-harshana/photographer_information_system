<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Customer;
use App\Models\FunctionType;
use App\Models\Item;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        session()->forget('tab0');
        session()->forget('tab1');
        session()->forget('tab2');
        session()->forget('tab3');
        session()->forget('tab4');
        session()->forget('tab5');
        
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
        $branches = Branch::all();
        return view('admin.create-customer', ['branches'=>$branches]);
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
            'bill_nulber'=>['required', 'unique:customers,bill_nulber'],
            'function_type_id'=>['required'],
            'name'=>['required'],
            'address'=>['required'],
            'branch_id'=>['required'],
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
            'preshoot_date'=>['nullable'],
            'preshoot_location'=>['nullable'],
            'total_payment'=>['nullable'],
            'discount'=>['nullable'],
            'advance_payment'=>['nullable'],
        ]);

        $validated['bill_nulber'] = sprintf('%05d', $request->bill_nulber);
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
    public function show($id) {
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

        $customers = DB::table('customer_package_items')->where('customer_id', '=', $id)->get();
        $arr = [];
        $items_details_arr = [];
        foreach ($customers as $customer_package_id) {
            $package_id = $customer_package_id->package_id;
            if (array_key_exists($package_id, $arr)) {
                continue;
            }else{
                $customer_items = DB::table('customer_package_items')->where('customer_id','=', $id)->where('package_id', '=', $package_id)->where('status','=',0)->get();
                $item_arr = [];
                
                foreach ($customer_items as $item) {
                    $item_details_arr = [];
                    array_push($item_arr, $item->item_id);
                    array_push($item_details_arr, $item->quantity);
                    array_push($item_details_arr, $item->delivery_status);
                    array_push($item_details_arr, $item->id);
                    $items_details_arr[$package_id][$item->item_id] = $item_details_arr;
                }
                $arr[$package_id] = $item_arr;
                
            }
        }
        
        // echo '<pre>';
        // print_r(array_key_exists(1, $items_details_arr[1]));
        // echo '</pre>';
        // dd($items_details_arr);
        return view('admin.customer-profile', ['customer'=>$customer, 'items'=>$items, 'packages'=>$packages, 'arr'=>$arr, 'items_details_arr'=>$items_details_arr]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::find($id);
        $branches = Branch::all();
        return view('admin.edit-customer', ['customer'=>$customer, 'branches'=>$branches]);
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
        $validated = $request->validate([
            'name'=>['required'],
            'address'=>['required'],
            'branch_id'=>['required'],
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
            'preshoot_date'=>['nullable'],
            'preshoot_location'=>['nullable'],
        ]);

        $customer = Customer::find($id);
        $customer->update($validated);
        session()->flash('customer-updated', 'Customer Updated');
        return redirect()->route('customer.show', $id);
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
        session()->flash('item-detach', 'Items Detached from customer - '.$customer->name);
        return back();
    }

    public function item_attach(Request $request, $id) {
        $request->validate([
            'attach_items'=>'required',
        ]);
        $customer = Customer::find($id);

        foreach ($request->attach_items as $attach_item) {
            $item = Item::find($attach_item);
            $customer->items()->attach($item->id, ['item_price'=>$item->item_price, 'quantity'=>1]);
        }
        session()->flash('item-attach', 'Items Attached to customer - '.$customer->name);
        return back();
    }

    public function mark_as_delivered($id) {
        DB::table('customer_item')->where('id', '=', $id)->update(['status'=>1]);
        session()->flash('mark-as-delivered', 'Item Marked as Delivered to customer');
        return back();
    }

    public function package_detach(Request $request, $id) {
        $request->validate([
            'detach_packages'=>'required',
        ]);
        $customer = Customer::find($id);
        $customer->packages()->detach($request->detach_packages);

        foreach ($request->detach_packages as $detach_package) {
            $package = Package::find($detach_package);
            DB::table('customer_package_items')->where('customer_id', '=', $id)->where('package_id', '=', $package->id)->delete();
        }
        
        session()->flash('package-detach', 'Package Detached from customer - '.$customer->name);
        return back();
    }

    public function package_attach(Request $request, $id) {
        $request->validate([
            'attach_packages'=>'required',
        ]);
        $customer = Customer::find($id);

        foreach ($request->attach_packages as $attach_package) {
            $package = Package::find($attach_package);
            $customer->packages()->attach($package->id, ['package_price'=>$package->package_price]);

            foreach ($package->items as $item) {
                DB::table('customer_package_items')->insert([
                    'customer_id'=>$customer->id,
                    'package_id'=>$package->id,
                    'item_id'=>$item->id,
                    'quantity'=>1
                ]);
            }
        }
        session()->flash('package-attach', 'Package Attached from customer - '.$customer->name);
        return back();
    }

    // if status = 1, items are detached already
    public function detach_package_item_customer(Request $request) {
        $customer_id = $request->customer_id;
        $package_id = $request->package_id;
        $request->validate([
            'items'=>'required'
        ]);

        foreach ($request->items as $item) {
            DB::table('customer_package_items')->where('customer_id', '=', $customer_id)->where('package_id','=', $package_id)->where('item_id', '=', $item)->update([
                'status'=>1,
                'quantity'=>1,
                'delivery_status'=>0
            ]);
        }
        return redirect()->route('customer.show', $customer_id);
    }

    // if status = 0, items are attached already
    public function attach_package_item_customer(Request $request) {
        $customer_id = $request->customer_id;
        $package_id = $request->package_id;

        $request->validate([
            'items'=>'required'
        ]);

        foreach ($request->items as $item) {
            DB::table('customer_package_items')->where('item_id', '=', $item)->where('customer_id', '=', $customer_id)->where('package_id','=', $package_id)->update([
                'status'=>0,
            ]);
        }

        return back();
    }

    public function get_all_func_dates() {
        $date_arr = [];

        $all_wedding_dates = Customer::select('wedding_date')->get();
        $wedding_dates = array_values($all_wedding_dates->toArray());
        foreach ($wedding_dates as $key => $value) {
            if ($value['wedding_date'] != NULL) {
                array_push($date_arr, $value['wedding_date']);
            }
            
        }

        $all_home_com_dates = Customer::select('home_com_date')->get();
        $home_com_dates = array_values($all_home_com_dates->toArray());
        foreach ($home_com_dates as $key => $value) {
            if ($value['home_com_date'] != NULL) {
                array_push($date_arr, $value['home_com_date']);
            }
            
        }
        
        $all_event_dates = Customer::select('event_date')->get();
        $event_dates = array_values($all_event_dates->toArray());
        foreach ($event_dates as $key => $value) {
            if ($value['event_date'] != NULL) {
                array_push($date_arr, $value['event_date']);
            }
            
        }

        $all_photo_shoot_dates = Customer::select('photo_shoot_date')->get();
        $photo_shoot_dates = array_values($all_photo_shoot_dates->toArray());
        foreach ($photo_shoot_dates as $key => $value) {
            if ($value['photo_shoot_date'] != NULL) {
                array_push($date_arr, $value['photo_shoot_date']);
            }
            
        }

        $all_preshoot_date = Customer::select('preshoot_date')->get();
        $preshoot_date = array_values($all_preshoot_date->toArray());
        foreach ($preshoot_date as $key => $value) {
            if ($value['preshoot_date'] != NULL) {
                array_push($date_arr, $value['preshoot_date']);
            }
            
        }

        return response()->json($date_arr);
    }

    public function get_functions_of_day(Request $request) {
        $arr = [];
        $customers = Customer::where('wedding_date', '=', "{$request->date}")->get();
        foreach ($customers as $customer) {
            $data_arr = [];
            // $postponed = $customer->postponed;
            // if ($postponed == NULL) {
            //     $postponed = "NO";
            // }
            $data_arr['name'] = $customer->name;
            // $data_arr['postponed'] = $postponed;
            $data_arr['customer_id'] = $customer->id;
            $data_arr['bill_number'] = $customer->bill_nulber;
            $data_arr['status'] = $customer->status;
            $data_arr['type'] = 1;
            array_push($arr, $data_arr);
        }

        $customers = Customer::where('home_com_date', '=', "{$request->date}")->get();
        foreach ($customers as $customer) {
            $data_arr = [];
            // $postponed = $customer->postponed;
            // if ($postponed == NULL) {
            //     $postponed = "NO";
            // }
            $data_arr['name'] = $customer->name;
            // $data_arr['postponed'] = $postponed;
            $data_arr['customer_id'] = $customer->id;
            $data_arr['bill_number'] = $customer->bill_nulber;
            $data_arr['status'] = $customer->status;
            $data_arr['type'] = 2;
            array_push($arr, $data_arr);
        }

        $customers = Customer::where('event_date', '=', "{$request->date}")->get();
        foreach ($customers as $customer) {
            $data_arr = [];
            // $postponed = $customer->postponed;
            // if ($postponed == NULL) {
            //     $postponed = "NO";
            // }
            $data_arr['name'] = $customer->name;
            // $data_arr['postponed'] = $postponed;
            $data_arr['customer_id'] = $customer->id;
            $data_arr['bill_number'] = $customer->bill_nulber;
            $data_arr['status'] = $customer->status;
            $data_arr['type'] = 3;
            array_push($arr, $data_arr);
        }

        $customers = Customer::where('photo_shoot_date', '=', "{$request->date}")->get();
        foreach ($customers as $customer) {
            $data_arr = [];
            // $postponed = $customer->postponed;
            // if ($postponed == NULL) {
            //     $postponed = "NO";
            // }
            $data_arr['name'] = $customer->name;
            // $data_arr['postponed'] = $postponed;
            $data_arr['customer_id'] = $customer->id;
            $data_arr['bill_number'] = $customer->bill_nulber;
            $data_arr['status'] = $customer->status;
            $data_arr['type'] = 4;
            array_push($arr, $data_arr);
        }

        $customers = Customer::where('preshoot_date', '=', "{$request->date}")->get();
        foreach ($customers as $customer) {
            $data_arr = [];
            // $postponed = $customer->postponed;
            // if ($postponed == NULL) {
            //     $postponed = "NO";
            // }
            $data_arr['name'] = $customer->name;
            // $data_arr['postponed'] = $postponed;
            $data_arr['customer_id'] = $customer->id;
            $data_arr['bill_number'] = $customer->bill_nulber;
            $data_arr['status'] = $customer->status;
            $data_arr['type'] = 5;
            array_push($arr, $data_arr);
        }
        return response()->json($arr);
    }

    public function edit_bill(Request $request, $id) {
        $validated = $request->validate([
            'total_payment' => ['nullable'],
            'discount' => ['nullable'],
            'advance_payment' => ['nullable'],
        ]);
        $customer = Customer::find($id);
        session()->flash('bill-updated', 'Bill Updated');
        $customer->update($validated);
        return back();
    }

    public function update_customer_items(Request $reqeust, $id) {
        $validated = $reqeust->validate([
            'item_price'=>'required',
            'quantity'=>'required',
        ]);

        $customer_item = DB::table('customer_item')->where('id', '=', $id)->update($validated);
        session()->flash('customer-item-updated', 'Customer Item Updated');
        return back();
    }

    public function update_customer_packages(Request $reqeust, $id) {
        $validated = $reqeust->validate([
            'package_price'=>'required',
        ]);

        $customer_package = DB::table('customer_package')->where('id', '=', $id)->update($validated);
        session()->flash('customer-package-updated', 'Customer Package Updated');
        return back();
    }

    public function customer_package_item_mark_as_delivered($id) {
        DB::table('customer_package_items')->where('id', '=', $id)->update(['delivery_status'=>1]);
        session()->flash('customer_package_item_mark-as-delivered', 'Item Marked as Delivered to customer');
        return back();
    }

    public function update_customer_package_items(Request $reqeust, $id) {
        $validated = $reqeust->validate([
            'quantity'=>'required',
        ]);

        $customer_package_items = DB::table('customer_package_items')->where('id', '=', $id)->update($validated);
        session()->flash('customer-package-item-updated', 'Customer Item Updated');
        return back();
    }

    function postpone(Request $request, $id) {
        $customer = Customer::find($id);
        
        $fake = $request->fake;
        if($fake == 1) {
            $wedding_date = $customer->wedding_date;
            $result = $customer->update([
                'wedding_date' => $request->date,
                'posponed_date' => $wedding_date,
            ]);
            session()->flash('wedding-posponed', 'Wedding Date Posponed');
        }else if($fake == 2) {
            $home_com_date = $customer->home_com_date;
            $result = $customer->update([
                'home_com_date'=> $request->date,
                'homecomming_posponed_date' => $home_com_date,
            ]);
            session()->flash('home-com-posponed', 'Homecomming Date Posponed');
        }else if($fake == 3) {
            $preshoot_date = $customer->preshoot_date;
            $result = $customer->update([
                'preshoot_date'=> $request->date,
                'preshoot_postponed_date' => $preshoot_date,
            ]);
            session()->flash('preshoot-posponed', 'Preshoot Date Posponed');
        }else if($fake == 4) {
            $event_date = $customer->event_date;
            $result = $customer->update([
                'event_date' => $request->date,
                'posponed_date' => $event_date,
            ]);
            session()->flash('event-posponed', 'Event Date Posponed');
        }else if($fake == 5) {
            $photo_shoot_date = $customer->photo_shoot_date;
            $result = $customer->update([
                'photo_shoot_date' => $request->date,
                'posponed_date' => $photo_shoot_date,
            ]);
            session()->flash('photoshoot-posponed', 'Photoshoot Date Posponed');
        }

        return back();
    }
}
