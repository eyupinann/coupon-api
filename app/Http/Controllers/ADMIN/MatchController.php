<?php

namespace App\Http\Controllers\ADMIN;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MatchController extends Controller
{
    /**
     *
     * All Data Match List
     *
     */
    public function oran()
    {
        $response = Http::get('https://www.skormerkezi.com/fomoco_v1/maclar/2');
        $datas = $response->json();

        Carbon::setLocale('tr');

        $currentDate = Carbon::now();

        $formattedDate = $currentDate->isoFormat('D MMMM dddd');

        $filteredMatches = array_filter($datas, function ($match) use ($formattedDate) {
            return isset($match['Tarih'][0]) && $match['Tarih'][0] === $formattedDate;
        });

        $data = array_values($filteredMatches);

        $responses = Http::get('http://goapi.mackolik.com/livedata?group=0');
        $search = $responses->json();
        $maclar = $search['m'];

        if ($response->successful()) {
            $categories = [];

            foreach ($data as $match) {
                $category = [];
                $category['Tarih'] = $match['Tarih'][0] . ' ' . $match['Tarih'][1];
                $category['Lig'] = $match['Lig'];
                $category['Mbs'] = $match['Kod'];
                $category['Taraflar'] = $match['Taraflar'];

                $taraflar = explode(' - ', $category['Taraflar']);

                $category['Oranlar'] = [];

                if (isset($match['Oranlar']['macsonucu']) && isset($match['Oranlar']['macsonucu'][1])) {
                    $category['Oranlar']['macsonucu']['1'] = [
                        'oran' => $match['Oranlar']['macsonucu'][1][0],
                        'sonuc' => $match['Oranlar']['macsonucu'][1][1],
                    ];
                    $category['Oranlar']['macsonucu']['2'] = [
                        'oran' => $match['Oranlar']['macsonucu'][2][0],
                        'sonuc' => $match['Oranlar']['macsonucu'][2][1],
                    ];
                    $category['Oranlar']['macsonucu']['3'] = [
                        'oran' => $match['Oranlar']['macsonucu'][3][0],
                        'sonuc' => $match['Oranlar']['macsonucu'][3][1],
                    ];
                } else {
                    $category['Oranlar']['macsonucu']['1'] = null;
                }
                if (isset($match['Oranlar']['altust25']) && isset($match['Oranlar']['altust25'][1])) {
                    $category['Oranlar']['altust25']['1'] = [
                        'oran' => $match['Oranlar']['altust25'][1][0],
                        'sonuc' => $match['Oranlar']['altust25'][1][1],
                    ];
                    $category['Oranlar']['altust25']['2'] = [
                        'oran' => $match['Oranlar']['altust25'][2][0],
                        'sonuc' => $match['Oranlar']['altust25'][2][1],
                    ];
                }

                if (isset($match['Oranlar']['kgvaryok']) && isset($match['Oranlar']['kgvaryok'][1])) {
                    $category['Oranlar']['kgvaryok']['1'] = [
                        'oran' => $match['Oranlar']['kgvaryok'][1][0],
                        'sonuc' => $match['Oranlar']['kgvaryok'][1][1],
                    ];
                    $category['Oranlar']['kgvaryok']['2'] = [
                        'oran' => $match['Oranlar']['kgvaryok'][2][0],
                        'sonuc' => $match['Oranlar']['kgvaryok'][2][1],
                    ];
                }

                if (isset($match['Oranlar']['ciftesans']) && isset($match['Oranlar']['ciftesans'][1])) {
                    $category['Oranlar']['ciftesans']['1'] = [
                        'oran' => $match['Oranlar']['ciftesans'][1][0],
                        'sonuc' => $match['Oranlar']['ciftesans'][1][1],
                    ];
                    $category['Oranlar']['ciftesans']['2'] = [
                        'oran' => $match['Oranlar']['ciftesans'][2][0],
                        'sonuc' => $match['Oranlar']['ciftesans'][2][1],
                    ];
                    $category['Oranlar']['ciftesans']['3'] = [
                        'oran' => $match['Oranlar']['ciftesans'][3][0],
                        'sonuc' => $match['Oranlar']['ciftesans'][3][1],
                    ];
                }

                if (isset($match['Oranlar']['ciftesans']) && isset($match['Oranlar']['ciftesans'][1])) {
                    $category['Oranlar']['ciftesans']['1'] = [
                        'oran' => $match['Oranlar']['ciftesans'][1][0],
                        'sonuc' => $match['Oranlar']['ciftesans'][1][1],
                    ];
                    $category['Oranlar']['ciftesans']['2'] = [
                        'oran' => $match['Oranlar']['ciftesans'][2][0],
                        'sonuc' => $match['Oranlar']['ciftesans'][2][1],
                    ];
                    $category['Oranlar']['ciftesans']['3'] = [
                        'oran' => $match['Oranlar']['ciftesans'][3][0],
                        'sonuc' => $match['Oranlar']['ciftesans'][3][1],
                    ];
                }
                if (isset($match['Oranlar']['ilkyarisonucu']) && isset($match['Oranlar']['ilkyarisonucu'][1])) {
                    $category['Oranlar']['ilkyarisonucu']['1'] = [
                        'oran' => $match['Oranlar']['ilkyarisonucu'][1][0],
                        'sonuc' => $match['Oranlar']['ilkyarisonucu'][1][1],
                    ];
                    $category['Oranlar']['ilkyarisonucu']['2'] = [
                        'oran' => $match['Oranlar']['ilkyarisonucu'][2][0],
                        'sonuc' => $match['Oranlar']['ilkyarisonucu'][2][1],
                    ];
                    $category['Oranlar']['ilkyarisonucu']['3'] = [
                        'oran' => $match['Oranlar']['ilkyarisonucu'][3][0],
                        'sonuc' => $match['Oranlar']['ilkyarisonucu'][3][1],
                    ];
                }
                if (isset($match['Oranlar']['toplamgol']) && isset($match['Oranlar']['toplamgol'][1])) {
                    $category['Oranlar']['toplamgol']['1'] = [
                        'oran' => $match['Oranlar']['toplamgol'][1][0],
                        'sonuc' => $match['Oranlar']['toplamgol'][1][1],
                    ];
                    $category['Oranlar']['toplamgol']['2'] = [
                        'oran' => $match['Oranlar']['toplamgol'][2][0],
                        'sonuc' => $match['Oranlar']['toplamgol'][2][1],
                    ];
                    $category['Oranlar']['toplamgol']['3'] = [
                        'oran' => $match['Oranlar']['toplamgol'][3][0],
                        'sonuc' => $match['Oranlar']['toplamgol'][3][1],
                    ];
                    $category['Oranlar']['toplamgol']['4'] = [
                        'oran' => $match['Oranlar']['toplamgol'][4][0],
                        'sonuc' => $match['Oranlar']['toplamgol'][4][1],
                    ];
                }
                if (isset($match['Oranlar']['altust15']) && isset($match['Oranlar']['altust15'][1])) {
                    $category['Oranlar']['altust15']['1'] = [
                        'oran' => $match['Oranlar']['altust15'][1][0],
                        'sonuc' => $match['Oranlar']['altust15'][1][1],
                    ];
                    $category['Oranlar']['altust15']['2'] = [
                        'oran' => $match['Oranlar']['altust15'][2][0],
                        'sonuc' => $match['Oranlar']['altust15'][2][1],
                    ];
                }
                if (isset($match['Oranlar']['ilkyarimacsonucu']) && isset($match['Oranlar']['ilkyarimacsonucu'][1])) {
                    $category['Oranlar']['ilkyarimacsonucu']['1'] = [
                        'oran' => $match['Oranlar']['ilkyarimacsonucu'][1][0],
                        'sonuc' => $match['Oranlar']['ilkyarimacsonucu'][1][1],
                    ];
                    $category['Oranlar']['ilkyarimacsonucu']['2'] = [
                        'oran' => $match['Oranlar']['ilkyarimacsonucu'][2][0],
                        'sonuc' => $match['Oranlar']['ilkyarimacsonucu'][2][1],
                    ];
                    $category['Oranlar']['ilkyarimacsonucu']['3'] = [
                        'oran' => $match['Oranlar']['ilkyarimacsonucu'][3][0],
                        'sonuc' => $match['Oranlar']['ilkyarimacsonucu'][3][1],
                    ];
                    $category['Oranlar']['ilkyarimacsonucu']['4'] = [
                        'oran' => $match['Oranlar']['ilkyarimacsonucu'][4][0],
                        'sonuc' => $match['Oranlar']['ilkyarimacsonucu'][4][1],
                    ];
                    $category['Oranlar']['ilkyarimacsonucu']['5'] = [
                        'oran' => $match['Oranlar']['ilkyarimacsonucu'][5][0],
                        'sonuc' => $match['Oranlar']['ilkyarimacsonucu'][5][1],
                    ];
                    $category['Oranlar']['ilkyarimacsonucu']['6'] = [
                        'oran' => $match['Oranlar']['ilkyarimacsonucu'][6][0],
                        'sonuc' => $match['Oranlar']['ilkyarimacsonucu'][6][1],
                    ];
                    $category['Oranlar']['ilkyarimacsonucu']['7'] = [
                        'oran' => $match['Oranlar']['ilkyarimacsonucu'][7][0],
                        'sonuc' => $match['Oranlar']['ilkyarimacsonucu'][7][1],
                    ];
                    $category['Oranlar']['ilkyarimacsonucu']['8'] = [
                        'oran' => $match['Oranlar']['ilkyarimacsonucu'][8][0],
                        'sonuc' => $match['Oranlar']['ilkyarimacsonucu'][8][1],
                    ];
                    $category['Oranlar']['ilkyarimacsonucu']['9'] = [
                        'oran' => $match['Oranlar']['ilkyarimacsonucu'][9][0],
                        'sonuc' => $match['Oranlar']['ilkyarimacsonucu'][9][1],
                    ];
                }


                foreach ($maclar as $item) {
                    if (is_array($item)) {
                        if (stripos($item[2], $taraflar[0]) !== false || stripos($item[4], $taraflar[0]) !== false) {
                            $category['takim1_logo'] = 'http://im.cdn.md/img/logo/buyuk/' . (($item[2] == $taraflar[0]) ? $item[1] : (($item[4] == $taraflar[0]) ? $item[3] : null)) . '.gif';
                        }
                        if (stripos($item[2], $taraflar[1]) !== false || stripos($item[4], $taraflar[1]) !== false) {
                            $category['takim2_logo'] = 'http://im.cdn.md/img/logo/buyuk/' . (($item[2] == $taraflar[1]) ? $item[1] : (($item[4] == $taraflar[1]) ? $item[3] : null)) . '.gif';
                        }
                    }
                }

                $categories[] = $category;
            }


            return view('admin.match.index',compact('categories'));
        } else {
            $errorMessage = $data['message'];
        }
    }

    public function daily()
    {
        $date = str_replace('-', '/', $date ??'14/07/2023');

        $response = Http::get('http://goapi.mackolik.com/livedata', [
            'date' => $date,
        ]);

        $data = $response->json();

        if ($response->successful()) {
            $matches = $data['m'];

            $categories = [];

            foreach ($matches as $match) {
                $category = [];
                $category['macid'] = $match[14];
                $category['saat'] = $match[16];
                $category['lig'] = $match[36][1] . "-" . $match[36][3];
                $category['ligl'] = 'http://im.cdn.md/img/groups/' . $match[36][0] . '.gif';
                $category['ev'] = $match[2];
                $category['dep'] = $match[4];
                $category['iy'] = $match[7];
                $category['ms'] = $match[12] . "-" . $match[13];

                $categories[] = $category;
            }

            return view('admin.match.daily',compact('categories'));
        } else {
            $errorMessage = $data['message'];
        }

    }

    public function live()
    {
        $response = Http::get('http://goapi.mackolik.com/livedata?group=0');

        $data = $response->json();

        if ($response->successful()) {
            $maclar = $data['m'];
            $v = "0";

            $sayi = count($maclar);
            for ($i = 0; $i < $sayi; $i++) {
                if (empty($maclar[$i][6]) || $maclar[$i][6] == "MS" || $maclar[$i][6] == "Hük." || $maclar[$i][6] == "YrdK" || $maclar[$i][6] == "Ert." || $maclar[$i][6] == "UZ" || $maclar[$i][6] == "Pen" || $maclar[$i][36][11] != 1 || $maclar[$i][36][9] == "HAZ") {
                    unset($maclar[$i]);
                } else {
                    $mac[$v] = $maclar[$i];
                    $v++;
                }
            }

            $categories = [];

            foreach ($maclar as $match) {
                $tip = $match[36][11];
                if ($tip == 1) {
                    $category = [];
                    $category['macid'] = $match[14];
                    $category['saat'] = $match[16];
                    $category['lig'] = $match[36][1] . "-" . $match[36][3];
                    $category['ligl'] = 'http://im.cdn.md/img/groups/' . $match[36][0] . '.gif';
                    $category['ev'] = $match[2];
                    $category['konuk'] = $match[4];
                    $category['dk'] = $match[6];
                    $category['evgol'] = $match[12];
                    $category['depgol'] = $match[13];
                    $category['iy'] = $match[7];
                    $category['skor'] = $match[12] . "-" . $match[13];

                    $categories[] = $category;
                }
            }

            return view('admin.match.live',compact('categories'));

        } else {
            $errorMessage = $data['message'];
        }

    }
}
