<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Categories</title>
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

        input[type="text"] {
            width: 100%;
            box-sizing: border-box;
            padding: 4px;
        }

        button {
            padding: 6px 12px;
            cursor: pointer;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        form.inline {
            display: inline;
        }
    </style>
</head>

<body>
    <h1>Product Categories</h1>

    {{-- Create Form --}}
    <button type="submit"><a href="/product_categories/create">Create</a></button>
    <form action="/product_categories" method="get">
        <button type="submit">Show all</button>
    </form>

    @if (session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <h3>{{ $error }}</h3>
            @endforeach
        </div>
    @endif
    <table>
        <thead>
            <tr>
                <th>Product Category</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <form action="/product_categories" method="get">
                <tr>
                    <td>
                        <select name="product_category">
                            <option value="">-------Choose------</option>
                            @foreach ($product_category_selections as $product_category)
                                <option value="{{ $product_category->id}}"
                                    {{ $product_category->id === request()->input('product_category') ? 'selected' : '' }}>
                                    {{ $product_category->category_name }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <button>Search</button>
                    </td>
                </tr>
            </form>

            @foreach ($product_categories as $product_category)
                <tr>
                    <td>
                        {{ $product_category->category_name }}
                    </td>
                    <td>
                        <button><a href=" product_categories/{{ $product_category->id }}/edit">Edit</a></button>
                        {{-- Delete form --}}
                        <form class="inline" action="/product_categories/{{ $product_category->id }}" method="POST"
                            onsubmit="return confirm('Do you want to delete this category?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


</body>

</html>