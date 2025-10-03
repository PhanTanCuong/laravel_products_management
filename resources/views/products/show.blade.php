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
</body>

</html>