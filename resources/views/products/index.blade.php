<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    <style>
        table {
            width: 60%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #333;
            padding: 8px 12px;
            text-align: left;
        }
        th {
            background: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Products</h1>

    <a href="products/create" class="btn btn-primary btn-lg disable" role="button">Create</a>

    <table>
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Price ($)</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($products as $product )
            <tr>
                <td>{{ $product->product_id }}</td>
                <td>{{ $product->product_name }}</td>
                <td>{{ $product->price }}</td>
                <td>
                <a href="/products/{{ $product ->id }}/edit" class="btn btn-primary btn-lg disable" role="button">Edit</a>
                <a href="/products/{{ $product ->id }}" class="btn btn-primary btn-lg disable" role="button">Delete</a>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
</body>
</html>
