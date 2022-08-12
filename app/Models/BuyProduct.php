<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuyProduct extends Model
{
    protected $table = 'buy_products';

    // The attributes that are mass assignable.
    protected $fillable = [
        'buy_order_id', 'product_id', 'quantity_order',
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    ##############################Relationships##############################

 /*   public function buyBills()
    {
        return $this->belongsToMany('App\Models\BuyBill', 'BuyBillProduct','buy_product_id', 'buy_bill_id', 'id', 'id');
    }

    public function buyOrder()
    {
        return $this->belongsTo('App\Models\BuyOrder', 'buy_order_id', 'id');
    }

    public function buyBillProducts()
    {
       return $this->hasMany('App\Models\BuyBillProduct', 'buy_bill_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }*/
}
