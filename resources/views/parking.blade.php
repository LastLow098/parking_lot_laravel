@extends('layout')

@section('title') Стоянка @endsection

@section('main_content')

<form action="/" method="GET" class="w-100 d-flex mb-3 mt-3 justify-content-between">
    <h2>Стоянка</h2>
    <button type="submit" class="btn btn-primary">Вернутся на главную</button>
</form>

<div class="mb-3">
    <label for="client" class="form-label">Клиент</label>
    <select name="client" id="client" class="form-control">
        <option value="-1">Ничего нет</option>
    </select>
</div>
<div class="mb-3">
    <label for="auto" class="form-label">Автомобиль</label>
    <select name="auto" id="auto" class="form-control">
        <option value="-1">Ничего нет</option>
    </select>
</div>

<form method="post" action="/auto/set-parking">
    @csrf
    <input type="hidden" name="_method" value="patch" />
    <button type="submit" class="btn btn-primary" id="auto-in" name="id">На стоянке</button>
</form>


<div class="table mt-3">
    <table class="table table-striped" id="mainTable">
        <thead>
            <tr>
                <th>Имя клиента</th>
                <th>Авто</th>
                <th>Опции</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
                <td>{{$item->client_name}}</td>
                <td>{{$item->brand}}/{{$item->model}}</td>
                <td>
                    <form method="post" action="/auto/set-parking">
                        @csrf
                        <input type="hidden" name="_method" value="patch" />
                        <button class="btn btn-primary auto-out" type="submit" name="id" value="{{$item->auto_id}}">Уехал</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/parking.js') }}"></script>
@endsection
