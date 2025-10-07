<?php


declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\ProductCategory;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\View\View;
class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        //Display category resource

        $product_categories = ProductCategory::query()
            ->when(
                $request->filled('product_category'),
                fn($query) => $query->where('id', $request->product_category)
            )
            ->get();

        return view('categories.index', [
            'product_category_selections' => ProductCategory::all(),
            'product_categories' => $product_categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        //Create a new product category
        return view('categories.create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
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
    public function edit(string $id): View
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
    public function update(Request $request, string $id): RedirectResponse
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
    public function destroy(string $id): RedirectResponse
    {
        //Delete the product category
        ProductCategory::find($id)->delete();
        return redirect('/product_categories');
    }
}
