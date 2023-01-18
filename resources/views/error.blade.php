@extends('layout')

@section('title') Отзывы @endsection

@section('main_content')
    <h4> @isset($data) {{$data}} @endisset </h4>
@endsection
