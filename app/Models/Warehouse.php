<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $table = 'warehouses';

    // The attributes that are mass assignable.
    protected $fillable = [
        'name_warehouse', 'address', 'mobile', 'email',
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    ##############################Relationships##############################

    /*public function buyOrders()
    {
    	return $this->hasMany('App\Models\BuyOrder', 'ware_house_id', 'id');
    }*/
}
