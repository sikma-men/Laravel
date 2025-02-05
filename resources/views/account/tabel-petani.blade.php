<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Location Data</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    @extends('layouts.sidebar')
    <div class="container mt-5">
        <div class="d-flex align-items-center justify-content-between mt-3">
            <h2 class="text-center flex-grow-1 mb-0">Data Lokasi</h2>
        </div>
        <div class="table-responsive mt-4">
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Nama Petani</th>
                        <th>Alamat</th>
                        <th>Nama Sawah/kebun</th>
                        <th>No Handphon</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody id="location-table">
                    <!-- Data akan dimuat di sini -->
                </tbody>
            </table>
        </div>
        <button class="btn btn-primary"><a href="/card-location" style="color: white; text-decoration: none;">Card View</a></button>
    </div>
    <script>
        function fetchLocations() {
            fetch('/locations')
                .then(response => response.json())
                .then(locations => {
                    let tableBody = document.getElementById('location-table');
                    tableBody.innerHTML = ''; // Bersihkan sebelum diisi ulang
                    locations.forEach(location => {
                        let row = `
                            <tr>
                                <td>${location.name}</td>
                                <td>${location.category}</td>
                                <td>${location.longitude}</td>
                                <td>${location.latitude}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            &#x22EE;
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><button class="dropdown-item" onclick="editLocation(${location.id})"><image src="image/edit.png" width="20px"></image>Edit</button></li>
                                            <li><button class="dropdown-item text-danger" onclick="deleteLocation(${location.id})"><image src="image/bin.png" width="20px"></image>Delete</button></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        `;
                        tableBody.innerHTML += row;
                    });
                })
                .catch(error => console.error('Error fetching locations:', error));
        }

        function editLocation(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda akan dialihkan ke halaman edit.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, edit!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `/edit-location/${id}`;
                }
            });
        }

        function deleteLocation(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/locations/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({ _method: 'DELETE' })
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error("Gagal menghapus data.");
                            }
                            return response.json();
                        })
                        .then(() => {
                            Swal.fire('Terhapus!', 'Data berhasil dihapus.', 'success');
                            fetchLocations();
                        })
                        .catch(error => {
                            console.error('Error deleting location:', error);
                            Swal.fire('Gagal!', 'Terjadi kesalahan saat menghapus data.', 'error');
                        });
                }
            });
        }

        document.addEventListener("DOMContentLoaded", fetchLocations);
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
