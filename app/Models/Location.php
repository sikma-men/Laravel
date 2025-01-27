<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// app/Models/Location.php
class Location extends Model
{
    protected $fillable = ['latitude', 'longitude','category'];
}
