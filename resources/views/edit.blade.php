@extends('layout')

@section('title') @if(isset($data)) Изменить данные @else Добавить данные @endif @endsection

@section('main_content')
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<br>
<form action="/" method="GET" class="w-100 d-flex mb-3 mt-3 justify-content-between">
    <h2>Данные клиента</h2>
    <button type="submit" class="btn btn-primary">Вернутся на главную</button>
</form>
<form action=@if(isset($data)) "/edit/client" @else "/add/client" @endif  method="POST">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Имя клиента</label>
        <input type="text" class="form-control" name="name" id="name" @isset($data) value="{{$data->client->name}}" @endisset @if(old('name')) value="{{old('name')}}" @endif>
    </div>
    <div class="mb-3">
        <label for="sex" class="form-label">Пол клиента</label>
        <select multiple name="sex" id="sex" class="form-control">
            <option value="male" @isset($data) @selected($data->client->sex == "male") @endisset  @if(old('sex')) @selected(old('sex') == "male") @endif>Мужской</option>
            <option value="female" @isset($data) @selected($data->client->sex == "female") @endisset  @if(old('sex')) @selected(old('sex') == "female") @endif>Женский</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="phone" class="form-label">Телефон клиента</label>
        <input type="phone" class="form-control" name="phone" id="phone" @isset($data) value="{{$data->client->phone}}" @endisset @if(old('phone')) value="{{old('phone')}}" @endif>
    </div>
    <div class="mb-3">
        <label for="address" class="form-label">Адрес клиента</label>
        <input type="text" class="form-control" name="address" id="address" @isset($data) value="{{$data->client->address}}" @endisset @if(old('address')) value="{{old('address')}}" @endif>
    </div>

@isset($data)
    <button type="submit" class="btn btn-primary" name="id" value="{{$data->client->id}}"> Изменить </button>
</form>
<br>
<h2>Данные авто клиента</h2>
    @foreach ($data->autos as $key => $item)
        <h5> Авто {{ $key+1 }}</h5>
        <form action="/edit/auto" method="POST">
            @csrf
            <div class="mb-3">
                <label for="brand" class="form-label">Бренд авто</label>
                <input type="text" class="form-control" name="brand" id="brand" value="{{$item->brand}}" @if(old('brand')) value="{{old('brand')}}" @endif>
            </div>
            <div class="mb-3">
                <label for="model" class="form-label">Модель авто</label>
                <input type="text" class="form-control" name="model" id="model" value="{{$item->model}}" @if(old('model')) value="{{old('model')}}" @endif>
            </div>
            <div class="mb-3">
                <label for="color" class="form-label">Цвет авто</label>
                <input type="text" class="form-control" name="color" id="color" value="{{$item->color}}" @if(old('color')) value="{{old('color')}}" @endif>
            </div>
            <div class="mb-3">
                <label for="gosNumber" class="form-label">Гос номер авто</label>
                <input type="text" class="form-control" name="gosNumber" id="gosNumber" value="{{$item->gosNumber}}" @if(old('gosNumber')) value="{{old('gosNumber')}}" @endif>
            </div>
            <input type="text" name="client_id" value="{{$item->client_id}}" hidden>
            <button type="submit" class="btn btn-primary" name="id" value="{{$item->id}}"> Изменить </button>
        </form>
        <form action="/delete/auto" method="post" style="display: inline-block" class="mt-3">
            @csrf
            <input type="text" name="client_id" value="{{$item->client_id}}" hidden>
            <button class="btn btn-primary" name="id" value="{{$item->id}}" type="submit">Удалить</button>
        </form>
        <hr>
    @endforeach
    <form action="/add/auto" method="POST">
        @csrf
@endisset

<h5> Добавить авто</h5>
    <div class="mb-3">
        <label for="brand" class="form-label">Бренд авто</label>
        <input type="text" class="form-control" name="brand" id="brand" @if(old('brand')) value="{{old('brand')}}" @endif>
    </div>
    <div class="mb-3">
        <label for="model" class="form-label">Модель авто</label>
        <input type="text" class="form-control" name="model" id="model" @if(old('model')) value="{{old('model')}}" @endif>
    </div>
    <div class="mb-3">
        <label for="color" class="form-label">Цвет авто</label>
        <input type="text" class="form-control" name="color" id="color" @if(old('color')) value="{{old('color')}}" @endif>
    </div>
    <div class="mb-3">
        <label for="gosNumber" class="form-label">Гос номер авто</label>
        <input type="text" class="form-control" name="gosNumber" id="gosNumber" @if(old('gosNumber')) value="{{old('gosNumber')}}" @endif>
    </div>
    <button type="submit" @isset($data) name="client_id" value="{{$data->client->id}}" @endisset class="btn btn-primary mb-3"> Добавить </button>
</form>



@endsection
