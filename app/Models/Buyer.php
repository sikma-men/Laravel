<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
    use HasFactory;
    protected $table = 'buyer';
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'description',
        'company_name',
        'city',
        'state',
        'country',
        'zipcode'
    ];
}
