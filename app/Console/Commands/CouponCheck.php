<?php

namespace App\Console\Commands;

use App\Models\CouponItems;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class CouponCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'coupon:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Coupon Check';

    /**
     * Execute the console command.
     */
    public function handle()
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

        return true;
    }
}
