<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create new product category</title>
</head>

<body>
    <h1>Create new product category</h1>
    <form action="/product_categories" method="POST">
        @csrf
        <input type="text" name="product_category_name" placeholder="Enter new category" required>
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <h3>{{ $error }}</h3>
                @endforeach
            </div>
        @endif
        <button type="submit">Create</button>
    </form>
    <button><a href="/product_categories">Back</a></button>
</body>

</html>