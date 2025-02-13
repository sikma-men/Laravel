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
            'PM' => '02',
            'KLN' => '03',
            'HTL' => '04',
            'DKV' => '05',
            'PPLG' => '06',
            'MPLB' => '07',
        ];

        $tanggalLahir = Carbon::parse($request->tanggal_lahir)->format('Ymd');
        $jurusanCode = $jurusanCodes[$request->jurusan] ?? '00';
        $tanggalInput = Carbon::now()->format('Ymd');

        // Membentuk nomor unik
        $autoNumber = "$tanggalLahir-$jurusanCode-$tanggalInput";

        return view('numbering.autonumbering', ['autoNumber' => $autoNumber]);
    }

    public function searchNumber(Request $request)
    {
        $request->validate([
            'auto_number' => 'required|string',
        ]);

        $autoNumber = $request->auto_number;
        $parts = explode('-', $autoNumber);

        if (count($parts) !== 3) {
            return redirect()->back()->withErrors(['auto_number' => 'Format nomor tidak valid']);
        }

        $tanggalLahir = Carbon::createFromFormat('Ymd', $parts[0])->format('d-m-Y');
        $jurusanCode = $parts[1];
        $tanggalInput = Carbon::createFromFormat('Ymd', $parts[2])->format('d-m-Y');

        // Mapping kode jurusan kembali ke nama jurusan
        $jurusanNames = [
            '01' => 'Akuntansi dan Keuangan Lembaga',
            '03' => 'Kuliner',
            '04' => 'Perhotelan',
            '05' => 'Desain Komunikasi Visual',
            '06' => 'Pengembangan Perangkat Lunak Dan Game',
        ];

        $jurusan = $jurusanNames[$jurusanCode] ?? 'Jurusan Tidak Diketahui';

        return view('numbering.searchnumber', compact('autoNumber', 'tanggalLahir', 'jurusan', 'tanggalInput'));
    }
}
