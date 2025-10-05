<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request->session()->flush();
        $products = Product::all();

        return view(
            'products.index',
            ['products' => $products]
        );
    }

    /**
     * Search() Function
     */

    public function search(Request $request)
    {
        // dd($request);
        $request->flash();

        // dd($data);
        // dd($request);


        $query = Product::query()
            ->join('product_categories', 'table_products.product_category_id', '=', 'product_categories.id')
            ->select('table_products.*', 'product_categories.category_name');

        if ($request->filled('product_id')) {
            $query->where('table_products.product_id', 'like', '%' . $request->input('product_id') . '%');
        }

        if ($request->filled('product_name')) {
            $query->where('table_products.product_name', 'like', '%' . $request->input('product_name') . '%');
        }

        if ($request->filled('price')) {
            $query->where('table_products.price', 'like', '%' . $request->input('price') . '%');
        }
        if ($request->filled('product_category')) {
            // dd($request->input('product_category'));
            $query->where('product_categories.category_name', 'like', '%' . $request->input('product_category') . '%');
        }

        $products = $query->get();
        // dd($products);


        return view('products.index', [
            'products' => $products,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view(
            'products.create',
            ['product_categorizes' => ProductCategory::all()]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $product = new Product();

        $validator = Validator::make($request->all(), [
            'product_id' => 'required|unique:table_products|max:13',
            'product_name' => 'required',
            'price' => 'required|numeric',
            'product_category_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/products/create')
                ->withErrors($validator)
                ->withInput();
        }


        $product->product_id = $request->input('product_id');
        $product->product_name = $request->input('product_name');
        $product->price = $request->input('price');
        $product->product_category_id = $request->input('product_category_id');

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

        return View('products.edit', [
            'product' => $product,
            'product_categorizes' => ProductCategory::all()
        ]);
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
            'product_name' => 'required',
            'price' => 'required|numeric',
            'product_category_id' => 'required'
        ]);


        $product->product_id = $request->input('product_id');
        $product->product_name = $request->input('product_name');
        $product->price = $request->input('price');
        $product->product_category_id = $request->input('product_category_id');

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
