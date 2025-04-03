<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'payment_method',
        'amount',
        'transaction_id',
        'delete_status',
    ];

    public function user()
    {
        return $this->belongsTo(UserDetail::class);
    }
}
