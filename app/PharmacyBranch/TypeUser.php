<?php

namespace App\PharmacyBranch;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class TypeUser extends Model
{
   use SoftDeletes;

      protected $fillable = [
       'type',
    ];
}
