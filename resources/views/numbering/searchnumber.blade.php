<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    @extends('layouts.navbar_numbering')

    @section('title', 'Search Number')

    @section('content')
        <div class="container text-center" style="max-width: 400px; margin-top: 200px;">
            <h3 class="mb-4">Cari Data</h3>
            <div class="form-container mx-auto">
                <form action="{{ route('search-number') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="auto_number" class="form-label">Masukkan Nomor</label>
                        <input type="text" name="auto_number" class="form-control" placeholder="Masukkan Nomor ID">
                    </div>
                    <button type="submit" class="btn btn-success w-100">Cari</button>
                </form>
            </div>

            @if (isset($tanggalLahir))
                <div class="mt-4 form-container mx-auto" style="max-width: 400px;">
                    <h5>Hasil Pencarian</h5>
                    <p><strong>Tanggal Lahir:</strong> {{ $tanggalLahir }}</p>
                    <p><strong>Jurusan:</strong> {{ $jurusan }}</p>
                    <p><strong>Tanggal Input:</strong> {{ $tanggalInput }}</p>
                </div>
            @endif
        </div>
    @endsection
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
