<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CharOfCat extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'category', 'tittle', 'numberInFilter'];
}
