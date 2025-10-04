<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product Category</title>
</head>

<body>
    <h1>Edit Product Category</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <h3>{{ $error }}</h3>
            @endforeach
        </div>
    @endif

    <form action="/product_categorizes/{{ $product_category->id }}" method="POST">
        @csrf
        @method('PUT')
        <input type="text" name="category_name" value="{{ $product_category->category_name }}" required>
        <button type="submit">Update</button>
    </form>
    @if (session('message'))
        <div>
            <h3>{{ session('message') }}</h3>
        </div>
    @endif
    <button><a href="/product_categorizes">Back</a></button>
</body>

</html>