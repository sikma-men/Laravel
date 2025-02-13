@extends('layouts.navbar_numbering')

@section('title', 'Auto Numbering')

@section('content')
<div class="container text-center mt-5 pt-4">
    <h3 class="mb-4">Daftar</h3>

    <!-- Form untuk generate nomor -->
    <div class="form-container mx-auto mb-3" style="max-width: 400px;">
        {{-- <h5>Generate Nomor</h5> --}}
        <form action="{{ route('auto-numbering') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama">
            </div>
            <div class="mb-3">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control">
            </div>
            <div class="mb-3">
                <label for="jurusan" class="form-label">Jurusan</label>
                <select id="jurusan" name="jurusan" class="form-select">
                    <option value="AKL">Akuntansi dan Keuangan Lembaga</option>
                    <option value="KLN">Kuliner</option>
                    <option value="HTL">Perhotelan</option>
                    <option value="DKV">Desain Komunikasi Visual</option>
                    <option value="PPLG">Pengembangan Perangkat Lunak Dan Game</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">Generate</button>
        </form>
    </div>

    <!-- Menampilkan nomor yang dihasilkan -->
    @if(isset($autoNumber))
        <div class="alert alert-success">Nomor ID Anda: <strong>{{ $autoNumber }}</strong></div>
    @endif
</div>
@endsection
