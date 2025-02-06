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
    <div class="container" style="margin-top: 80px;">
        <div class="d-flex align-items-center justify-content-between mt-3">
            <button class="btn btn-primary">
                <a href="/table-location" class="text-white text-decoration-none"><img src="image/arrow.png" alt="" width="25px"></a>
            </button>
            <h2 class="text-center flex-grow-1 mb-0">Data Lokasi</h2>
        </div>
        <div class="row mt-4" id="location-container">
            <!-- Cards akan dimuat di sini -->
        </div>
    </div>
    <script>
        function fetchLocations() {
            fetch('/locations')
                .then(response => response.json())
                .then(locations => {
                    let container = document.getElementById('location-container');
                    container.innerHTML = ''; // Bersihkan sebelum diisi ulang
                    locations.forEach(location => {
                        let card = `
                            <div class="col-md-4 mb-4">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <h5 class="card-title">${location.name}</h5>
                                        <p class="card-text">Kategori: ${location.category}</p>
                                        <p class="card-text">Longitude: ${location.longitude}</p>
                                        <p class="card-text">Latitude: ${location.latitude}</p>
                                        <button class="btn btn-warning btn-sm" onclick="editLocation(${location.id})">Edit</button>
                                        <button class="btn btn-danger btn-sm" onclick="deleteLocation(${location.id})">Delete</button>
                                    </div>
                                </div>
                            </div>
                        `;
                        container.innerHTML += card;
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
</body>
</html>
