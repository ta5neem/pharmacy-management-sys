<?php

namespace App\PharmacyBranch;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ReturnInvoice extends Model
{
     use SoftDeletes;

    protected $fillable=['user_id','customer_id','branch_id','total_due','total_num'];


         public function invoiceReturn_invoiceProduct()
    {
        return $this->hasMany('App\IrIp','ri_id','id');
    }       
   public function User()
    {
        return $this->belongsTo('App\User','user_id');
    }
  public function customer()
    {
        return $this->belongsTo('App\Customer','customer_id');
    }

 public function branch()
    {
        return $this->belongsTo('App\Branch','branch_id');
    }
}
