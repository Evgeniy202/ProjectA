<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'category',
        'tittle',
        'slug',
        'description',
        'price',
        'isAvailable',
        'isFavorite',
        'mainImage',
        'img_1',
        'img_2',
        'img_3',
        'img_4',
        'img_5',
        'img_6',
        'img_7',
        'img_8',
        'img_9',
        'img_10'
    ];
}
