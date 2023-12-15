@extends('admin.layout.index')



@section('content')
    <div class="page-body">


        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Kupon Oluşturma ve Düzenleme</h5>
                        </div>
                        <form action="{{route('coupon_save')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @if(isset($coupon))
                            <input type="hidden" name="id" value="{{$coupon->id}}">
                            @endif
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-4">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">MBS</label>
                                        <input type="text" class="form-control" name="mbs" required value="{{$coupon->mbs ?? ''}}">
                                        </div>
                                        <div class="col-4">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Oran</label>
                                        <input type="text" class="form-control" name="oran" required value="{{$coupon->oran ?? ''}}">
                                        </div>
                                        <div class="col-4">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Ev</label>
                                        <input type="text" class="form-control" name="ev" required value="{{$coupon->ev ?? ''}}">
                                        </div>
                                            <div class="col-4">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Deplasman</label>
                                        <input type="text" class="form-control" name="deplasman" required value="{{$coupon->deplasman ?? ''}}">
                                            </div>
                                                <div class="col-4">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Tahmin</label>
                                        <input type="text" class="form-control" name="tahmin" required value="{{$coupon->tahmin ?? ''}}">
                                                </div>
                                                    <div class="col-4">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">İY</label>
                                        <input type="text" class="form-control" name="iy" required value="{{$coupon->iy ?? ''}}">
                                                    </div>
                                        <div class="col-4">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">MS</label>
                                        <input type="text" class="form-control" name="ms" required value="{{$coupon->ms ?? ''}}">
                                        </div>
                                        <div class="col-4">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Durum</label>
                                        <input type="text" class="form-control" name="durum" required value="{{$coupon->durum ?? ''}}">
                                        </div>
                                        <div class="col-4">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Type</label>
                                        <input type="text" class="form-control" name="type" required value="{{$coupon->type ?? ''}}">
                                        </div>
                                    </div>

                                </div>

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
                            </div>
                            <div class="card-footer text-end">
                                <button class="btn btn-primary" type="submit">Gönder</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection


@section('scripts')


@endsection
