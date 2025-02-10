<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buyer Data</title>
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/table-buyer.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    @extends('layouts.sidebar')
    <div class="buyer-container">
        <h2 class="buyer-title">Data Buyer</h2>
        <a href="/add-buyer" class="buyer-add-btn">Tambah Buyer</a>

        <div class="table-responsive mt-4">
            <table class="buyer-table">
                <thead>
                    <tr>
                        <th>Nama Depan</th>
                        <th>Nama Belakang</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Perusahaan</th>
                        <th>Deskripsi</th>
                        <th>Kota</th>
                        <th>Status</th>
                        <th>Negara</th>
                        <th>Zipcode</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="buyer-table">
                    <!-- Data akan dimuat di sini -->
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function fetchBuyers() {
            fetch('/buyers')
                .then(response => response.json())
                .then(buyers => {
                    let tableBody = document.getElementById('buyer-table');
                    tableBody.innerHTML = '';
                    buyers.forEach(buyer => {
                        let row = `
                            <tr>
                                <td>${buyer.first_name}</td>
                                <td>${buyer.last_name}</td>
                                <td>${buyer.email}</td>
                                <td>${buyer.phone}</td>
                                <td>${buyer.company_name}</td>
                                <td>${buyer.description}</td>
                                <td>${buyer.city}</td>
                                <td>${buyer.state}</td>
                                <td>${buyer.country}</td>
                                <td>${buyer.zipcode}</td>
                                <td>
                                    <button class="buyer-action-btn buyer-action-edit" onclick="editBuyer(${buyer.id})">Edit</button>
                                    <button class="buyer-action-btn buyer-action-delete" onclick="deleteBuyer(${buyer.id})">Delete</button>
                                </td>
                            </tr>
                        `;
                        tableBody.innerHTML += row;
                    });
                })
                .catch(error => console.error('Error fetching buyers:', error));
        }

        function editBuyer(id) {
            window.location.href = `/edit-buyer/${id}`; // Atau buat modal untuk form edit
        }

        function deleteBuyer(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data ini akan dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/buyers/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                    'content')
                            }
                        })
                        .then(response => response.json())
                        .then(() => {
                            Swal.fire('Terhapus!', 'Data berhasil dihapus.', 'success');
                            fetchBuyers();
                        })
                        .catch(error => {
                            console.error('Error deleting buyer:', error);
                            Swal.fire('Gagal!', 'Terjadi kesalahan.', 'error');
                        });
                }
            });
        }

        document.addEventListener("DOMContentLoaded", fetchBuyers);
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
