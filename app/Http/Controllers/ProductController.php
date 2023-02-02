<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'  => ['required', Rule::unique('products', 'name')->ignore($id)],
            'price' => 'required',
            'sell' => 'required',
            'category_id' => 'required|exists:categories,id',
            'status'    => 'required'
        ]);

        if ($validator->fails()) {
            return getError();
        }

        $product = Product::findOrFail($id);
        $product->update($request->all());
        return back();
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name'  => 'required|string|unique:products',
                'quantity' => 'required',
                'price' => 'required',
                'sell'  => 'required',
                'category_id' => 'required|exists:categories,id',
            ]);
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
        // if($validator->fails()){
        //     return getError();
        // }

        $product = Product::create($validatedData);

        if ($product) {
            return redirect()->back()->with('success', 'Product was stored successful!');
        } else {
            session()->flash('error', 'An error occured while processing store your product!');
            // return redirect()->back()->with('error', 'An error occured while processing store your product!');
        }
    }

    public function show($id)
    {
        return Product::findOrFail($id);
    }
    public function index()
    {
        return Product::All();
    }

    public function destroy(Request $request)
    {
        $productIds = $request->input('productIds');
        foreach ($productIds as $id) {
            $product = Product::findOrFail($id);
            $product->delete();
        }
        return back();
    }
}
