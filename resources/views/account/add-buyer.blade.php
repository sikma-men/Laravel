<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/add-supplier.css') }}">
    <title>Add Buyer</title>
    <style>
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 300px;
        }

        .modal-content button {
            margin: 10px;
            padding: 10px 20px;
            border: none;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }

        .modal-content button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    @extends('layouts.sidebar')

    <div class="main-content">
        <h1>Add Buyer</h1>
        <div class="form-map-container">
            <form action="{{ route('store-buyer') }}" method="POST" onsubmit="showModal(event)" class="form-container">
                @csrf
                <div>
                    <label for="first_name">First Name :</label>
                    <input type="text" id="first_name" name="first_name" required>
                </div>
                <div>
                    <label for="last_name">Last Name:</label>
                    <input type="text" id="last_name" name="last_name" required>
                </div>
                <div>
                    <label for="email">Email:</label>
                    <input type="text" id="email" name="email" required>
                </div>
                <div>
                    <label for="phone">Telepon:</label>
                    <input type="text" id="phone" name="phone" required>
                </div>
                <div>
                    <label for="description">Deskripsi:</label>
                    <input type="text" id="description" name="description" required>
                </div>
                <div>
                    <label for="company_name">Perusahaan:</label>
                    <input type="text" id="company_name" name="company_name" required>
                </div>
                <div>
                    <label for="state">Status:</label>
                    <input type="text" id="state" name="state" required>
                </div>
                <div>
                    <label for="city">Kota:</label>
                    <input type="text" id="city" name="city" required>
                </div>
                <div>
                    <label for="country">Negara:</label>
                    <input type="text" id="country" name="country" required>
                </div>
                <div>
                    <label for="zipcode">Kode Pos:</label>
                    <input type="text" id="zipcode" name="zipcode" required>
                </div>
                <button type="submit"><span>Submit Buyer</span></button>
            </form>
        </div>
    </div>

    <!-- Modal Success -->
    <div class="modal" id="successModal">
        <div class="modal-content">
            <h2>Success!</h2>
            <p>Buyer berhasil ditambahkan!</p>
            <button onclick="addMore()">Tambah Lagi</button>
            <button onclick="goToTable()">Lihat Daftar Buyer</button>
        </div>
    </div>

    <script>
        function showModal(event) {
            event.preventDefault();
            const form = event.target;

            fetch(form.action, {
                method: form.method,
                body: new FormData(form),
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (response.ok) {
                    return response.json();
                } else {
                    throw new Error('Gagal menambahkan buyer!');
                }
            })
            .then(data => {
                if (data) {
                    document.getElementById('successModal').style.display = 'flex';
                    form.reset();
                }
            })
            .catch(error => {
                alert(error.message);
                console.error('Error:', error);
            });
        }

        function addMore() {
            document.getElementById('successModal').style.display = 'none';
        }

        function goToTable() {
            window.location.href = '{{ route('table-buyer') }}';
        }
    </script>
</body>

</html>
