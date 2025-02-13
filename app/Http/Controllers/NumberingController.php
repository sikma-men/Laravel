<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class NumberingController extends Controller
{
    public function index()
    {
        return view('numbering.autonumbering');
    }

    public function autoNumbering(Request $request)
    {
        $request->validate([
            'tanggal_lahir' => 'required|date',
            'jurusan' => 'required|string',
        ]);

        // Mapping jurusan ke kode
        $jurusanCodes = [
            'AKL' => '01',
            'KLN' => '03',
            'HTL' => '04',
            'DKV' => '05',
            'PPLG' => '06',
        ];

        $tanggalLahir = Carbon::parse($request->tanggal_lahir)->format('dmy');
        $jurusanCode = $jurusanCodes[$request->jurusan] ?? '00';
        $tanggalDaftar = Carbon::now()->format('Y') - 2000;
        $tanggalKelulusan = $tanggalDaftar + 3;

        // Membentuk nomor unik
        $autoNumber = "$tanggalDaftar$tanggalKelulusan$tanggalLahir$jurusanCode";

        return view('numbering.autonumbering', ['autoNumber' => $autoNumber]);
    }
}
