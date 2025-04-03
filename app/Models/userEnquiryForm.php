<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class userEnquiryForm extends Model
{
    use HasFactory;
    protected $table = 'user_enquiry_forms';

    protected $fillable = [
        'name',
        'product_id',
        'product_name',
        'mobile',
        'email',
        'message',
        'delete_status'
    ];

}
