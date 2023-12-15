@extends('admin.layout.index')



@section('content')
    <div class="page-body">


        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Genel Ayarlar Düzenleme</h5>
                        </div>
                        <form action="{{route('settings_save')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @if(isset($push))
                            <input type="hidden" name="id" value="{{$push->id}}">
                            @endif
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-6">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Versiyon</label>
                                        <input type="text" class="form-control" name="version" required value="{{$push->version ?? ''}}">
                                        </div>
                                        <div class="col-6">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Başlık</label>
                                        <input type="text" class="form-control" name="title" required value="{{$push->title ?? ''}}">
                                        </div>
                                        <div class="col-6">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Email</label>
                                        <input type="text" class="form-control" name="email" required value="{{$push->email ?? ''}}">
                                        </div>
                                        <div class="col-6">
                                            <label class="col-form-label pt-0" for="exampleInputEmail1">Logo</label>
                                            <img src="logo/{{$push->logo ?? ''}}" class="col-2">
                                            <input type="file" class="form-control" name="logo" required value="{{$push->logo ?? ''}}">
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
