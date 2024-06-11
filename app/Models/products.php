<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    use HasFactory;

    protected $tabel = 'products';

    protected   $fillable = [
        'name',
        'description',
        'price',
        'category_id',
        'qty_init',
        'qty_in',
        'qty_out',
        'image'
    ];
}
