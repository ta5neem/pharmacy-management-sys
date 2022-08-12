<?php

namespace App\PharmacyBranch;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;
   use SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','salary','working_hours','branch_id','type_id','mobile','vacations', 'permissions'   ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

     ##############################Relationships##############################

public function buyOrders()
{
   return $this->hasMany('App\Models\BuyOrder', 'user_id', 'id');
}

public function buyProducts()
{
   return $this->hasManyThrough(BuyProduct::class, BuyOrder::class, 'user_id', 'buy_order_id', 'id', 'id');
}

public function buyBillProducts()
{
   $buyBillProducts = [];
   foreach ($this -> buyProducts as $buyProduct)
    {
      $buyBillProducts[] = $buyProduct -> buyBillProducts;
    }
   return  $buyBillProducts;
}

public function invoices()
{
    return $this->hasMany('App\Invoice','user_id','id');
}
   public function branch()
{
    return $this->belongsTo('App\Branch','branch_id');
}
  public function type()
{
    return $this->belongsTo('App\TypeUser','type_id');
}
  


}

