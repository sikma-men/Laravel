@extends('layouts.navbar_numbering')

<<<<<<< HEAD
@section('title', 'Auto Numbering')

@section('content')
<div class="container text-center mt-5 pt-4">
    <h3 class="mb-4">Daftar</h3>

    <!-- Form untuk generate nomor -->
    <div class="form-container mx-auto mb-3" style="max-width: 400px;">
        {{-- <h5>Generate Nomor</h5> --}}
        <form action="{{ route('auto-numbering') }}" method="post">
=======
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Auto Numbering</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .form-container {
            max-width: 400px;
            background: #ffffff;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body class="d-flex justify-content-center align-items-center vh-100 bg-light">
    <div class="form-container">
        <h3 class="text-center mb-3">Auto Numbering</h3>
        <form id="autoNumberForm" action="{{ route('auto-numbering') }}" method="post">
>>>>>>> origin/main
            @csrf
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" id="nama" name="nama" class="form-control" placeholder="Masukkan Nama">
            </div>
            <div class="mb-3">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control">
            </div>
            <div class="mb-3">
                <label for="jurusan" class="form-label">Jurusan</label>
                <select id="jurusan" name="jurusan" class="form-select">
                    <option value="">Pilih Jurusan</option>
                    <option value="AKL">Akuntansi dan Keuangan Lembaga</option>
                    <option value="KLN">Kuliner</option>
                    <option value="HTL">Perhotelan</option>
                    <option value="DKV">Desain Komunikasi Visual</option>
                    <option value="PPLG">Pengembangan Perangkat Lunak Dan Game</option>
                    <option value="MPLB">Manajemen Perkantoran Dan Layanan Bisnis</option>
                    <option value="PM">Pemasaran</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">Generate</button>
        </form>
    </div>

<<<<<<< HEAD
    <!-- Menampilkan nomor yang dihasilkan -->
    @if(isset($autoNumber))
        <div class="alert alert-success">Nomor ID Anda: <strong>{{ $autoNumber }}</strong></div>
    @endif
</div>
@endsection
=======
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('autoNumberForm').addEventListener('submit', function (event) {
            const nama = document.getElementById('nama').value.trim();
            const tanggalLahir = document.getElementById('tanggal_lahir').value.trim();
            const jurusan = document.getElementById('jurusan').value.trim();

            if (!nama || !tanggalLahir || !jurusan) {
                event.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Form Belum Lengkap!',
                    text: 'Silakan isi semua bidang sebelum mengirim.',
                    confirmButtonText: 'OK',
                    customClass: {
                        popup: 'rounded-3 shadow',
                        title: 'fw-bold',
                        confirmButton: 'btn btn-primary'
                    }
                });
            }
        });
    </script>
</body>

</html>
>>>>>>> origin/main
