<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Location</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="{{ asset('css/add-location.css') }}">
</head>

<body>
    <h1>Edit Location</h1>
    @extends('layouts.sidebar')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('update-location', $location->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Nama:</label>
            <input type="text" id="name" name="name" value="{{ $location->name }}" required
                autocomplete="off">
        </div>
        <div>
            <label for="latitude">Latitude:</label>
            <input type="text" id="latitude" name="latitude" value="{{ $location->latitude }}" required
                autocomplete="off">
        </div>
        <div>
            <label for="longitude">Longitude:</label>
            <input type="text" id="longitude" name="longitude" value="{{ $location->longitude }}" required
                autocomplete="off">
        </div>
        <div>
            <label for="category">Category:</label>
            <select id="category" name="category" required autocomplete="off">
                <option value="">Select a category</option>
                <option value="rumah sakit" {{ $location->category == 'rumah sakit' ? 'selected' : '' }}>Rumah Sakit
                </option>
                <option value="sekolah" {{ $location->category == 'sekolah' ? 'selected' : '' }}>Sekolah</option>
                <option value="masjid" {{ $location->category == 'masjid' ? 'selected' : '' }}>Masjid</option>
                <option value="gereja" {{ $location->category == 'gereja' ? 'selected' : '' }}>Gereja</option>
                <option value="pom bensin" {{ $location->category == 'pom bensin' ? 'selected' : '' }}>Pom Bensin
                </option>
                <option value="rumah makan" {{ $location->category == 'rumah makan' ? 'selected' : '' }}>Rumah Makan
                </option>
            </select>
        </div>
        <button type="submit">Update Location</button>
    </form>

    <div id="map"></div>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([{{ $location->latitude }}, {{ $location->longitude }}], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var marker = L.marker([{{ $location->latitude }}, {{ $location->longitude }}]).addTo(map);

        map.on('click', function(e) {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;

            marker.setLatLng([lat, lng]);
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;
        });
    </script>
</body>

</html>
