<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookIn extends Model
{
    use SoftDeletes;

    use \Znck\Eloquent\Traits\BelongsToThrough;

     protected $table = 'books_in';

    // The attributes that are mass assignable.
    protected $fillable = [
        'date', 'quantity', 'amount', 'is_active', 'product_place_id', 'branch_id', 'buy_bill_product_id', 'is_amount_notify', 'is_expired_notify',
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];


   ##############################Relationships##############################
    public function branch()
    {
        return $this->belongsTo('App\Branch','branch_id');
    }

    public function productPlace()
    {
        return $this->belongsTo('App\Models\ProductPlace', 'product_place_id', 'id');
    }

    public function buyBillProduct()
    {
    	return $this->belongsTo('App\Models\BuyBillProduct', 'buy_bill_product_id', 'id');
    }

    public function despoiledProduct()
    {
        return $this -> hasOne('App\Models\DespoiledProduct', 'batch_id', 'id');
    }

  /*  public function buyProduct()
    {
        return $this->belongsToThrough('App\Models\BuyProduct','App\Models\BuyBillProduct');
    }

    public function products()
    {
        return $this->belongsToThrough('App\Models\Product',['App\Models\BuyProduct', 'App\Models\BuyBillProduct']);
    }

    public function medicalSupplies()
    {
          return $this->belongsToThrough('App\Models\MedicalSupply',['App\Models\Product', 'App\Models\BuyProduct', 'App\Models\BuyBillProduct'], null, '', ['App\Models\MedicalSupply' => 'id']);

       // return DB::table('medical_supplies')->join($r = $this->belongsToThrough('App\Models\Product',['App\Models\BuyProduct', 'App\Models\BuyBillProduct']), 'medical_supplies.product_id', '=', 'id');

    }*/


}
