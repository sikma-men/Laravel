<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Location</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="{{ asset('css/add-location.css') }}">
</head>

<body>
    <h1>Edit Location</h1>
    @extends('layouts.sidebar')
    <form action="{{ route('update-location', $location->id) }}" method="POST" onsubmit="showModal(event)">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Nama:</label>
            <input type="text" id="name" name="name" value="{{ $location->name }}" required>
        </div>
        <div>
            <label for="latitude">Latitude:</label>
            <input type="text" id="latitude" name="latitude" value="{{ $location->latitude }}" required>
        </div>
        <div>
            <label for="longitude">Longitude:</label>
            <input type="text" id="longitude" name="longitude" value="{{ $location->longitude }}" required>
        </div>
        <div>
            <label for="category">Category:</label>
            <select id="category" name="category" required>
                <option value="">Select a category</option>
                <option value="rumah sakit" {{ $location->category == 'rumah sakit' ? 'selected' : '' }}>Rumah Sakit</option>
                <option value="sekolah" {{ $location->category == 'sekolah' ? 'selected' : '' }}>Sekolah</option>
                <option value="masjid" {{ $location->category == 'masjid' ? 'selected' : '' }}>Masjid</option>
                <option value="gereja" {{ $location->category == 'gereja' ? 'selected' : '' }}>Gereja</option>
                <option value="pom bensin" {{ $location->category == 'pom bensin' ? 'selected' : '' }}>Pom Bensin</option>
                <option value="rumah makan" {{ $location->category == 'rumah makan' ? 'selected' : '' }}>Rumah Makan</option>
            </select>
        </div>
        <button type="submit"><span>Update Location</span></button>
    </form>

    <div id="map"></div>

    <!-- Modal -->
    <div class="modal" id="successModal">
        <div class="modal-content">
            <h2>Success!</h2>
            <p>Lokasi berhasil diperbarui!</p>
            <button onclick="closeModal()">OK</button>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([{{ $location->latitude }}, {{ $location->longitude }}], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var marker = L.marker([{{ $location->latitude }}, {{ $location->longitude }}]).addTo(map);

        // Update koordinat ketika peta diklik
        map.on('click', function(e) {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;

            marker.setLatLng([lat, lng]);
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;
        });

        function showModal(event) {
            event.preventDefault();
            document.getElementById('successModal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('successModal').style.display = 'none';
            document.querySelector('form').submit();
        }
    </script>
</body>

</html>
