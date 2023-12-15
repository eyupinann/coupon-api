@extends('admin.layout.index')



@section('content')
    <div class="page-body">


        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Kullanıcı Oluşturma ve Düzenleme</h5>
                        </div>
                        <form action="{{route('user_save')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @if(isset($user))
                            <input type="hidden" name="id" value="{{$user->id}}">
                            @endif
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">İsim</label>
                                    <input type="text" class="form-control" name="name" required value="{{$user->name ?? ''}}">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">Email</label>
                                    <input type="email" class="form-control" name="email" required value="{{$user->email ?? ''}}">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">Rol</label>
                                    <select class="form-control" name="role">
                                        <option selected >Seçiniz</option>
                                        <option value="premium" @if(isset($user)) {{($user->role == 'premium' ? 'selected' : '')}} @endif>Premium</option>
                                        <option value="free" @if(isset($user)) {{($user->role == 'free' ? 'selected' : '')}} @endif>Free</option>
                                    </select>
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">Paket Türü</label>
                                    <select class="form-control" name="type">
                                        <option selected >Seçiniz</option>
                                        <option value="0" @if(isset($user)) {{($user->type == '0' ? 'selected' : '')}} @endif>Yok</option>
                                        <option value="1" @if(isset($user)) {{($user->type == '1' ? 'selected' : '')}} @endif>1 Haftalık</option>
                                        <option value="2" @if(isset($user)) {{($user->type == '2' ? 'selected' : '')}} @endif>1 Aylık</option>
                                        <option value="3" @if(isset($user)) {{($user->type == '3' ? 'selected' : '')}} @endif>3 Aylık</option>
                                    </select>
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">Şifre</label>
                                    <input type="password" class="form-control" name="password"  @if(!isset($user))required @endif>
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
