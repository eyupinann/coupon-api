<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponItems extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function coupon(){
        return $this->hasOne(Coupon::class,'id','coupon_id');
    }
}
