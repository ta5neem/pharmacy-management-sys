<?php

namespace App\PharmacyBranch;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Invoice_Products extends Model
{
   use SoftDeletes;

     
   protected $fillable=['invoice_id','bookIn_id','product_num','product_return','product_price','product_name'];

      public function book_in()
     {
         return $this->belongsTo('App\Models\BookIn','bookIn_id');
     }
     public function invoice()
    {
        return $this->belongsTo('App\Invoice','invoice_id');
    }

 public function branch()
    {
        return $this->belongsTo('App\Branch','branch_id');
    }

}
