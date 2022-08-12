<?php

namespace App\PharmacyBranch;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Reckon extends Model
{
	 use SoftDeletes;

   protected $fillable=['paid','customer_id','b'];

    public function customer()
    {
        return $this->belongsTo('App\Customer','customer_id','id');
    }
}
