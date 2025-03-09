@extends('adminlte::page')

@section('title', 'Edit Permission')

@section('content_header')
    <h1>Edit Permission</h1>
@stop

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('permissions.update', $permission->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $permission->name }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@stop
