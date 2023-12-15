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
                        <div class="card-header">
                            <h5>Kullanıcı Listesi</h5>
                        </div>
                        <div class="card-body">
                            <div class="dt-ext table-responsive">
                                <table class="display" id="export-button">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>İsim</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                   <tbody>
                                   @foreach($user as $pushed)
                                   <tr>
                                       <td>{{$pushed->id}}</td>
                                       <td>{{$pushed->name}}</td>
                                       <td>{{$pushed->email}}</td>
                                       <td>
                                           <a href="{{route('user_edit',$pushed->id)}}">
                                               <i class="fa fa-edit fa-2x "></i>
                                           </a>
                                           <a href="{{route('user_destroy',$pushed->id)}}">
                                               <i class="fa fa-remove fa-2x"></i>
                                           </a>

                                       </td>
                                   </tr>
                                   @endforeach

                                   </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>İsim</th>
                                        <th>Email</th>
                                        <th>Action</th>
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
@endsection