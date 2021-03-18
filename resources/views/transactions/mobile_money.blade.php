@extends('layout.client.index')
@section('content')
@section('title','Transaction mobile money')

@php
     $personne = \App\Models\Personne::where('id',auth()->user()->personne_id)->first();
@endphp

 <form action="{{ route('action_feda_pay') }}" method="POST">
    @csrf
    <div class="form-group" hidden>
        <input class="form-control" type="text" name="nom" value="{{ $personne->nom }}" readonly>
        <input class="form-control" type="text" name="prenom" value="{{ $personne->prenom }}" readonly>
        <input class="form-control" type="email" name="email" value="{{ $personne->email }}" readonly>
        <input class="form-control" type="text" name="montant" value="{{ $montant }}" readonly>
        <input class="form-control" type="text" name="enter" value="{{ $coin_enter }}" readonly>
        <input class="form-control" type="text" name="out" value="{{ $coin_out }}" readonly>
        <input class="form-control" type="text" name="telephone" value="{{ $telephone }}" readonly>
    </div>

    <button id="pay-btn" class="btn btn-dark btn-lg" type="submit" title="payement"> 
        Cliquez pour continuer la transaction <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> 
    </button>
 </form>



@endsection