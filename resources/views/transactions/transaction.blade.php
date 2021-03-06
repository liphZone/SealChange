@extends('layout.client.index')
@section('content')
@section('title','Transaction')

@php
   $monnaie_entree       = \App\Models\Coin::where('id',$coin_enter)->first();
   $monnaie_sortie       = \App\Models\Coin::where('id',$coin_out)->first();
   $transaction_en_cours = \App\Models\Transaction::where('user',auth()->user()->personne_id)
   ->where('id_transaction',request('id_transaction'))->first();
@endphp
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
        <div class="card-body">
            <h4 class="card-title"> <h3 class="text-center"> INFORMATION FACTURATION </h3> </h4>
            <p class="card-description"> Transaction De {{ $monnaie_entree->libelle }} Vers {{ $monnaie_sortie->libelle }}  </p>
            <div class="template-demo">
                <h1>
                    Montant à reçevoir : {{ "$montant_a_recevoir $devise_out" }} 
                </h1>
                @if ($transaction_en_cours->etat === 0)
                    <div id="etat">
                        <h1> Etat : <span class="text-warning"> En cours de traitement ... <i class="fa fa-spinner fa-pulse fa-5x"></i> </span> </h1>
                    </div>
                @elseif($transaction_en_cours->etat === 1)
                    <h3> Opération effecutée avec succès </h3>
                    <a href="{{ route('accueil') }}" class="btn btn-success"> Terminer </a>
                @endif
            </div>
        </div>
        </div>
    </div>

@endsection

