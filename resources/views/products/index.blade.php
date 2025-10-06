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
            margin: 20px 0;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 8px 12px;
            text-align: left;
        }

        th {
            background: #f2f2f2;
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
    <h1>Products</h1>
    <div>
        <button><a href="/products/create">Create</a></button>
        <button><a href="/products">Show all</a></button>
    </div>

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

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
                <form action="/products/search" method="GET">
                    <td>
                        <input type="text" name="product_id" value="{{ old('product_id') }}" placeholder="Search by ID">
                    </td>
                    <td>
                        <input type="text" name="product_name" value="{{ old('product_name') }}"
                            placeholder="Search by name">
                    </td>
                    <td>
                        <input type="text" name="price" value="{{ old('price') }}" placeholder="Search by price">
                    </td>
                    <td>
                        {{-- <input type="text" name="product_category" value="{{ old('product_category') }}"
                            placeholder="Search by category"> --}}
                        <select name="product_category" id="">
                            <option value="">--------Choose---------</option>
                            @foreach ($product_categorizes as $product_category)
                                <option value="{{ $product_category->id }}"
                                {{ $product_category->id == old('product_category') ? 'selected': '' }}>
                                {{ $product_category->category_name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <button type="submit">Search</button>
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
                    <td class="display:flex gap:5px">
                        <button><a href="/products/{{ $product->id }}/edit">Edit</a></button>
                        <button><a href="/products/{{ $product->id }}">Show</a></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>