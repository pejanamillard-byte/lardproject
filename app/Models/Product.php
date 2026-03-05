<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Add this block to allow mass assignment:
    protected $fillable = [
        'name',
        'detail'
    ];
}