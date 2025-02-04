<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Location Data</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/table.css') }}">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    @extends('layouts.sidebar')
    <div class="container-fluid mt-5">
        <h2 class="text-center mb-4">Data Lokasi</h2>
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
                    window.location.href = `/edit-location/${id}`; // Redirect ke halaman edit
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
                    fetch(`/locations/${id}`, { // Pastikan endpoint sesuai
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
                            Swal.fire(
                                'Terhapus!',
                                'Data berhasil dihapus.',
                                'success'
                            );
                            fetchLocations(); // Refresh tabel setelah delete
                        })
                        .catch(error => {
                            console.error('Error deleting location:', error);
                            Swal.fire(
                                'Gagal!',
                                'Terjadi kesalahan saat menghapus data.',
                                'error'
                            );
                        });
                }
            });
        }

        document.addEventListener("DOMContentLoaded", fetchLocations);
    </script>
</body>
</html> 