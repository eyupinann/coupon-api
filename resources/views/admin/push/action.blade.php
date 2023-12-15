@extends('admin.layout.index')



@section('content')
    <div class="page-body">


        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Bildirim Oluşturma ve Düzenleme</h5>
                        </div>
                        <form action="{{route('push_save')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @if(isset($coupon))
                            <input type="hidden" name="id" value="{{$coupon->id}}">
                            @endif
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-6">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Başlık</label>
                                        <input type="text" class="form-control" name="title" required value="{{$push->title ?? ''}}">
                                        </div>
                                        <div class="col-6">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Açıklama</label>
                                            <textarea name="description" class="form-control" required>{{$push->description ?? ''}} </textarea>
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
