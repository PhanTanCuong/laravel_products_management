<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
</head>
<body>
    <h1>Create Product</h1>

    <form action="/products" method="POST">
        @csrf

        <div>
            <label for="product_id">Product ID:</label><br>
            <input type="text" name="product_id" id="product_id" required>
        </div>
        <br>

        <div>
            <label for="product_name">Product Name:</label><br>
            <input type="text" name="product_name" id="product_name" required>
        </div>
        <br>

        <div>
            <label for="price">Price:</label><br>
            <input type="number" step="0.01" name="price" id="price" required>
        </div>
        <br>

        <button type="submit">Save</button>
    </form>
</body>
</html>
