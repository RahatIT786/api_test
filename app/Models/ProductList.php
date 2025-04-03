<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class ProductList extends Model
{
    use HasFactory;
    protected $table = 'product_lists';

    protected $fillable = [
        'name',
        'category',
        'price',
        'description',
        'stock',
        'product_image',
        'delete_status'
    ];
}
