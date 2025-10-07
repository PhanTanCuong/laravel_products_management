<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Product</title>
    <style>
        table {
            width: 60%;
            border-collapse: collapse;
            margin: 10px 0 20px 20px;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 8px 12px;
            text-align: left;
        }

        th {
            text-align: center;
            background: #64def6;
        }

            {
                {
                -- input[type="text"] {
                    width: 100%;
                    box-sizing: border-box;
                    padding: 4px;
                }

                button {
                    padding: 6px 12px;
                    cursor: pointer;
                }

                --
            }
        }

        a {
            text-decoration: none;
            color: inherit;
        }
    </style>
</head>

<body>
    <div class=" mt-4 d-flex justify-content-center text-danger">
    <h1>Products</h1>
    </div>



    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
<div>
<div class="d-flex justify-content-left">
    <div class="d-flex ms-4 gap-1 p-1">
        <button class="btn btn-primary"><a href="/products/create">Create</a></button>
        <button class="btn btn-primary"><a href="/products">Show all</a></button>
    </div>
    <div>
    <h4>Results: {{$products->count() }}</h4>
    </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Price ($)</th>
                <th>Category</th>
                <th>Action</th>
            </tr>
            <tr>
                {{-- Hàng search ngay trong table --}}
                <form action="/products" method="GET">
                    <td>
                        <input type="text" name="product_id" value="{{ request()->input('product_id') }}" placeholder="Search by ID">
                    </td>
                    <td>
                        <input type="text" name="product_name" value="{{request()->input('product_name')}}"
                            placeholder="Search by name">
                    </td>
                    <td>
                        <input type="text" name="price" value="{{request()->input('price')}}" placeholder="Search by price">
                    </td>
                    <td>
                        {{-- <input type="text" name="product_category" value="{{ old('product_category') }}"
                            placeholder="Search by category"> --}}
                        <select name="product_category" id="">
                            <option value="">--------Choose---------</option>
                            @foreach ($product_categories as $product_category)
                                <option value="{{ $product_category->id }}"
                                {{ $product_category->id == request()->input('product_category') ? 'selected': '' }}>
                                {{ $product_category->category_name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <button class="btn btn-primary" type="submit">Search</button>
                    </td>
                </form>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->product_id }}</td>
                    <td>{{ $product->product_name }}</td>
                    <td>${{ $product->price }}</td>
                    {{-- use operation '?->' for null case --}}
                    <td>{{ $product->productCategory?->category_name}}</td>
                    <td class="d-flex p-2 gap-1">
                        <button class="btn btn-warning"><a href="/products/{{ $product->id }}/edit">Edit</a></button>
                        <button class="btn btn-primary"><a href="/products/{{ $product->id }}">Show</a></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

</body>

</html>