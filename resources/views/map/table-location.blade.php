<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Location Data</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/table.css') }}">
    <style>
        .custom-table {
            margin-left: auto;
            margin-right: auto;
            width: 80%;
            /* Lebar tabel agar tidak terlalu lebar */
            border-radius: 10px;
            /* Membuat sudut tabel lebih lembut */
            overflow: hidden;
        }

        .custom-table th,
        .custom-table td {
            text-align: center;
            /* Teks tengah */
            vertical-align: middle;
        }
    </style>
</head>

<body>
    @extends('layouts.sidebar')
    <div class="container-fluid mt-5" style="margin-left: 120px;">
        <h2 class="text-center mb-4 ">Data Lokasi</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover custom-table">
                <thead class="table-dark">
                    <tr>
                        <th>Nama Lokasi</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="location-table">
                    <!-- Data akan dimuat di sini -->
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function fetchLocations() {
            fetch('/locations')
                .then(response => response.json())
                .then(locations => {
                    let tableBody = document.getElementById('location-table');
                    tableBody.innerHTML = ''; // Bersihkan tabel sebelum diisi
                    locations.forEach(location => {
                        let row = `
                            <tr>
                                <td>${location.name}</td>
                                <td>${location.category}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm" onclick="editLocation(${location.id})">Edit</button>
                                    <button class="btn btn-danger btn-sm" onclick="deleteLocation(${location.id})">Delete</button>
                                </td>
                            </tr>
                        `;
                        tableBody.innerHTML += row;
                    });
                })
                .catch(error => console.error('Error fetching locations:', error));
        }

        function editLocation(id) {
            window.location.href = `/edit-location/${id}`; // Redirect ke halaman edit
        }

        function deleteLocation(id) {
            if (confirm("Apakah Anda yakin ingin menghapus lokasi ini?")) {
                fetch(`/locations  /${id}`, { // Pastikan endpoint sesuai
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            _method: 'DELETE'
                        }) // Tambahkan _method jika pakai Route::resource()
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error("Gagal menghapus data.");
                        }
                        return response.json();
                    })
                    .then(() => {
                        alert("Data berhasil dihapus.");
                        fetchLocations(); // Refresh tabel setelah delete
                    })
                    .catch(error => console.error('Error deleting location:', error));
            }
        }


        document.addEventListener("DOMContentLoaded", fetchLocations);
    </script>

</body>

</html>
