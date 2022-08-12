<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuyOrder extends Model
{
   protected $table = 'buy_orders';

    // The attributes that are mass assignable.
    protected $fillable = [
        'warehouse_id', 'user_id', 'order_date'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    ##############################Relationships##############################

   /* public function wareHouse()
     {
    	return $this->belongsTo('App\Models\WareHouse', 'ware_house_id', 'id');
     }

    public function products()
     {
        return $this->belongsToMany('App\Models\Product', 'BuyProduct','buy_order_id', 'product_id', 'id', 'id');
     }

    public function buyBills()
     {
        return $this->hasMany('App\Models\BuyBill', 'buy_order_id', 'id');
     }

    public function user()
     {
         return $this->belongsTo('App\Models\User', 'user_id', 'id');
     }

     public function buyProducts()
     {
        return $this->hasMany('App\Models\BuyProduct', 'buy_order_id', 'id');
     }

     public function buyBillProducts()
    {
    	return $this->hasManyThrough(BuyBillProduct::class, BuyProduct::class, 'buy_order_id', 'buy_product_id', 'id', 'id');
    }*/

}
