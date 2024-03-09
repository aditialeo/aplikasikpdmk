@extends('adminlte::page')

@section('title', 'Aplikasi Inventory')

@section('content_header')
    <h1 class="m-0 text-dark">Ubah Data User</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('user.update',$user->id) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="">Nama</label>
                            <input type="text" value="{{$user->name}}" class="form-control @error('name') is-invalid @enderror" name="name"
                                id="" aria-describedby="helpId" placeholder="Nama">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" value="{{$user->email}}" class="form-control @error('email') is-invalid @enderror" name="email" id=""
                                aria-describedby="emailHelpId" placeholder="Email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
