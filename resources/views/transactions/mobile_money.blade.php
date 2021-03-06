@extends('layout.client.index')
@section('content')
@section('title','Transaction')

<script src="https://cdn.fedapay.com/checkout.js?v=1.1.7"></script>

@php
     $personne = \App\Models\Personne::where('id',auth()->user()->personne_id)->first();
@endphp


<button id="pay-btn" class="btn btn-dark btn-lg"
data-transaction-amount="{{ $montant }}"
data-transaction-description="Seal Change"
data-customer-email="{{ $personne->email }}"
data-customer-lastname="{{ $personne->nom }}"
data-customer-firstname="{{ $personne->prenom }}"
type="submit" title="payement"> Continuer </button>


<script type="text/javascript">
    FedaPay.init('#pay-btn', { public_key: 'pk_live_d_FPG0eSQz1sqDW4_1x-XBKu' });
</script>

@endsection