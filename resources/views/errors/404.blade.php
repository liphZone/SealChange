@extends('errors::layout')

@section('title','Erreur')
    
{{-- @section('message','Page introuvable !') --}}
   
@section('message')
    <p> Page introuvable ! </p>
    <p> <a class="btn btn-info" href="{{ route('form_login') }}"> Accueil </a> </p>
@endsection