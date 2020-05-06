@extends('layout')
@section('title','Sorğular')
@section('queries','active')
@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <h3><i class="fas fa-list"></i> Sorğular</h3>
        <table class="table table-hover table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Sorğu Adı</th>
                    <th scope="col">Sualların Sayı</th>
                    <th scope="col">Nəticə</th>
                    <th scope="col">Əməliyyat</th>
                </tr>
            </thead>
            <tbody>
                @foreach($queries as $query)
                    <tr>
                        <td>{{ $query->id }}</td>
                        <td>{{ $query->name }}</td>
                        <td>{{ $query->count }}</td>
                        <td>{{ ($query->result == -1) ? null : $query->result.'/'.$query->count.' ('.round($query->result/$query->count * 100,1).'%)' }}</td>
                        <td><a href="{{ url('/query/'.$query->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-sign-in-alt"></i> Sorğuya keç</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection