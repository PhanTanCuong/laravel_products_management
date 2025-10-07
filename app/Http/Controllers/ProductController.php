<?php



namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {

        $products = Product::query()
            ->when(
                $request->filled('product_id'),
                fn($query) => $query->where('product_id', 'like', "%{$request->product_id}%")
            )
            ->when(
                $request->filled('product_name'),
                fn($query) => $query->where('product_name', 'like', "%{$request->product_name}%")
            )
            ->when(
                $request->filled('price'),
                fn($query) => $query->where('price', 'like', "%{$request->price}%")
            )
            ->when(
                $request->filled('product_category'),
                fn($query) => $query->where('product_category_id', $request->product_category)
            )
            ->paginate(10)
            ->withQueryString();

        // dd($products->url());

        return view(
            'products.index',
            [
                'products' => $products,
                'product_categories' => ProductCategory::all(),
            ]
        );
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {

        return view(
            'products.create',
            ['product_categories' => ProductCategory::all()]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
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
    public function show(string $id): View
    {
        $product = Product::find($id);
        return view('products.show')->with('product', $product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        //Update product
        // dd($id);
        $product = Product::find($id);
        // dd($product);

        return View('products.edit', [
            'product' => $product,
            'product_categories' => ProductCategory::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
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
            [ProductController::class, 'edit'],
            ['product' => $id]
        )->with('message', 'Product successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        //Delete product
        Product::find($id)->delete();
        return redirect('/products')->with('message', 'Product successfully deleted');
    }
}
