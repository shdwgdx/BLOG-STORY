@extends('layouts.admin')
@section('content-header')
    <h1 class="m-0 text-dark">Маршрут {{ $route->name }}</h1>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('routes.index') }}" class="btn btn-secondary">Назад</a>
        </div>
        <div class="card-body">
            <table class="table">
                <tbody>
                    <tr>
                        <td width="30%">ID</td>
                        <td>{{ $route->id }}</td>
                    </tr>
                    <tr>
                        <td>Название</td>
                        <td>{{ $route->name }}</td>
                    </tr>
                    <tr>
                        <td>Описание</td>
                        <td>{{ $route->description }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
