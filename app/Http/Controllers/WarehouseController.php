<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Warehouse::All();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'address' => 'required',
            'type'   => 'required'
        ]);


        if ($validator->fails()) {
            return getError();
        }

        $warehouse = [
            'name' => $request->name,
            'address' => $request->address,
            'status'    => $request->status,
            'type' => $request->type
        ];

        $warehouse = Warehouse::create($warehouse);
        if ($warehouse) {
            return redirect()->back()->with('success', 'Product was stored successful!');
        } else {
            session()->flash('error', 'An error occured while processing store your product!');
            // return redirect()->back()->with('error', 'An error occured while processing store your product!');
        }
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
    public function update(Request $request, $id)
    {
        $warehouse = Warehouse::find($id);

        $warehouse->name = $request->input('name');
        $warehouse->address = $request->input('address');
        $warehouse->type = $request->input('type');
        $warehouse->status = $request->input('status');

        $warehouse->save();

        return response()->json(['message' => 'Warehouse updated successfully.'], 200);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $warehouseIds = $request->input('warehouseIds');
        foreach ($warehouseIds as $id) {
            $warehouse = Warehouse::findOrFail($id);
            $warehouse->delete();
        }
        return back();
    }
}
