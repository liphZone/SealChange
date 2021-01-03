@extends('layout.client.index')
@section('content')
@section('title','Price')
    <ul>
        @foreach ($price as $prices)
            <li> {{ $prices->symbol }} </li>
        @endforeach
    </ul>
@endsection