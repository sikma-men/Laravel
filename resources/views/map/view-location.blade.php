<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View Map</title>
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

        #filter {
            display: flex;
            justify-content: center;
            margin: 20px;
        }

        select,
        button {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin: 0 5px;
        }

        button {
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        #map {
            height: 400px;
            margin: 20px auto;
            max-width: 600px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 768px) {
            #map {
                height: 300px;
            }
        }
    </style>
</head>

<body>
    @extends('layouts.sidebar')
    <h1>View Map</h1>
    <div id="filter">
        {{-- <form action="{{ route('get-locations') }}"> --}}
        <select id="category-filter">
            <option value="">-- Select Category --</option>
            <option value="rumah sakit">Rumah Sakit</option>
            <option value="Sekolah">Sekolah</option>
            <option value="Masjid">Masjid</option>
            <option value="Gereja">Gereja</option>
            <option value="Pom Bensin">Pom Bensin</option>
            <option value="Rumah Makan">Rumah Makan</option>
        </select>
        <button id="search-btn" name="category">Search</button>
        {{-- </form> --}}
    </div>
    <div id="map"></div>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([-7.328470, 108.349038], 13); // Lokasi awal peta

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var markers = [];

        function fetchLocations(category = '') {
            // Hapus marker sebelumnya
            markers.forEach(marker => map.removeLayer(marker));
            markers = [];

            // Ambil data lokasi berdasarkan kategori
            fetch(`/locations?category=${category}`)
                .then(response => response.json()) // Parsing respons menjadi JSON
                .then(locations => {
                    console.log(locations); // Debug: Tampilkan data lokasi di konsol
                    locations.forEach(location => {
                        // Tambahkan marker ke peta
                        var marker = L.marker([parseFloat(location.latitude), parseFloat(location.longitude)])
                            .addTo(map)
                            .bindPopup(`<strong>${location.name}</strong><br>${location.category}`);
                        markers.push(marker); // Simpan marker dalam array
                    });
                })
                .catch(error => console.error('Error fetching locations:', error)); // Tangani error
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
