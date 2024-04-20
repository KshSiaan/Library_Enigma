<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'cover',
        'book_name',
        'author_id',
        'price',
        'init_stock',
        'current_stock',
        'catagory_id',
        'language',
        'book_detail',
    ];
}
