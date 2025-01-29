
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Location Data</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/table.css') }}">

</head>

<body>
    @extends('layouts.sidebar')
    <div class="container mt-5">
        <h2>Data Lokasi</h2>
        <table class="table table-bordered">
            <thead>
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

    <script>
        function fetchLocations() {
            fetch('/locations')
                .then(response => response.json())
                .then(locations => {
                    let tableBody = document.getElementById('location-table');
                    tableBody.innerHTML = '';
                    locations.forEach(location => {
                        let row = `
                        <tr>
                            <td>${location.name}</td>
                            <td>${location.category}</td>
                            <td>
                                <button class="btn btn-warning btn-sm" onclick="editLocation(${location.id}, '${location.name}')">Edit</button>
                                <button class="btn btn-danger btn-sm" onclick="deleteLocation(${location.id})">Delete</button>
                            </td>
                        </tr>
                    `;
                        tableBody.innerHTML += row;
                    });
                });
        }

        function editLocation(id, oldName) {
            header(location : "/edit-location")
        }

        function deleteLocation(id) {
            if (confirm("Apakah Anda yakin ingin menghapus lokasi ini?")) {
                fetch(`/locations/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    }).then(response => response.json())
                    .then(() => fetchLocations());
            }
        }

        document.addEventListener("DOMContentLoaded", fetchLocations);
    </script>

</body>

</html>
