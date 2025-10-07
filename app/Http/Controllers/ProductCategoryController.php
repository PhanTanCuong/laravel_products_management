<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Display category resource

        $product_categories = ProductCategory::all();

        return view('categories.index', [
            'product_categories' => $product_categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Create a new product category
        return view('categories.create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Create a new product category

        // dd($request->input('product_category_name'));
        $request->validate([
            'category_name' => ['required|unique:product_categories'],
        ]);
        // dd($request->input('product_category_name'));

        $product_category = new ProductCategory;


        // dd($request);


        $product_category->category_name = $request->input('product_category_name');

        $product_category->save();

        return redirect('/product_categories');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //edit product category
        $product_category = ProductCategory::find($id);
        return view('categories.edit', [
            'product_category' => $product_category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //Update the product category
        $product_category = ProductCategory::find($id);
        // dd($request->input('category_name'));
        $request->validate([
            'category_name' => [
                'required',
                Rule::unique('product_categories')->ignore($product_category->id)
            ]
        ]);


        $product_category->category_name = $request->input('category_name');

        $product_category->save();
        return redirect()->action(
            [ProductCategoryController::class, 'edit'],
            $id
        )
            ->with('message', 'Product category successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //Delete the product category
        ProductCategory::find($id)->delete();
        return redirect('/product_categories');
    }
}
