<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('warehouse', ['warehouses' => Warehouse::all()]);
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
        try {
            $validatedData = $request->validate([
                'name' => 'required',
                'address' => 'required',
                'type'   => 'required'
            ]);
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        // if ($validator->fails()) {
        //     return getError();
        // }

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
            //session()->flash('error', 'An error occured while processing store your product!');
            return redirect()->back()->with('error', 'An error occured while processing store your product!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Warehouse $warehouse)
    {
        $warehouseProducts = $warehouse->products()->latest()->get();
        $warehouses = Warehouse::all();
        $categories = Category::all();
        return view('warehouse.show', [
            'warehouseProducts' => $warehouseProducts,
            'warehouse' => $warehouse,
            'categories' => $categories,
            'warehouses' => $warehouses
        ]);
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
        $warehouse = Warehouse::findOrFail($id);
        $warehouse->name = $request->input('name');
        $warehouse->address = $request->input('address');
        $warehouse->type = $request->input('type');
        $warehouse->status = $request->input('status');
        $warehouse->save();

        return redirect()->back()->with('success', 'Warehouse updated successfully!');
    }

    // // Return a success response
    // return response()->json([
    //     'status' => 'success',
    //     'message' => 'Warehouse updated successfully',
    //     'data' => [
    //             'name' => $warehouse->name,
    //             'address' => $warehouse->address,
    //             'type' => $warehouse->type,
    //             'status' => $warehouse->status,
    //         ],
    //     ]);
    // } else {
    //     // Return an error response if the warehouse was not found
    //     return response()->json([
    //         'status' => 'error',
    //         'message' => 'Warehouse not found',
    //     ], 404);
    // }


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


    public function send(Request $request)
    {
        $sended_product = Product::where('status', '1')
            ->where('name', $request->product_name)
            ->where('warehouse_id', $request->receiver_warehouse_id)
            ->first();

        if (!$sended_product) {
            return back()->with('error', "Failed to find product in the other warehouse");
        }

        $product = Product::where('status', '1')
            ->where('name', $request->product_name)
            ->where('warehouse_id', $request->sender_warehouse_id)
            ->first();

        if (!$product) {
            return back()->with('error', "Failed to find product in this warehouse");
        }

        if ($product->quantity < $request->quantity) {
            return back()->with('error', 'Failed to transfer product. Quantity is less than you requested.');
        }

        $total = $product->quantity - $request->quantity;
        $product->quantity = $total;
        $product->save();

        $total = $sended_product->quantity + $request->quantity;
        $sended_product->quantity = $total;
        $sended_product->save();

        return redirect()->back()->with(['success' => 'Product transferred successfully.']);
    }
}
