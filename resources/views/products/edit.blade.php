<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Edit Product</title>
    {{--
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet"> --}}
</head>

<body>
    <div class="m-4 d-flex content-justify-center text-danger">
        <h1>Edit Product</h1>
    </div>
    <div class="mx-3">
        <form action="/products/{{ $product->id }}" method="POST">
            @csrf
            @method('PUT')
            <div>
                <label for="product_id">Product ID:</label><br>
                <input type="text" name="product_id" id="product_id" value="{{ $product->product_id }}">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <h3>{{ $error }}</h3>
                        @endforeach
                    </div>
                @endif
            </div>
            <br>

            <div>
                <label for="product_name">Product Name:</label><br>
                <input type="text" name="product_name" id="product_name" value="{{ $product->product_name }}">
            </div>
            <br>

            <div>
                <label for="price">Price:</label><br>
                <input type="number" step="0.01" name="price" id="price" value='{{ $product->price }}'>
            </div>
            <br>
            <select name="product_category_id" id="">
                <option value="">------Choose-------</option>
                @foreach ($product_categorizes as $product_category)
                    <option value="{{ $product_category->id }}" {{ $product->product_category_id == $product_category->id ? 'selected' : '' }}>
                        {{ $product_category->category_name }}
                    </option>
                @endforeach
            </select>
            <br>
            <div class="d-flex m-1 p-2 gap-3">
                <button class="btn btn-primary" type="submit">Save</button>
                <button class="btn btn-secondary text-secondary-emphasis"><a href="/products">Back</a></button>
            </div>
            <br>


            @if (session('message'))
                <div>
                    <h3>{{ session('message') }}</h3>
                </div>
            @endif
        </form>
    </div>





</body>

</html>