<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponPrivate extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function coupon(){
        return $this->hasOne(Coupon::class,'id','coupon_id');
    }

    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }

}
