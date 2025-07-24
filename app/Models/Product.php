<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Product extends Model
{
    protected $fillable = [
        'name',
        'price',
        'description',
        'image'
    ];
}
