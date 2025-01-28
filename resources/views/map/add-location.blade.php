<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Location</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="{{ asset('css/add-location.css') }}">
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
        <button type="submit"><span>Submit Location</span></button>
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
