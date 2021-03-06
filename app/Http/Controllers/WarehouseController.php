<?php

namespace App\Http\Controllers;

use App\Model\Warehouse;
use App\Model\ProductMaster;
use Illuminate\Http\Request;
use App\Model\Log;
use Auth;
use Response;

class WarehouseController extends Controller
{
    public function checkPermission() {
        if(auth()->user()->hasRole('admin'))
            return true;
        else
            return false;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $count = 0;

        $warehouse = Warehouse::with('product_masters')->get();
        foreach ($warehouse as $warehouses) 
        {
            $ware_house[$count] = $warehouses;
            $count++;
        }
        
        $product = ProductMaster::all();
        return view('admin.warehouse.warehouse_list', compact('warehouse','product','ware_house'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!$this->checkPermission())
            return redirect('home');

        return view('admin.warehouse.warehouse_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$this->checkPermission())
            return redirect('home');

        $this->validate($request,[ 
            'title' => 'required|string|max:250',
            'location' => 'required|string|max:250',
        ]);

        Warehouse::create($request->all());

        Log::create(['module_name'=>'warehouse_create', 'user_id'=>Auth::id()]);

        return redirect()->route('warehouse.index')->with('success','Record Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $warehouse = Warehouse::find($id);
        $item = Warehouse::with('product_masters')->find($id);
        return Response::json([$warehouse, $item]);
        // return view('admin.warehouse.warehouse_detail',compact('warehouse'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!$this->checkPermission())
            return redirect('home');

        $warehouse = Warehouse::find($id);
        return Response::json($warehouse);
        // return view('admin.warehouse.warehouse_update',compact('warehouse'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!$this->checkPermission())
            return redirect('home');

        $this->validate($request,[ 
            'title' => 'required|string|max:250',
            'location' => 'required|string|max:250',
        ]);
        Warehouse::find($request->warehouse_id)->update($request->all());

        Log::create(['module_name'=>'warehouse_update', 'user_id'=>Auth::id()]);

        return redirect()->route('warehouse.index')->with('success','Record Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if(!$this->checkPermission())
            return redirect('home');
        
        Warehouse::find($request->warehouse_id)->delete();

        Log::create(['module_name'=>'warehouse_delete', 'user_id'=>Auth::id()]);

        return redirect()->route('warehouse.index')->with('success','Record Deleted Successfully');
    }
    public function addProducts(Request $request)
    {
        if(!$this->checkPermission())
            return redirect('home');
        
        $warehouse = Warehouse::find($request->warehouse_master_id);

        $warehouse->product_masters()->detach();

        for($i = 0; $i < count($request->product_master_id); $i++)
        {
            $warehouse->product_masters()->attach($request->product_master_id[$i]);
        
        }
        return redirect()->route('warehouse.index')->with('success','Warehouse Created Successfully');
    }
}