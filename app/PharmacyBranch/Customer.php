<?php

namespace App\PharmacyBranch;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Customer extends Model
{
     use SoftDeletes;

      protected $fillable= ['name','mobile','reckoning'];
         public function invoices()
    {
        return $this->hasMany('App\Invoice','customer_id','id');
    }
          public function return_invoices()
    {
        return $this->hasMany('App\ReturnInvoice','customer_id','id');
    }
  
     public function reckons()
    {
        return $this->hasMany('App\Reckon','customer_id','id');
    }


}
 // @foreach( $one-> comments()->get() as $comment)