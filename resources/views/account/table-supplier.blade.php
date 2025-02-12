<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier Data</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/table-supplier.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    @extends('layouts.sidebar')
    <div class="supplier-container">
        <h2 class="supplier-title">Data Supplier</h2>
        <a href="/add-supplier" class="supplier-add-btn">Tambah Supplier</a>

        <div class="table-responsive mt-4">
            <table class="supplier-table">
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
                <tbody id="supplier-table">
                    <!-- Data akan dimuat di sini -->
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function fetchSuppliers() {
            fetch('/suppliers')
                .then(response => response.json())
                .then(suppliers => {
                    let tableBody = document.getElementById('supplier-table');
                    tableBody.innerHTML = '';
                    suppliers.forEach(supplier => {
                        let row = `
                            <tr>
                                <td>${supplier.first_name}</td>
                                <td>${supplier.last_name}</td>
                                <td>${supplier.email}</td>
                                <td>${supplier.phone}</td>
                                <td>${supplier.company_name}</td>
                                <td>${supplier.description}</td>
                                <td>${supplier.city}</td>
                                <td>${supplier.state}</td>
                                <td>${supplier.country}</td>
                                <td>${supplier.zipcode}</td>
                                <td>
                                    <button class="supplier-action-btn supplier-action-edit" onclick="editSupplier(${supplier.id})">Edit</button>
                                    <button class="supplier-action-btn supplier-action-delete" onclick="deleteSupplier(${supplier.id})">Delete</button>
                                </td>
                            </tr>
                        `;
                        tableBody.innerHTML += row;
                    });
                })
                .catch(error => console.error('Error fetching suppliers:', error));
        }

        function editSupplier(id) {
            window.location.href = `/edit-supplier/${id}`;
        }

        function deleteSupplier(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data ini akan dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/suppliers/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            }
                        })
                        .then(response => response.json())
                        .then(() => {
                            Swal.fire('Terhapus!', 'Data berhasil dihapus.', 'success');
                            fetchSuppliers();
                        })
                        .catch(error => {
                            console.error('Error deleting supplier:', error);
                            Swal.fire('Gagal!', 'Terjadi kesalahan.', 'error');
                        });
                }
            });
        }

        document.addEventListener("DOMContentLoaded", fetchSuppliers);
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
