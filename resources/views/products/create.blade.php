<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
</head>

<body>
    <h1>Create Product</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <h3>{{ $error }}</h3>
            @endforeach
        </div>
    @endif

    <form action="/products" method="POST">
        @csrf
        <div>
            <label for="product_id">Product ID:</label><br>
            <input type="text" name="product_id" id="product_id" @if ($errors->any()) value="{{ old('product_id') }}"
            @endif>
        </div>
        <br>

        <div>
            <label for="product_name">Product Name:</label><br>
            <input type="text" name="product_name" id="product_name" @if ($errors->any())
            value="{{ old('product_name') }}" @endif>
        </div>
        <br>

        <div>
            <label for="price">Price:</label><br>
            <input type="text" step="0.01" name="price" id="price" @if ($errors->any()) value="{{ old('price') }}"
            @endif>
        </div>
        <br>
        <select name="product_category_id" id="">

            @foreach ($product_categories as $product_category)
                <option value="{{ $product_category->id }}">{{ $product_category->category_name }}</option>
            @endforeach
        </select>
        <br>

        <button type="submit">Save</button>
        <br><button><a href="/products">Back</a></button>
    </form>


</body>

</html>