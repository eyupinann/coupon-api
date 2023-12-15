@extends('admin.layout.index')
@push('css')
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/datatables.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/datatable-extension.css">
@endpush
<!-- Page Sidebar Ends-->
@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
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
                            <div class="card-header d-flex justify-content-between">
                                <h5>Satın Alınan Kupon Listesi</h5>
                                <a href="{{route('coupon_result')}}" class="btn btn-success col-3">Kupon Sonuçlarını Yenile</a>
                            </div>
                        <div class="card-body">
                            <div class="dt-ext table-responsive">
                                <table class="display" id="export-button">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Kullanıcı İsim</th>
                                        <th>Kullanıcı Email</th>
                                        <th>Alma Tarihi</th>
                                        <th>Kupon Detay</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($coupon as $pushed)
                                        <tr>
                                            <td>{{$pushed->id}}</td>
                                            <td>{{$pushed->user->name}}</td>
                                            <td>{{$pushed->user->email}}</td>
                                            <td>{{date_format($pushed->created_at,'m-d-Y') }}</td>
                                            <td>
                                                <button class="btn btn-warning detay-button" data-target="{{ $pushed->coupon->id }}">Detay</button>
                                            </td>
                                        </tr>
                                        <!-- Details row -->
                                        <tr class="details-row" id="details-row-{{ $pushed->coupon->id }}" style="display: none;">
                                            <td colspan="6">
                                                <table>
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Oran</th>
                                                        <th>Tahmin</th>
                                                        <th>Durum</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($pushed->coupon->items as $item)
                                                        <tr>
                                                            <td>{{$item->id}}</td>
                                                            <td>{{$item->oran}}</td>
                                                            <td>{{$item->tahmin}}</td>
                                                            <td>{{$item->durum}}</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>

                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Kullanıcı İsim</th>
                                        <th>Kullanıcı Email</th>
                                        <th>Alma Tarihi</th>
                                        <th>Kupon Detay</th>
                                    </tr>
                                    </tfoot>
                                </table>
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
        $(document).ready(function() {
            // Toggle details row visibility when "Detay" button is clicked
            $('.detay-button').on('click', function() {
                var targetId = $(this).data('target');
                $('#details-row-' + targetId).toggle();
            });
        });

    </script>
@endsection
