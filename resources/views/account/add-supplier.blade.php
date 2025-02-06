<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/add-supplier.css') }}">
    <title>Add Supplier</title>
</head>

<body>
    @extends('layouts.sidebar')
    <div class="main-content">
        <h1>Add Location</h1>
        <div class="form-map-container">
            <form action="{{ route('update') }}" method="POST" onsubmit="showModal(event)" class="form-container">
                @csrf
                <div>
                    <label for="first_name">First Name :</label>
                    <input type="text" id="first_name" name="first_name" required>
                </div>
                <div>
                    <label for="last name">Last Name:</label>
                    <input type="text" id="last_name" name="last_name" required>
                </div>
                <div>
                    <label for="email">Email:</label>
                    <input type="text" id="email" name="email" required>
                </div>
                <div>
                    <label for="telepon">Telepon:</label>
                    <input type="text" id="phone" name="phone" required>
                </div>
                <div>
                    <label for="description">deskripsi:</label>
                    <input type="text" id="description" name="description" required>
                </div>
                <div>
                    <label for="perusahaan">perusahaan:</label>
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
                    <label for="zipcode">Status:</label>
                    <input type="text" id="zipcode" name="zipcode" required>
                </div>
                <button type="submit"><span>Submit Location</span></button>
        </div>
        </form>
    </div>
    <div class="modal" id="successModal">
        <div class="modal-content">
            <h2>Success!</h2>
            <p>Lokasi berhasil ditambahkan!</p>
            <button onclick="closeModal()">OK</button>
        </div>
    </div>
    </div>
</body>

</html>
