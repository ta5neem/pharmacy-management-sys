<?php

namespace App\PharmacyBranch;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class IrIp extends Model
{
	   use SoftDeletes;

		 protected $fillable= ['ip_id','ri_id','num_pr'];
    

 public function return_invoice()
    {
        return $this->belongsTo('App\ReturnInvoice','ri_id');
    }

 public function invoice_product()
    {
        return $this->belongsTo('App\Invoice_Products','ip_id');
    }

}
