@extends('admin.layout.index')
@push('css')
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/datatables.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/datatable-extension.css">
    <style>
        #export-button, #export-button th, #export-button td {
            font-size: 12px;
        }
        .orandetay {
            width: 600px;
        }
        .oranbolge {
            position: relative;
            float: left;
            width: calc(50% - 4px);
            padding: 2px;
        }
        .altoran {
            position: relative;
            float: left;
            padding: 5px;
            width: calc(100% - 12px);
            border: 2px solid #3e3a3a;
            border-radius: 4px;
            margin-bottom: 2px;
            margin-top: 2px;
            background: #5f767c;
        }
        .altoranbaslik {
            text-align: center;
            padding-top: 4px;
            padding-bottom: 5px;
            font-weight: bold;
            font-size: 12px;
            margin-bottom: 4px;
            color: gray;
            background: #202020;
            border-radius: 2px;
        }
        .uclu {
            position: relative;
            float: left;
            background: #E6ECF0;
            padding: 5px;
            padding-top: 9px;
            padding-bottom: 9px;
            margin-left: 1px;
            margin-right: 1px;
            margin-top: 1px;
            margin-bottom: 3px;
            border-radius: 2px;
            cursor: pointer;
            width: calc(33% - 3px);
        }
        .aos {
            position: relative;
            float: left;
            margin-left: 5px;
            width: calc(50% - 5px);
            font-weight: bold;
        }
        .aod {
            position: relative;
            float: left;
            right: 5px;
            width: calc(50% - 5px);
            text-align: right;
        }
    </style>

@endpush
<!-- Page Sidebar Ends-->
@section('content')
    <div class="page-body pt-5 ">

        <div class="container-fluid">
            <div class="row">
                <div class="col-9">
                    <div class="card">
                        @if(session()->has('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                        @if(session()->has('error'))
                            <div class="alert alert-error">
                                {{ session()->get('error') }}
                            </div>
                        @endif
                        <div class="card-header">
                            <h5>Maç Listesi</h5>
                        </div>
                        <div class="card-body">
                            <div class="dt-ext table-responsive">
                                <table class="display" id="export-button">
                                    <thead>
                                    <tr>
                                        <th>Kod</th>
                                        <th>Tarih</th>
                                        <th>Taraflar</th>
                                        <th>MS 1</th>
                                        <th>MS 0</th>
                                        <th>MS 2</th>
                                        <th>1.5 Üst</th>
                                        <th>1.5 Alt</th>
                                        <th>KG Var</th>
                                        <th>KG Yok</th>
                                        <th> </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($categories as $key => $category)
                                        <tr>
                                            <td>{{ $category['Mbs'] }}</td>
                                            <td>{{ $category['Tarih']}}</td>
                                            <td>{{ $category['Taraflar'] }}</td>
                                            <td>{{ $category['Oranlar']['macsonucu'][1]['oran'] ?? '' }}</td>
                                            <td>{{ $category['Oranlar']['macsonucu'][2]['oran'] ?? '' }}</td>
                                            <td>{{ $category['Oranlar']['macsonucu'][3]['oran'] ?? '' }}</td>
                                            <td>{{ $category['Oranlar']['altust15'][1]['oran'] ?? '' }}</td>
                                            <td>{{ $category['Oranlar']['altust15'][2]['oran'] ?? ''}}</td>
                                            <td>{{ $category['Oranlar']['kgvaryok'][1]['oran'] ?? '' }}</td>
                                            <td>{{ $category['Oranlar']['kgvaryok'][2]['oran'] ?? ''}}</td>
                                            <td>
                                                <button class="btn btn-primary detay-button" data-target="{{ $category['Mbs'] }}">Detay</button>
                                            </td>
                                        </tr>
                                        <div class="details-row" id="details-row-{{ $category['Mbs'] }}" style="display: none;">
                                            <div class="orandetay alt1178149">
                                                <div class="oranbolge">
                                                    <div class="altoran">
                                                        <div class="katman altoranbaslik">Maç Sonucu</div>
                                                        <div class="katman altoranlar">
                                                            <div class="uclu">
                                                                <div class="mbs" style="display: none">{{ $category['Mbs'] }}</div>
                                                                <div class="trh" style="display: none">{{ $category['Tarih']}}</div>
                                                                <div class="trf" style="display: none">{{ $category['Taraflar']}}</div>
                                                                <div class="thm" style="display: none">MS</div>
                                                                <div class="aos">1</div>
                                                                <div class="aod">{{ $category['Oranlar']['macsonucu'][1]['oran'] ?? '' }}</div>
                                                            </div>
                                                            <div class="uclu">
                                                                <div class="mbs" style="display: none">{{ $category['Mbs'] }}</div>
                                                                <div class="trh" style="display: none">{{ $category['Tarih']}}</div>
                                                                <div class="trf" style="display: none">{{ $category['Taraflar']}}</div>
                                                                <div class="thm" style="display: none">MS</div>
                                                                <div class="aos">0</div>
                                                                <div class="aod">{{ $category['Oranlar']['macsonucu'][2]['oran'] ?? '' }}</div>
                                                            </div>
                                                            <div class="uclu">
                                                                <div class="mbs" style="display: none">{{ $category['Mbs'] }}</div>
                                                                <div class="trh" style="display: none">{{ $category['Tarih']}}</div>
                                                                <div class="trf" style="display: none">{{ $category['Taraflar']}}</div>
                                                                <div class="thm" style="display: none">MS</div>
                                                                <div class="aos">2</div>
                                                                <div class="aod">{{ $category['Oranlar']['macsonucu'][3]['oran'] ?? '' }}</div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="altoran">
                                                        <div class="katman altoranbaslik">İlk yarı / Maç sonucu</div>
                                                        <div class="katman altoranlar">
                                                            <div class="uclu">
                                                                <div class="mbs" style="display: none">{{ $category['Mbs'] }}</div>
                                                                <div class="trh" style="display: none">{{ $category['Tarih']}}</div>
                                                                <div class="trf" style="display: none">{{ $category['Taraflar']}}</div>
                                                                <div class="thm" style="display: none">İY-MS</div>
                                                                <div class="aos">{{ $category['Oranlar']['ilkyarimacsonucu'][1]['sonuc'] ?? ''}}</div>
                                                                <div class="aod">{{ $category['Oranlar']['ilkyarimacsonucu'][1]['oran'] ?? ''}}</div>
                                                            </div>
                                                            <div class="uclu">
                                                                <div class="mbs" style="display: none">{{ $category['Mbs'] }}</div>
                                                                <div class="trh" style="display: none">{{ $category['Tarih']}}</div>
                                                                <div class="trf" style="display: none">{{ $category['Taraflar']}}</div>
                                                                <div class="thm" style="display: none">İY-MS</div>
                                                                <div class="aos">{{ $category['Oranlar']['ilkyarimacsonucu'][2]['sonuc'] ?? ''}}</div>
                                                                <div class="aod">{{ $category['Oranlar']['ilkyarimacsonucu'][2]['oran'] ?? ''}}</div>
                                                            </div>
                                                            <div class="uclu">
                                                                <div class="mbs" style="display: none">{{ $category['Mbs'] }}</div>
                                                                <div class="trh" style="display: none">{{ $category['Tarih']}}</div>
                                                                <div class="trf" style="display: none">{{ $category['Taraflar']}}</div>
                                                                <div class="thm" style="display: none">İY-MS</div>
                                                                <div class="aos">{{ $category['Oranlar']['ilkyarimacsonucu'][3]['sonuc'] ?? ''}}</div>
                                                                <div class="aod">{{ $category['Oranlar']['ilkyarimacsonucu'][3]['oran'] ?? ''}}</div>
                                                            </div>
                                                            <div class="uclu">
                                                                <div class="mbs" style="display: none">{{ $category['Mbs'] }}</div>
                                                                <div class="trh" style="display: none">{{ $category['Tarih']}}</div>
                                                                <div class="trf" style="display: none">{{ $category['Taraflar']}}</div>
                                                                <div class="thm" style="display: none">MS</div>
                                                                <div class="aos">{{ $category['Oranlar']['ilkyarimacsonucu'][4]['sonuc'] ?? ''}}</div>
                                                                <div class="aod">{{ $category['Oranlar']['ilkyarimacsonucu'][4]['oran'] ?? ''}}</div>
                                                            </div>
                                                            <div class="uclu">
                                                                <div class="mbs" style="display: none">{{ $category['Mbs'] }}</div>
                                                                <div class="trh" style="display: none">{{ $category['Tarih']}}</div>
                                                                <div class="trf" style="display: none">{{ $category['Taraflar']}}</div>
                                                                <div class="thm" style="display: none">MS</div>
                                                                <div class="aos">{{ $category['Oranlar']['ilkyarimacsonucu'][5]['sonuc'] ?? ''}}</div>
                                                                <div class="aod">{{ $category['Oranlar']['ilkyarimacsonucu'][5]['oran'] ?? ''}}</div>
                                                            </div>
                                                            <div class="uclu">
                                                                <div class="mbs" style="display: none">{{ $category['Mbs'] }}</div>
                                                                <div class="trh" style="display: none">{{ $category['Tarih']}}</div>
                                                                <div class="trf" style="display: none">{{ $category['Taraflar']}}</div>
                                                                <div class="thm" style="display: none">MS</div>
                                                                <div class="aos">{{ $category['Oranlar']['ilkyarimacsonucu'][6]['sonuc'] ?? ''}}</div>
                                                                <div class="aod">{{ $category['Oranlar']['ilkyarimacsonucu'][6]['oran'] ?? ''}}</div>
                                                            </div>
                                                            <div class="uclu">
                                                                <div class="mbs" style="display: none">{{ $category['Mbs'] }}</div>
                                                                <div class="trh" style="display: none">{{ $category['Tarih']}}</div>
                                                                <div class="trf" style="display: none">{{ $category['Taraflar']}}</div>
                                                                <div class="thm" style="display: none">MS</div>
                                                                <div class="aos">{{ $category['Oranlar']['ilkyarimacsonucu'][7]['sonuc'] ?? ''}}</div>
                                                                <div class="aod">{{ $category['Oranlar']['ilkyarimacsonucu'][7]['oran'] ?? ''}}</div>
                                                            </div>
                                                            <div class="uclu">
                                                                <div class="mbs" style="display: none">{{ $category['Mbs'] }}</div>
                                                                <div class="trh" style="display: none">{{ $category['Tarih']}}</div>
                                                                <div class="trf" style="display: none">{{ $category['Taraflar']}}</div>
                                                                <div class="thm" style="display: none">MS</div>
                                                                <div class="aos">{{ $category['Oranlar']['ilkyarimacsonucu'][8]['sonuc'] ?? ''}}</div>
                                                                <div class="aod">{{ $category['Oranlar']['ilkyarimacsonucu'][8]['oran'] ?? ''}}</div>
                                                            </div>
                                                            <div class="uclu">
                                                                <div class="mbs" style="display: none">{{ $category['Mbs'] }}</div>
                                                                <div class="trh" style="display: none">{{ $category['Tarih']}}</div>
                                                                <div class="trf" style="display: none">{{ $category['Taraflar']}}</div>
                                                                <div class="thm" style="display: none">MS</div>
                                                                <div class="aos">{{ $category['Oranlar']['ilkyarimacsonucu'][9]['sonuc'] ?? ''}}</div>
                                                                <div class="aod">{{ $category['Oranlar']['ilkyarimacsonucu'][9]['oran'] ?? ''}}</div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="altoran">
                                                        <div class="katman altoranbaslik">Toplam Gol</div>
                                                        <div class="katman altoranlar">
                                                            <div class="uclu">
                                                                <div class="mbs" style="display: none">{{ $category['Mbs'] }}</div>
                                                                <div class="trh" style="display: none">{{ $category['Tarih']}}</div>
                                                                <div class="trf" style="display: none">{{ $category['Taraflar']}}</div>
                                                                <div class="thm" style="display: none">MS</div>
                                                                <div class="aos">{{ $category['Oranlar']['toplamgol'][1]['oran'] ?? ''}}</div>
                                                                <div class="aod">{{ $category['Oranlar']['toplamgol'][1]['sonuc'] ?? ''}}</div>
                                                            </div>
                                                        </div>

                                                        <div class="katman altoranlar">
                                                            <div class="uclu">
                                                                <div class="mbs" style="display: none">{{ $category['Mbs'] }}</div>
                                                                <div class="trh" style="display: none">{{ $category['Tarih']}}</div>
                                                                <div class="trf" style="display: none">{{ $category['Taraflar']}}</div>
                                                                <div class="thm" style="display: none">MS</div>
                                                                <div class="aos">{{ $category['Oranlar']['toplamgol'][2]['oran'] ?? ''}}</div>
                                                                <div class="aod">{{ $category['Oranlar']['toplamgol'][2]['sonuc'] ?? ''}}</div>
                                                            </div>
                                                        </div>
                                                        <div class="katman altoranlar">
                                                            <div class="uclu">
                                                                <div class="mbs" style="display: none">{{ $category['Mbs'] }}</div>
                                                                <div class="trh" style="display: none">{{ $category['Tarih']}}</div>
                                                                <div class="trf" style="display: none">{{ $category['Taraflar']}}</div>
                                                                <div class="thm" style="display: none">MS</div>
                                                                <div class="aos">{{ $category['Oranlar']['toplamgol'][3]['oran'] ?? ''}}</div>
                                                                <div class="aod">{{ $category['Oranlar']['toplamgol'][3]['sonuc'] ?? ''}}</div>
                                                            </div>
                                                        </div>
                                                        <div class="katman altoranlar">
                                                            <div class="uclu">
                                                                <div class="mbs" style="display: none">{{ $category['Mbs'] }}</div>
                                                                <div class="trh" style="display: none">{{ $category['Tarih']}}</div>
                                                                <div class="trf" style="display: none">{{ $category['Taraflar']}}</div>
                                                                <div class="thm" style="display: none">MS</div>
                                                                <div class="aos">{{ $category['Oranlar']['toplamgol'][4]['oran'] ?? ''}}</div>
                                                                <div class="aod">{{ $category['Oranlar']['toplamgol'][4]['sonuc'] ?? ''}}</div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                <div class="altoran">
                                                    <div class="katman altoranbaslik">Alt/Üst 1.5</div>
                                                    <div class="katman altoranlar">
                                                        <div class="uclu">
                                                            <div class="mbs" style="display: none">{{ $category['Mbs'] }}</div>
                                                            <div class="trh" style="display: none">{{ $category['Tarih']}}</div>
                                                            <div class="trf" style="display: none">{{ $category['Taraflar']}}</div>
                                                            <div class="thm" style="display: none">MS</div>
                                                            <div class="aos">Alt</div>
                                                            <div class="aod">{{ $category['Oranlar']['altust15'][1]['oran'] ?? '' }}</div>
                                                        </div>
                                                        <div class="uclu">
                                                            <div class="mbs" style="display: none">{{ $category['Mbs'] }}</div>
                                                            <div class="trh" style="display: none">{{ $category['Tarih']}}</div>
                                                            <div class="trf" style="display: none">{{ $category['Taraflar']}}</div>
                                                            <div class="thm" style="display: none">MS</div>
                                                            <div class="aos">Üst</div>
                                                            <div class="aod">{{ $category['Oranlar']['altust15'][1]['oran'] ?? '' }}</div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="oranbolge">
                                            <div class="altoran">
                                                <div class="katman altoranbaslik">Çifte Şans</div>
                                                <div class="katman altoranlar">
                                                    <div class="uclu">
                                                        <div class="mbs" style="display: none">{{ $category['Mbs'] }}</div>
                                                        <div class="trh" style="display: none">{{ $category['Tarih']}}</div>
                                                        <div class="trf" style="display: none">{{ $category['Taraflar']}}</div>
                                                        <div class="thm" style="display: none">MS</div>
                                                        <div class="aos">1</div>
                                                        <div class="aod">{{ $category['Oranlar']['ciftesans'][1]['oran'] ?? '' }}</div>
                                                    </div>
                                                    <div class="uclu">
                                                        <div class="mbs" style="display: none">{{ $category['Mbs'] }}</div>
                                                        <div class="trh" style="display: none">{{ $category['Tarih']}}</div>
                                                        <div class="trf" style="display: none">{{ $category['Taraflar']}}</div>
                                                        <div class="thm" style="display: none">MS</div>
                                                        <div class="aos">0</div>
                                                        <div class="aod">{{ $category['Oranlar']['ciftesans'][2]['oran'] ?? '' }}</div>
                                                    </div>
                                                    <div class="uclu">
                                                        <div class="mbs" style="display: none">{{ $category['Mbs'] }}</div>
                                                        <div class="trh" style="display: none">{{ $category['Tarih']}}</div>
                                                        <div class="trf" style="display: none">{{ $category['Taraflar']}}</div>
                                                        <div class="thm" style="display: none">MS</div>
                                                        <div class="aos">2</div>
                                                        <div class="aod">{{ $category['Oranlar']['ciftesans'][3]['oran'] ?? '' }}</div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="altoran">
                                                <div class="katman altoranbaslik">İlk Yarı Sonucu</div>
                                                <div class="katman altoranlar">
                                                    <div class="uclu">
                                                        <div class="mbs" style="display: none">{{ $category['Mbs'] }}</div>
                                                        <div class="trh" style="display: none">{{ $category['Tarih']}}</div>
                                                        <div class="trf" style="display: none">{{ $category['Taraflar']}}</div>
                                                        <div class="thm" style="display: none">MS</div>
                                                        <div class="aos">1</div>
                                                        <div class="aod">{{ $category['Oranlar']['ilkyarisonucu'][1]['oran'] ?? '' }}</div>
                                                    </div>
                                                    <div class="uclu">
                                                        <div class="mbs" style="display: none">{{ $category['Mbs'] }}</div>
                                                        <div class="trh" style="display: none">{{ $category['Tarih']}}</div>
                                                        <div class="trf" style="display: none">{{ $category['Taraflar']}}</div>
                                                        <div class="thm" style="display: none">MS</div>
                                                        <div class="aos">0</div>
                                                        <div class="aod">{{ $category['Oranlar']['ilkyarisonucu'][2]['oran'] ?? '' }}</div>
                                                    </div>
                                                    <div class="uclu">
                                                        <div class="mbs" style="display: none">{{ $category['Mbs'] }}</div>
                                                        <div class="trh" style="display: none">{{ $category['Tarih']}}</div>
                                                        <div class="trf" style="display: none">{{ $category['Taraflar']}}</div>
                                                        <div class="thm" style="display: none">MS</div>
                                                        <div class="aos">2</div>
                                                        <div class="aod">{{ $category['Oranlar']['ilkyarisonucu'][3]['oran'] ?? '' }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="oranbolge">
                                            <div class="altoran">
                                                <div class="katman altoranbaslik">Karşılıklı Gol</div>
                                                <div class="katman altoranlar">
                                                    <div class="uclu">
                                                        <div class="mbs" style="display: none">{{ $category['Mbs'] }}</div>
                                                        <div class="trh" style="display: none">{{ $category['Tarih']}}</div>
                                                        <div class="trf" style="display: none">{{ $category['Taraflar']}}</div>
                                                        <div class="thm" style="display: none">MS</div>
                                                        <div class="aos">Var</div>
                                                        <div class="aod">{{ $category['Oranlar']['kgvaryok'][1]['oran'] ?? '' }}</div>
                                                    </div>
                                                    <div class="uclu">
                                                        <div class="mbs" style="display: none">{{ $category['Mbs'] }}</div>
                                                        <div class="trh" style="display: none">{{ $category['Tarih']}}</div>
                                                        <div class="trf" style="display: none">{{ $category['Taraflar']}}</div>
                                                        <div class="thm" style="display: none">MS</div>
                                                        <div class="aos">Yok</div>
                                                        <div class="aod">{{ $category['Oranlar']['kgvaryok'][2]['oran'] ?? '' }}</div>
                                                    </div>

                                                </div>

                                            </div>
                                            <div class="altoran">
                                                <div class="katman altoranbaslik">Alt/Üst 2.5</div>
                                                <div class="katman altoranlar">
                                                    <div class="uclu">
                                                        <div class="mbs" style="display: none">{{ $category['Mbs'] }}</div>
                                                        <div class="trh" style="display: none">{{ $category['Tarih']}}</div>
                                                        <div class="trf" style="display: none">{{ $category['Taraflar']}}</div>
                                                        <div class="thm" style="display: none">MS</div>
                                                        <div class="aos">Alt</div>
                                                        <div class="aod">{{ $category['Oranlar']['altust25'][1]['oran'] ?? ''}}</div>
                                                    </div>
                                                    <div class="uclu">
                                                        <div class="mbs" style="display: none">{{ $category['Mbs'] }}</div>
                                                        <div class="trh" style="display: none">{{ $category['Tarih']}}</div>
                                                        <div class="trf" style="display: none">{{ $category['Taraflar']}}</div>
                                                        <div class="thm" style="display: none">MS</div>
                                                        <div class="aos">Üst</div>
                                                        <div class="aod">{{ $category['Oranlar']['altust25'][2]['oran'] ?? ''}}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Kod</th>
                                <th>Tarih</th>
                                <th>Taraflar</th>
                                <th>MS 1</th>
                                <th>MS 0</th>
                                <th>MS 2</th>
                                <th>1.5 Üst</th>
                                <th>1.5 Alt</th>
                                <th>KG Var</th>
                                <th>KG Yok</th>
                                <th> </th>
                            </tr>
                            </tfoot>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card" style="width: 400px!important;" id="vdetay">
                    <div class="card-header">
                        <h4 class="card-title">Kupon</h4>
                    </div>
                    <div class="card-block">
                        <div class="card-body">
                            <fieldset class="form-group">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover text-nowrap">
                                        <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">Tarih</th>
                                            <th scope="col">Maç</th>
                                            <th scope="col">Tahmin</th>
                                            <th scope="col">Oran</th>
                                            <th scope="col">Kod</th>
                                            <th scope="col">Sil</th>
                                        </tr>
                                        </thead>
                                        <tbody id="kdetay">

                                        </tbody>
                                    </table>
                                </div>
                            </fieldset>
                            <div class="row match-height">
                                <h6 style="margin-left: 12px;">Toplam Oran </h6>
                                <h6 id="torn">0</h6>
                            </div>
                            <br>
                            <h6>Kupon Türü</h6>
                            <select id="tip" class="form-control" required>
                                <option value="free">Ücretsiz</option>
                                <option value="premium">Premium</option>
                                <option value="private">Özel</option>
                            </select>
                            <br>
                            <button type="button" class="btn btn-success btn-min-width mr-1 mb-1" id="kaydet-btn">
                                Kaydet
                            </button>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    </div>
@endsection


@section('scripts')
    <script src="../assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
    <script src="../assets/js/datatable/datatable-extension/dataTables.buttons.min.js"></script>
    <script src="../assets/js/datatable/datatable-extension/jszip.min.js"></script>
    <script src="../assets/js/datatable/datatable-extension/buttons.colVis.min.js"></script>
    <script src="../assets/js/datatable/datatable-extension/pdfmake.min.js"></script>
    <script src="../assets/js/datatable/datatable-extension/vfs_fonts.js"></script>
    <script src="../assets/js/datatable/datatable-extension/dataTables.autoFill.min.js"></script>
    <script src="../assets/js/datatable/datatable-extension/dataTables.select.min.js"></script>
    <script src="../assets/js/datatable/datatable-extension/buttons.bootstrap4.min.js"></script>
    <script src="../assets/js/datatable/datatable-extension/buttons.html5.min.js"></script>
    <script src="../assets/js/datatable/datatable-extension/buttons.print.min.js"></script>
    <script src="../assets/js/datatable/datatable-extension/dataTables.bootstrap4.min.js"></script>
    <script src="../assets/js/datatable/datatable-extension/dataTables.responsive.min.js"></script>
    <script src="../assets/js/datatable/datatable-extension/responsive.bootstrap4.min.js"></script>
    <script src="../assets/js/datatable/datatable-extension/dataTables.keyTable.min.js"></script>
    <script src="../assets/js/datatable/datatable-extension/dataTables.colReorder.min.js"></script>
    <script src="../assets/js/datatable/datatable-extension/dataTables.fixedHeader.min.js"></script>
    <script src="../assets/js/datatable/datatable-extension/dataTables.rowReorder.min.js"></script>
    <script src="../assets/js/datatable/datatable-extension/dataTables.scroller.min.js"></script>
    <script src="../assets/js/datatable/datatable-extension/custom.js"></script>
    <script>


        $(document).ready(function () {
            // Add a click event handler to the buttons with class "detay-button"
            function bindDetailButtons() {
                $('.detay-button').on('click', function (e) {
                    e.stopPropagation(); // Stop the click event from propagating to the document
                    var targetId = $(this).data('target');
                    var detailsRow = $('#details-row-' + targetId);

                    // Toggle the visibility of the details row
                    detailsRow.toggle();

                    // Insert the details row as a sibling of the parent row of the clicked button
                    var parentRow = $(this).closest('tr');
                    if (detailsRow.is(':visible')) {
                        if (!parentRow.next().hasClass('details-row')) {
                            parentRow.after(detailsRow);
                        }
                    } else {
                        detailsRow.hide();
                    }

                    // Prevent the default behavior of the button click event
                    return false;
                });
            }

            bindDetailButtons();

            // DataTables'ın "draw" olayı
            $('#export-button').on('draw.dt', function () {
                // Sayfalamadan sonra detay butonlarına tekrar click olaylarını ata
                bindDetailButtons();
            });

            // Detay bölümünün dışına tıklamada tüm detayları kapat
            $(document).on('click', function () {
                $('.details-row').hide();
            });
        });





        $(document).ready(function () {
            // DataTable nesnesini başlatın
            var dataTable = $('#export-button').DataTable();

            // Tıklanan başlığı ve veriyi tutacak değişkenler
            var selectedTitle = '';
            var selectedData = '';
            var totalOran = 0;

            // Tablodaki her satıra tıklama olayını dinleyin
            $('#export-button tbody').on('click', 'td', function () {
                // Tıklanan sütunun index değerini alın
                var columnIndex = $(this).index();
                var rowData = dataTable.row(this).data();

                // Tıklanan sütunun başlığını alın
                selectedTitle = $('#export-button thead th:eq(' + columnIndex + ')').text();

                // Tıklanan sütundaki veriyi alın
                selectedData = $(this).text();

                // Tıklanan satırdaki MBS değerini alın
                var mbsValue = $(this).closest('tr').find('td:eq(1)').text();

                // Tıklanan satırdaki oran değerini alın
                var oranValue = $(this).closest('tr').find('td:eq(2)').text();


                if (selectedData) {
                    // Tıklanan satırdaki verileri "kdetay" bölümüne ekleyin
                    var rowNode = '<tr>' +
                        '<td>' + rowData[1] + '</td>' +
                        '<td>' + rowData[2] + '</td>' +
                        '<td>' + selectedTitle + '</td>' +
                        '<td> ' + selectedData + '</td>' +
                        '<td> ' + rowData[0] + '</td>' +
                        '<td><button class="btn btn-danger delete-button">Sil</button></td>' +
                        '</tr>';

                    // Mevcut içeriğe yeni satırı ekleyin
                    $('#kdetay').append(rowNode);

                    // Seçilen veriyi toplam orana ekleyin
                    totalOran += parseFloat(selectedData);
                    totalOran = parseFloat(totalOran.toFixed(2));
                    $('#torn').text(totalOran);
                }
            });

            $('.uclu').on('click', function () {
                // Get the content of the div elements within the clicked uclu
                var tarih = $(this).find('.trh').text();
                var mac = $(this).find('.trf').text();
                var tahmin = $(this).find('.thm').text();
                var oran = $(this).find('.aod').text();
                var kod = $(this).find('.mbs').text();

                // Create the new row with the extracted data
                if (oran) {
                    var rowNode = '<tr>' +
                        '<td>' + tarih + '</td>' +
                        '<td>' + mac + '</td>' +
                        '<td>' + tahmin + '</td>' +
                        '<td>' + oran + '</td>' +
                        '<td>' + kod + '</td>' +
                        '<td><button class="btn btn-danger delete-button">Sil</button></td>' +
                        '</tr>';

                    // Append the new row to the tbody
                    $('#kdetay').append(rowNode);

                    // Update totalOran if needed
                    totalOran += parseFloat(oran);
                    totalOran = parseFloat(totalOran.toFixed(2));
                    $('#torn').text(totalOran);
                }
            });


            $('#kdetay').on('click', '.delete-button', function () {

                $(this).closest('tr').remove();


                var deletedData = parseFloat($(this).closest('tr').find('td:eq(3)').text());
                totalOran -= deletedData;
                totalOran = parseFloat(totalOran.toFixed(2));
                $('#torn').text(totalOran);


                selectedTitle = '';
                selectedData = '';
            });

            // Kaydet butonuna tıklama olayını dinleyin
            $('#kaydet-btn').on('click', function () {
                kpnsave();
            });
        });

        function kpnsave() {
            // Kupon türünü al
            var kuponTuru = $('#tip').val();

            // Kupon bilgilerini toplayın ve AJAX ile kaydedin
            var kuponData = {
                kuponTuru: kuponTuru, // Düzeltme: kuponTuru'yu doğrudan kuponData içinde gönderin
                maclar: [], // maclar'ı boş bir dizi olarak tanımlayın ve sonra doldurun
                toplamOran: $('#torn').text()
            };

            // kdetay tablosundaki satırları döngü ile gezerek maç verilerini alın
            $('#kdetay tr').each(function () {
                var tarih = $(this).find('td:eq(0)').text();
                var tahmin = $(this).find('td:eq(2)').text();
                var oran = $(this).find('td:eq(3)').text();
                var mbs = $(this).find('td:eq(1)').text();
                var kod = $(this).find('td:eq(4)').text();

                kuponData.maclar.push({
                    tarih :tarih,
                    tahmin: tahmin,
                    oran: parseFloat(oran),
                    mbs: mbs,
                    kod: kod
                });
            });

            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            // Kupon verilerini AJAX ile server'a gönderin
            $.ajax({
                url: '/coupon-save', // Kuponları kaydetmek için oluşturduğunuz controller metodunun URL'sini belirtin
                method: 'POST',
                data: {
                    _token: csrfToken,
                    kuponTuru: kuponTuru,
                    kuponData: kuponData // Düzeltme: kuponData'nın tamamını gönderin, sadece maclar değil
                },
                success: function (response) {
                    // Kupon başarıyla kaydedildiğinde yapılacak işlemler burada olabilir
                    alert('Kupon başarıyla kaydedildi!');
                    $('#kdetay').empty();
                    $('#torn').text('0');
                    kuponData.maclar = [];
                    kuponData.toplamOran = 0;
                },
                error: function (error) {
                    // Kupon kaydedilirken bir hata oluştuğunda yapılacak işlemler burada olabilir
                    alert('Kupon kaydedilirken bir hata oluştu!');
                }
            });
        }


    </script>

@endsection
