<?php

namespace App\Http\Controllers;

use App\Models\FunctionType;
use App\Models\Item;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = Package::all();
        return view('admin.all-packages', ['packages'=>$packages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $function_types = FunctionType::all();
        return view('admin.create-package', ['function_types'=>$function_types]);
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
            'package_code'=>['nullable', 'unique:packages,package_code'],
            'name'=>['nullable'],
            'desc'=>['nullable'],
            'package_price'=>['nullable'],
        ]);

        $function = FunctionType::find($request->function_type_id);
        $package = $function->packages()->create($validated);

        $package->items()->attach($request->items);
        session()->flash('package-created', 'Package Created');
        return redirect()->route('package.index');
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
        $package = Package::find($id);
        $function_types = FunctionType::all();
        return view('admin.edit-package', ['package'=>$package, 'function_types'=>$function_types]);
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
            'desc'=>['required'],
            'package_price'=>['required'],
        ]);

        $package = Package::find($id);
        $package->update($validated);
        session()->flash('package-updated', 'Package Updated');
        return redirect()->route('package.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Package::find($id);
        $item->delete();
        return back();
    }
}