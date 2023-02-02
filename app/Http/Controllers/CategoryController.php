<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
class CategoryController extends Controller
{
    public function store(Request $request)
    {

       $formfill = request()->validate([
            'name' => 'required',
            'status' => 'required',
            'parent_category' => 'required'
        ]);


        $category = Category::create($formfill);

        return back();
    }

    public function show($id)
    {

        return Category::findOrFail($id);

    }

    public function index()
    {
        return Category::with('products')->get();
    }

    public function destroy($id)
    {
        Category::destroy($id);
        return back();
    }
}
