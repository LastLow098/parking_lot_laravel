@extends('layout')

@section('title') Стоянка @endsection

@section('main_content')

<h2>Стоянка</h2>

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

<button class="btn btn-primary">На стоянке</button>


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

        </tbody>
    </table>
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/parking.js') }}"></script>
@endsection
