<?php

namespace App\Http\Controllers;

use App\Http\Custom\Response;
use App\Http\Resources\CouponResource;
use App\Http\Resources\MatchResource;
use App\Models\Coupon;
use App\Models\CouponPrivate;
use Illuminate\Http\Request;
/**
 * @group Coupon
 * @authenticated
 */
class CouponController extends Controller
{
    private $response         = null;

    public function __construct()
    {
        $this->user = auth('sanctum')->user();
        $this->response = new Response();
    }
    /**
     *
     * Coupon List
     *
     */
    public function index(Request $request){
        if ($this->user->role == 'free') {
            if ($request->input('status') === 'new') {
                $coupons = Coupon::where('type', 'free')->where('durum', 'Oynanmadı')->get();
            }

            if ($request->input('status') === 'old') {
                $coupons = Coupon::where('type', 'free')->where('durum', '!=', 'Oynanmadı')->get();
            }
        }

        if ($this->user->role == 'premium') {
            if ($request->input('status') === 'new') {
                $coupons = Coupon::where('type','premium')->where('durum', 'Oynanmadı')->get();
            }

            if ($request->input('status') === 'old') {
                $coupons = Coupon::where('type',  'premium')->where('durum', '!=', 'Oynanmadı')->get();
            }
        }

        if ($coupons->count() === 0) {
            return $this->response->withOutData(false, 'Kuponlar yok');
        }

        $items = $coupons->flatMap(function ($coupon) {
            return $coupon->items;
        });

        return $this->response->withData(true, 'Kuponlar listelendi', MatchResource::collection($items));
    }
    /**
     *
     * Coupon Special List
     *
     */
    public function private_list(Request $request)
    {

        if ($request->input('status') === 'new') {
            $coupons = Coupon::where('type', 'private')->where('durum', 'Oynanmadı')->get();
        }

        if ($request->input('status') === 'old') {
            $coupons = Coupon::where('type', 'private')->where('durum', '!=', 'Oynanmadı')->get();
        }


        if ($coupons->count() === 0) {
            return $this->response->withOutData(false, 'Özel Kuponlar yok');
        }

        $items = $coupons->flatMap(function ($coupon) {
            return $coupon->items;
        });

        return $this->response->withData(true, 'Özel Kuponlar listelendi', MatchResource::collection($items));
    }
    /**
     *
     * Coupon User Special List
     *
     */
    public function private(Request $request)
    {
        $couponPrivate = CouponPrivate::where('user_id', $this->user->id)->get();

        $couponIds = $couponPrivate->pluck('coupon_id');

        if ($request->input('status') === 'new') {
            $coupons = Coupon::whereIn('id', $couponIds)->where('durum', 'Oynanmadı')->get();
        }

        if ($request->input('status') === 'old') {
            $coupons = Coupon::whereIn('id', $couponIds)->where('durum', '!=', 'Oynanmadı')->get();
        }

        $items = $coupons->flatMap(function ($coupon) {
            return $coupon->items;
        });


        if($coupons->count() == 0)
        {
            return $this->response->withOutData(false, 'Özel Kuponlar yok');
        }


        return $this->response->withData(true, 'Özel Kuponlar listelendi', MatchResource::collection($items));
    }
    /**
     *
     * Coupon Special User Set
     *
     */
    public function private_set($id){
         CouponPrivate::create([
           'coupon_id' => $id,
           'user_id' => $this->user->id
        ]);

        return $this->response->withData(true,'Özel Kuponlar listelendi', []);
    }
}
