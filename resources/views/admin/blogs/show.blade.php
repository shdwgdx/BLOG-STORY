@extends('layouts.admin')
@section('content-header')
    <h1 class="m-0 text-dark">Маршрут {{ $blog->name }}</h1>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('blogs.index') }}" class="btn btn-secondary">Назад</a>
        </div>
        <div class="card-body">
            <table class="table">
                <tbody>
                    <tr>
                        <td width="30%">ID</td>
                        <td>{{ $blog->id }}</td>
                    </tr>
                    <tr>
                        <td>Название</td>
                        <td>{{ $blog->title }}</td>
                    </tr>
                    <tr>
                        <td>Подназвание</td>
                        <td>{{ $blog->subtitle }}</td>
                    </tr>
                    <tr>
                        <td>Описание</td>
                        <td>{!! $blog->description !!}</td>
                    </tr>
                    <tr>
                        <td>Порядок</td>
                        <td>{{ $blog->order_number }}</td>
                    </tr>
                    <tr>
                        <td>Маршрут</td>
                        <td>{{ $blog->route_id }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
