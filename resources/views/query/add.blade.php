@extends('layout')
@section('title','Yeni Sorğu')
@section('new-query','active')
@section('content')
<div class="row">
    <div class="col-md-4 offset-md-4">
        <h3><i class="fas fa-plus"></i> Yeni Sorğu</h3>
        <form action="{{ route('new-query-post') }}" method="post" class="my-2">
            @csrf
            <div class="form-group mt-2">
                <label for="name">Sorğunun adı</label>
                <input class="form-control" type="text" name="ad" id="name">
            </div>
            <div class="form-group">
                <label for="count">Sual sayı</label>
                <input class="form-control" type="number" name="say" id="count">
                <small>Sualların sayı 30-dan çox ola bilməz!</small>
            </div>
            <button class="btn btn-sm btn-block btn-success" type="submit"><i class="fas fa-check"></i> Əlavə et</button>
        </form> 
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
    </div>
</div>
@endsection