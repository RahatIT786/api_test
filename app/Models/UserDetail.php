<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    protected $table = 'user_details'; // Ensure the table name matches the migration

    protected $fillable = [
        'name',
        'email',
        'mobile',
        'dob',
        'adhaar',
        'address',
        'password',
        'user_image',
        'delete_status',
    ];

    protected $hidden = [
        'password', // Hide password when returning JSON response
    ];
}
