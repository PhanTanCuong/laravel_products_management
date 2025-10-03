<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();

        return view(
            'products.index',
            ['products' => $products]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = new Product();

        $validator = Validator::make($request->all(), [
            'product_id' => 'required|unique:table_products|max:13',
        ]);

        if ($validator->fails()) {
            return redirect('/products/create')
                ->withErrors($validator)
                ->withInput();
        }


        $product->product_id = $request->input('product_id');
        $product->product_name = $request->input('product_name');
        $product->price = $request->input('price');

        $product->save();
        return redirect('/products')->with('message', 'Product successfully created!!!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);
        return view('products.show')->with('product', $product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //Update product
        // dd($id);
        $product = Product::find($id);
        // dd($product);

        return View('products.edit')->with('product', $product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);
        $request->validate([
            'product_id' => [
                'required',
                Rule::unique('table_products')->ignore($product->id)
            ],
            // 'product_name' => 'required',
            // 'price' => 'required|numeric'
        ]);

        // $validated = $validator->validated();

        // dd($validated);
        //update product
        // Product::where('id', $id)
        //     ->update([
        //         'product_id' => $request->input('product_id'),
        //         'product_name' => $request->input('product_name'),
        //         'price' => $request->input('price')
        //     ]);

        $product->product_id = $request->input('product_id');
        $product->product_name = $request->input('product_name');
        $product->price = $request->input('price');

        $product->save();

        return redirect()->action(
            [ProductsController::class, 'edit'],
            ['product' => $id]
        )->with('message', 'Product successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //Delete product
        Product::find($id)->delete();
        return redirect('/products')->with('message', 'Product successfully deleted');
    }
}
