<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory; // Tambahkan ini untuk mendukung factory jika perlu

    protected $table = 'locations'; // Pastikan tabel sesuai dengan nama di database

    protected $fillable = ['latitude', 'longitude', 'category']; // Field yang bisa diisi secara massal
}
