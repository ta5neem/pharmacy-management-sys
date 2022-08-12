<?php

namespace App\PharmacyBranch;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Branch extends Model
{
       use SoftDeletes;

     public function users()
    {
        return $this->hasMany('App\User','branch_id','id');
    }
     public function location()
    {
    	return $this->belongsTo('App\Location','location_id');
    }
       public function invoices()
    {
        return $this->hasMany('App\Invoice');
    }

     public function return_invoices()
    {
        return $this->hasMany('App\ReturnInvoice');
    }

    public function reckons()
    {
        return $this->hasManyThrough('App\Reckon', 'App\User');
    }

    public function booksIn()
    {
        return $this->hasMany('App\Models\BooIn', 'pharmacy_id', 'id');
    }

    public function buyBillProducts()
    {
        return $this -> belongsToMany('App\Models\BuyBillProduct', 'books_in', 'pharmacy_id','buy_bill_product_id', 'id', 'id');
    }
}
