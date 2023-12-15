<?php

namespace App\Http\Controllers\ADMIN;

use App\Http\Controllers\Controller;
use App\Models\CouponItems;
use App\Models\CouponPrivate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\Coupon;

class CouponController extends Controller
{
    public function index()
    {
        $coupon = Coupon::where('type', '!=', 'private')->get();
        return view('admin.coupon.index',compact('coupon'));
    }

    public function coupon_priv_list()
    {
        $coupon = Coupon::where('type','private')->get();
        return view('admin.coupon.private',compact('coupon'));
    }

    public function coupon_priv_list_buy(){
        $coupon = CouponPrivate::all();
        return view('admin.coupon.private-list',compact('coupon'));
    }

    public function create()
    {
        return view('admin.coupon.action');
    }

    public function edit($id)
    {
        $coupon = Coupon::where('id',$id)->first();
        return view('admin.coupon.action',compact('coupon'));
    }

    public function save(Request $request)
    {
        $push = new Coupon();
        $push->type = $request->kuponTuru;
        $push->durum = 'Oynanmadı';
        $push->save();

        foreach ($request->kuponData['maclar'] as $maclar) {
            $item = new CouponItems();
            $item->coupon_id = $push->id;
            $item->tahmin = $maclar['tahmin'];
            $item->coupon_date = $maclar['tarih'];
            $item->oran = $maclar['oran'];
            $item->taraflar = $maclar['mbs'];
            $item->durum = 'Oynanmadı';
            $item->eventId = $maclar['kod'];
            $item->save();
        }

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $push = Coupon::where('id',$id)->delete();
        CouponItems::where('coupon_id',$id)->delete();
        CouponPrivate::where('coupon_id',$id)->delete();

        if ($push)
        {
            return back()->with('success', 'Başarıyla silindi.');
        }

        return back()->with('error', 'Silinirken bir hata oluştu.');
    }

    public function result()
    {
        $response = Http::get('https://www.birebin.com/api/stats/GetFinalResults?StartDate=2023/07/20');
        $data = $response->json();
        $futbolMatches = [];

        foreach ($data['Result'] as $match) {
            if ($match['sportName'] === 'Futbol') {
                $futbolMatches[] = $match;
            }
        }

        $coupons = CouponItems::where('durum','Oynanmadı')->get();

        foreach ($coupons as $coupon) {
            $eventId = $coupon->eventId;

            $matchResult = null;
            foreach ($futbolMatches as $match) {
                if ($match['eventId'] === $eventId) {
                    $matchResult = $match;
                    break;
                }
            }

            if ($matchResult !== null) {
                $tahmin = $coupon->tahmin;
                $durum = 'bekleniyor';

                if ($tahmin === 'Macsonucu Oran 1' && $matchResult['results'][0]['scoreParticipant1'] > $matchResult['results'][0]['scoreParticipant2']) {
                    $durum = 'kazandı';
                } elseif ($tahmin === 'Macsonucu Oran 2' && $matchResult['results'][0]['scoreParticipant2'] > $matchResult['results'][0]['scoreParticipant1']) {
                    $durum = 'kazandı';
                } elseif ($tahmin === 'Macsonucu Oran 3' && $matchResult['results'][0]['scoreParticipant1'] === $matchResult['results'][0]['scoreParticipant2']) {
                    $durum = 'kazandı';
                } elseif ($tahmin === 'KGVaryok Oran 1' && $matchResult['results'][0]['scoreParticipant1'] === '0' && $matchResult['results'][0]['scoreParticipant2'] === '0') {
                    $durum = 'kazandı';
                } elseif ($tahmin === 'KGVaryok Oran 2' && $matchResult['results'][0]['scoreParticipant1'] === '0' && $matchResult['results'][0]['scoreParticipant2'] === '0') {
                    $durum = 'kazandı';
                } elseif ($tahmin === 'Ciftesans Oran 1' && $matchResult['results'][0]['scoreParticipant1'] > $matchResult['results'][0]['scoreParticipant2']) {
                    $durum = 'kazandı';
                } elseif ($tahmin === 'Ciftesans Oran 2' && $matchResult['results'][0]['scoreParticipant2'] > $matchResult['results'][0]['scoreParticipant1']) {
                    $durum = 'kazandı';
                } elseif ($tahmin === 'Ciftesans Oran 3' && $matchResult['results'][0]['scoreParticipant1'] === $matchResult['results'][0]['scoreParticipant2']) {
                    $durum = 'kazandı';
                } elseif ($tahmin === 'Ilkyarisonucu Oran 1' && $matchResult['results'][1]['scoreParticipant1'] > $matchResult['results'][1]['scoreParticipant2']) {
                    $durum = 'kazandı';
                } elseif ($tahmin === 'Ilkyarisonucu Oran 2' && $matchResult['results'][1]['scoreParticipant2'] > $matchResult['results'][1]['scoreParticipant1']) {
                    $durum = 'kazandı';
                } elseif ($tahmin === 'Ilkyarisonucu Oran 3' && $matchResult['results'][1]['scoreParticipant1'] === $matchResult['results'][1]['scoreParticipant2']) {
                    $durum = 'kazandı';
                } else {
                    $durum = 'kaybetti';
                }

                $coupon->update(['durum' => $durum]);
                $coupon->coupon->update(['durum' => $durum]);

            }
        }

        return redirect()->back();
    }


}
