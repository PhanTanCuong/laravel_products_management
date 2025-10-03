<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Detail</title>
</head>

<body>
    <h1>Show Product</h1>
    <h2>Product ID:{{ $product->product_id }}</h2>
    <h2>Name:{{ $product->product_name }}</h2>
    <h2>Price:{{ $product->price }}</h2>
    <div>
        <span>
            <form action="/products/{{ $product->id }}" method="post">
                @csrf
                @method('DELETE')
                <button>Delete</button>
            </form>
            <br>
            <button><a href="/products" method="get">Back</a></button>
        </span>
    </div>

</body>

</html>