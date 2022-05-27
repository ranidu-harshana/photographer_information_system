<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Customer;
use App\Models\FunctionType;
use App\Models\Item;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
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
    public function store(Request $request) {
        $validated = $request->validate([
            'bill_nulber'=>['required', 'unique:customers,bill_nulber'],
            'name'=>['required'],
            'address'=>['required'],
            'branch_id'=>['required'],
            'mob_no1'=>['required'],
            'mob_no2'=>['nullable'],
            
            'total_payment'=>['nullable'],
            'discount'=>['nullable'],
            'advance_payment'=>['nullable'],
            'function_type_checkbox'=>['required'],
        ]);
        $validated['function_type_id'] = 1;
        $customer = Customer::create($validated);

        foreach ($request->function_type_checkbox as $function_type_checkbox) {
            if( $function_type_checkbox == 1 ) {
                $customer->function_types()->attach($function_type_checkbox, ['date'=>$request->wedding_date, 'location'=>$request->wedding_location, 'event_type'=>NULL]);
            } else if( $function_type_checkbox == 2 ) {
                $customer->function_types()->attach($function_type_checkbox, ['date'=>$request->home_com_date, 'location'=>$request->home_com_location, 'event_type'=>NULL]);
            } else if( $function_type_checkbox == 3 ) {
                $customer->function_types()->attach($function_type_checkbox, ['date'=>$request->preshoot_date, 'location'=>$request->preshoot_location, 'event_type'=>NULL]);
            } else if( $function_type_checkbox == 4 ) {
                $customer->function_types()->attach($function_type_checkbox, ['date'=>$request->goingaway_date, 'location'=>$request->goingaway_location, 'event_type'=>NULL]);
            } else if( $function_type_checkbox == 5 ) {
                $customer->function_types()->attach($function_type_checkbox, ['date'=>$request->engagement_date, 'location'=>$request->engagement_location, 'event_type'=>NULL]);
            } else if( $function_type_checkbox == 6 ) {
                $customer->function_types()->attach($function_type_checkbox, ['date'=>$request->event_date, 'location'=>$request->event_location, 'event_type'=>$request->event_type]);
            }
        }

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
        $function_ids = [];
        foreach($customer->items as $item){
            array_push($ids, $item->id);
        }
        foreach($customer->function_types as $function_type){
            array_push($function_ids, $function_type->id);
        }
        $items = DB::table('items')
            ->whereNotIn('id',$ids)
            ->whereRaw('id IN (SELECT item_id FROM function_type_item WHERE function_type_id IN ('.implode(', ', $function_ids).'))')
            ->get();

            
            
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
    public function update(Request $request, $id) {
        $validated = $request->validate([
            'name'=>['required'],
            'address'=>['required'],
            'branch_id'=>['required'],
            'mob_no1'=>['required'],
            'mob_no2'=>['nullable'],
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
        $affected = DB::table('customer_function_type')->where('id', $id)->get()->first();
            //   ->update(['date' => $request->date, ''=>]);

        $updated = DB::table('customer_function_type')->where('id', $id)->update(['date'=>$request->date, 'postponed_date'=>$affected->date]);
        
        $func_type = FunctionType::find($affected->function_type_id);
        session()->flash('posponed', $func_type->name . ' date postponed');
        return back();
    }

    public function invoice_pdf($id) {
        $customer = Customer::find($id);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('admin.invoice-pdf', ['customer'=>$customer]);
        return $pdf->stream();
        // return view('admin.invoice-pdf');
    }

    // Calender functions
    public function get_all_func_dates() {
        $date_arr = [];

        $all_func_dates = DB::table('customer_function_type')->get();
        foreach ($all_func_dates as $key => $value) {
            if ($value->date != NULL) {
                array_push($date_arr, $value->date);
            }
            
        }

        return response()->json($date_arr);
    }

    public function get_functions_of_day(Request $request) {
        $arr = [];
        $all_funcs = DB::table('customer_function_type')->where('date', '=', "{$request->date}")->get();

        foreach ($all_funcs as $func) {
            $data_arr = [];
            $postponed = $func->postponed_date;
            if ($postponed == NULL) {
                $postponed = "NO";
            }
            $customer = Customer::find($func->customer_id);
            $data_arr['name'] = $customer->name;
            $data_arr['postponed'] = $postponed;
            $data_arr['customer_id'] = $customer->id;
            $data_arr['bill_number'] = $customer->bill_nulber;
            $data_arr['status'] = $func->status;
            $data_arr['type'] = $func->function_type_id;;
            array_push($arr, $data_arr);
        }
        
        return response()->json($arr);
    }
    // end


    public function add_date(Request $request, $id) {
        $updated = DB::table('customer_function_type')->where('id', $id)->update(['date'=>$request->date]);
        
        $func_type = FunctionType::find($updated);
        session()->flash('date_added', $func_type->name . ' date added');
        return back();
    }

    public function add_location(Request $request, $id) {
        $updated = DB::table('customer_function_type')->where('id', $id)->update(['location'=>$request->location]);
        
        $func_type = FunctionType::find($updated);
        session()->flash('location_added', $func_type->name . ' location added');
        return back();
    }
}
