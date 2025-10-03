<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    {{--
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet"> --}}
</head>

<body>
    <h1 class=''>Edit Product</h1>
    <form action="/products/{{ $product->id }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="product_id">Product ID:</label><br>
            <input type="text" name="product_id" id="product_id" value="{{ $product->product_id }}" required>
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
            <input type="text" name="product_name" id="product_name" value="{{ $product->product_name }}" required>
        </div>
        <br>

        <div>
            <label for="price">Price:</label><br>
            <input type="number" step="0.01" name="price" id="price" value='{{ $product->price }}' required>
        </div>
        <br>
        <div>
            <button type="submit">Save</button>
        </div>
        <br>
        <div><button><a href="/products" method="get">Back</a></button></div>

        @if (session('message'))
            <div>
                <h3>{{ session('message') }}</h3>
            </div>
        @endif
    </form>




</body>

</html>