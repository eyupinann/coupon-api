<?php

namespace App\Http\Controllers;

use App\Http\Custom\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

/**
 * @group Match
 * @authenticated
 */
class MatchController extends Controller
{
    private $response = null;

    public function __construct()
    {
        $this->response = new Response();
    }
    /**
     *
     * Date Filter Match List
     *
     * @param   $date
     * @return \Illuminate\Http\Response
     * @authenticated
     */

    public function daily($date)
    {
        $date = str_replace('-', '/', $date);

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

            return $this->response->withData(true, "Gönderdiğiniz gündeki maçlar başarıyla listelendi.",$categories);
        } else {
            $errorMessage = $data['message'];
            // Hata işleme yapabilirsiniz
        }

    }

    /**
     *
     * Live Match List
     *
     */
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

            return $this->response->withData(true, "Canlı maçlar başarıyla listelendi.",$categories);
        } else {
            $errorMessage = $data['message'];

        }

    }

    /**
     *
     * All Data Match List
     *
     */
    public function oran()
    {
        $response = Http::get('https://www.skormerkezi.com/fomoco_v1/maclar/2');
        $data = $response->json();


        if ($response->successful()) {
            $categories = [];

            foreach ($data as $match) {
                $category = [];
                $category['Tarih'] = $match['Tarih'][0] . ' ' . $match['Tarih'][1];
                $category['Lig'] = $match['Tarih'];
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
                }




                $categories[] = $category;
            }

            return $this->response->withData(true, "Oranlar başarıyla listelendi.",$categories);
        } else {
            $errorMessage = $data['message'];
        }
    }
}
