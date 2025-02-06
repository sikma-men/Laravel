<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier Data</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    @extends('layouts.sidebar')
    <div class="container " style="margin-top: 80px;">
        <h2 class="text-center">Data Supplier</h2>
        <button class="btn btn-primary"><a href="/add-supplier" style="text-decoration: none; color: white; ">Tambah Supplier</a></button>
        <div class="table-responsive mt-4">
            <table class="table table-bordered table-striped table-hover222">
                <thead class="table-dark">
                    <tr>
                        <th>Nama Depan</th>
                        <th>Nama Belakang</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Perusahaan</th>
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
                                <td>
                                    <button class="btn btn-warning btn-sm" onclick="editSupplier(${supplier.id})">Edit</button>
                                    <button class="btn btn-danger btn-sm" onclick="deleteSupplier(${supplier.id})">Delete</button>
                                </td>
                            </tr>
                        `;
                        tableBody.innerHTML += row;
                    });
                })
                .catch(error => console.error('Error fetching suppliers:', error));
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
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                    'content')
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
