@extends('layout')

@section('title') Главная страница @endsection

@section('main_content')

<div class="container">
    <form action="/add" method="GET" class="w-100 d-flex mb-3 mt-3 justify-content-between">
        <h2>Все клиенты</h2>
        <button type="submit" class="btn btn-primary">Добавить нового клиента</button>
    </form>
    <table class="table table-striped" id="mainTable">
        <thead>
            <tr>
                <th>Имя клиента</th>
                <th>Количество авто</th>
                <th>Опции</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{$item->name}}</td>
                    <td>{{$item->count}}</td>
                    <td>
                        <form action="/edit" method="get" style="display: inline-block">
                            <button class="btn btn-primary" name="id" value="{{$item->id}}" type="submit">
                                <i class="bi bi-pen"></i>
                            </button>
                        </form>
                        <form action="/delete/client" method="post" style="display: inline-block">
                            @csrf
                            <button class="btn btn-primary" name="id" value="{{$item->id}}" type="submit">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
