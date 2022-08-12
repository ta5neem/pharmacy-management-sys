<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $table = 'inventories';

    // The attributes that are mass assignable.
    protected $fillable = [
        'product_id', 'product_amount'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    ##############################Relationships##############################

   /* public function buyBillProducts()
    {
    	return $this -> belongsToMany('App\Models\BuyBillProduct', 'BookIn', 'inventory_id','buy_bill_product_id', 'id', 'id');
    }*/
}
