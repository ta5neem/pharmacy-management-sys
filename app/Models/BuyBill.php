<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuyBill extends Model
{

    protected $table = 'buy_bills';

    // The attributes that are mass assignable.
    protected $fillable = [
        'buy_order_id', 'recieve_date', 'user_id', 'total_price', 'total_payment',
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    ##############################Relationships##############################
}
