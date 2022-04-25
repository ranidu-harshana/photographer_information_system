<?php

namespace App\Http\Controllers;

use App\Models\FunctionType;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::all();
        return view('admin.all-items', ['items'=>$items]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $function_types = FunctionType::all();
        return view('admin.create-item', ['function_types'=>$function_types]);
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
            'item_code'=>['required', 'unique:items,item_code'],
            'item_desc'=>['required'],
            'function_type_id'=>['required'],
            'item_price'=>['required'],
        ]);

        $function = FunctionType::find($request->function_type_id);
        $function->items()->create($validated);
        session()->flash('item-created', 'Item Created');
        return redirect()->route('item.index');
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
        $item = Item::find($id);
        $function_types = FunctionType::all();
        return view('admin.edit-item', ['item'=>$item, 'function_types'=>$function_types]);
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
            'item_code'=>['required'],
            'item_desc'=>['required'],
            'function_type_id'=>['required'],
            'item_price'=>['required'],
        ]);

        $item = Item::find($id);
        if($request->function_type_id != $item->function_type_id) {
            DB::table('item_package')->where('item_id', $item->id)->delete();
        }

        $item->update($validated);
        session()->flash('item-updated', 'Item Updated');
        return redirect()->route('item.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::find($id);
        $item->delete();
        return back();
    }

    public function get_items_of_function($id) {
        $items = Item::where('function_type_id', '=', $id)->get()->toArray();
        
        return response()->json($items);
    }
}
