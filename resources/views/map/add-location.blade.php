<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Location</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        h1 {
            text-align: center;
            margin: 20px 0;
            color: #333;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        form div {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #555;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        #map {
            height: 400px;
            margin: 20px auto;
            max-width: 600px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            text-align: center;
            max-width: 300px;
        }

        .modal-content h2 {
            margin: 0 0 10px;
        }

        .modal-content button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .modal-content button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <h1>Add Location</h1>
    @extends('layouts.sidebar')
    <form action="{{ route('store-location') }}" method="POST" onsubmit="showModal(event)">
        @csrf
        <div>
            <label for="name">Nama:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div>
            <label for="latitude">Latitude:</label>
            <input type="text" id="latitude" name="latitude" required>
        </div>
        <div>
            <label for="longitude">Longitude:</label>
            <input type="text" id="longitude" name="longitude" required>
        </div>
        <div>
            <label for="category">Category:</label>
            <select id="category" name="category" required>
                <option value="">Select a category</option>
                <option value="rumah sakit">Rumah Sakit</option>
                <option value="sekolah">Sekolah</option>
                <option value="masjid">Masjid</option>
                <option value="gereja">Gereja</option>
                <option value="pom bensin">Pom Bensin</option>
                <option value="rumah makan">Rumah Makan</option>
            </select>
        </div>
        <button type="submit">Submit Location</button>
    </form>

    <div id="map"></div>

    <!-- Modal -->
    <div class="modal" id="successModal">
        <div class="modal-content">
            <h2>Success!</h2>
            <p>Lokasi berhasil ditambahkan!</p>
            <button onclick="closeModal()">OK</button>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([-7.328470039339983, 108.34903789391174], 13); // Lokasi awal peta

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var marker;

        // Menambahkan marker ketika peta diklik
        map.on('click', function(e) {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;

            // Menambahkan marker
            if (marker) {
                marker.setLatLng([lat, lng]); // Update posisi marker
            } else {
                marker = L.marker([lat, lng]).addTo(map); // Tambah marker baru
            }

            // Set nilai latitude dan longitude di form input
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;
        });

        // Fungsi untuk menampilkan modal sukses
        function showModal(event) {
            event.preventDefault(); // Mencegah form dikirim langsung
            document.getElementById('successModal').style.display = 'flex';
        }

        // Fungsi untuk menutup modal
        function closeModal() {
            document.getElementById('successModal').style.display = 'none';
            document.querySelector('form').submit(); // Kirim formulir setelah modal ditutup
        }
    </script>
</body>

</html>
