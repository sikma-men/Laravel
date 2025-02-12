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
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9fafb;
            color: #334155;
        }

        h1 {
            text-align: center;
            margin: 40px 0 20px;
            font-size: 2rem;
            font-weight: bold;
            color: #1e293b;
        }

        .main-content {
            margin-top: 10px;
            padding: 20px;
        }

        .form-map-container {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
        }

        .form-row {
            display: flex;
            gap: 20px;
            margin-bottom: 15px;
        }

        .form-group {
            flex: 1;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
            color: #4a5568;
        }

        input[type="text"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
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
                <div class="form-row">
                    <div class="form-group">
                        <label for="first_name">First Name:</label>
                        <input type="text" id="first_name" name="first_name" required>
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name:</label>
                        <input type="text" id="last_name" name="last_name" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="text" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Telepon:</label>
                        <input type="text" id="phone" name="phone" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="description">Deskripsi:</label>
                    <input type="text" id="description" name="description" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="company_name">Perusahaan:</label>
                        <input type="text" id="company_name" name="company_name" required>
                    </div>
                    <div class="form-group">
                        <label for="state">Status:</label>
                        <input type="text" id="state" name="state" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="city">Kota:</label>
                        <input type="text" id="city" name="city" required>
                    </div>
                    <div class="form-group">
                        <label for="country">Negara:</label>
                        <input type="text" id="country" name="country" required>
                    </div>
                    <div class="form-group">
                        <label for="zipcode">Kode Pos:</label>
                        <input type="text" id="zipcode" name="zipcode" required>
                    </div>
                </div>

                <button type="submit">Submit Buyer</button>
            </form>
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
            .then(response => response.ok ? response.json() : Promise.reject('Gagal menambahkan buyer!'))
            .then(data => {
                if (data) {
                    alert('Buyer berhasil ditambahkan!');
                    form.reset();
                }
            })
            .catch(error => alert(error));
        }
    </script>
</body>

</html>
