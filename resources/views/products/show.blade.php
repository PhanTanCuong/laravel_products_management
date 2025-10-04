<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Detail</title>
    <style>
        /* Modal overlay */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
        }

        /* Modal box */
        .modal-box {
            background: #fff;
            padding: 20px 30px;
            border-radius: 8px;
            text-align: center;
            min-width: 300px;
        }

        .modal-buttons {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        button {
            padding: 8px 16px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }

        .btn-delete {
            background-color: #e74c3c;
            color: white;
        }

        .btn-cancel {
            background-color: #95a5a6;
            color: white;
        }
    </style>
</head>

<body>
    <h1>Show Product</h1>
    <h2>Product ID: {{ $product->product_id }}</h2>
    <h2>Name: {{ $product->product_name }}</h2>
    <h2>Price: {{ $product->price }}</h2>

    <div>
        <button id="openModal">Delete</button>
        <button><a href="/products">Back</a></button>
    </div>

    {{-- Modal --}}
    <div class="modal-overlay" id="confirmModal">
        <div class="modal-box">
            <p>Do you want to delete this product?</p>
            <div class="modal-buttons">
                <form id="deleteForm" action="/products/{{ $product->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-delete">Delete</button>
                </form>
                <button id="cancelModal" class="btn-cancel">Cancel</button>
            </div>
        </div>
    </div>

    <script>
        const modal = document.getElementById('confirmModal');
        const openBtn = document.getElementById('openModal');
        const cancelBtn = document.getElementById('cancelModal');

        openBtn.addEventListener('click', () => modal.style.display = 'flex');
        cancelBtn.addEventListener('click', () => modal.style.display = 'none');
    </script>
</body>

</html>