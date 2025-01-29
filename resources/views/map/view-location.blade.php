<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View Map</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="{{ asset('css/view-location.css') }}">
</head>

<body>
    @extends('layouts.sideba    r')
    <h1>View Map</h1>
    <div id="filter">
        <div class="select-container">
            <select id="category-filter">
                <option value="">-- Select Category --</option>
                <option value="rumah sakit">Rumah Sakit</option>
                <option value="Sekolah">Sekolah</option>
                <option value="Masjid">Masjid</option>
                <option value="Gereja">Gereja</option>
                <option value="Pom Bensin">Pom Bensin</option>
                <option value="Rumah Makan">Rumah Makan</option>
            </select>
        </div>
        <button id="search-btn" name="category"><span>Search</span></button>
    </div>
    <div id="map"></div>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([-7.328470, 108.349038], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var markers = [];

        // Ikon khusus untuk kategori
        var icons = {
            'rumah sakit': L.icon({
                iconUrl: '{{ asset('image/hospital.png') }}',
                iconSize: [25, 41],
            }),
            'sekolah': L.icon({
                iconUrl: '{{ asset('image/school.png') }}',
                iconSize: [25, 41]
            }),
            'masjid': L.icon({
                iconUrl: '{{ asset('image/mosque.png') }}',
                iconSize: [25, 41]
            }),
            'gereja': L.icon({
                iconUrl: '{{ asset('image/christian.png') }}',
                iconSize: [25, 41]
            }),
            'pom bensin': L.icon({
                iconUrl: '{{ asset('image/petrol.png') }}',
                iconSize: [25, 41]
            }),
            'rumah makan': L.icon({
                iconUrl: '{{ asset('image/restaurant.png') }}',
                iconSize: [25, 41]
            }),
            'default': L.icon({
                iconUrl: 'https://example.com/icons/default.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41]
            })
        };

        function fetchLocations(category = '') {
            // Hapus marker sebelumnya
            markers.forEach(marker => map.removeLayer(marker));
            markers = [];

            // Ambil data lokasi berdasarkan kategori
            fetch(`/locations?category=${category}`)
                .then(response => response.json())
                .then(locations => {
                    console.log(locations);
                    locations.forEach(location => {
                        var icon = icons[location.category] || icons['default'];

                        // Tambahkan marker dengan ikon
                        var marker = L.marker(
                            [parseFloat(location.latitude), parseFloat(location.longitude)],
                            { icon: icon }
                        ).addTo(map).bindPopup(`<strong>${location.name}</strong><br>${location.category}`);

                        markers.push(marker);
                    });
                })
                .catch(error => console.error('Error fetching locations:', error));
        }

        // Ambil lokasi awal (semua lokasi)
        fetchLocations();

        // Event ketika tombol search diklik
        document.getElementById('search-btn').addEventListener('click', function() {
            var category = document.getElementById('category-filter').value;
            fetchLocations(category);
        });
    </script>
</body>

</html>
