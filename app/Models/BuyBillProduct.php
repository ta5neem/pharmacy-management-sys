<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuyBillProduct extends Model
{
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $table = 'buy_bill_products';

    // The attributes that are mass assignable.
    protected $fillable = [
        'buy_bill_id','buy_product_id', 'production_date', 'expired_date',
        'quantity_recived', 'available_quantity', 'purchasing_price', 'selling_price', 'reverse'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    ##############################Relationships##############################

    public function booksIn()
    {
        return $this->hasMany('App\Models\BookIn', 'buy_bill_product_id', 'id');
    }


    public function user()
    {
        return $this->belongsToThrough('App\User',['App\Models\BuyOrder', 'App\Models\BuyBill']);
    }
}
