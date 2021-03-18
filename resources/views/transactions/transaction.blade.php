@extends('layout.client.index')
@section('content')
@section('title','Transaction')
<style>
    .countdown{
        font-weight: bold;
    }
</style>

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
                    Montant à reçevoir : {{ "$montant_a_recevoir " }} 
                    @if ($devise_out ==='USD')
                        <i class="fa fa-dollar"></i>
                    @else
                        F CFA 
                    @endif
                </h1>

                @if ($transaction_en_cours->etat === 1)
                    <div id="accueil">
                        <h3> Opération effecutée avec succès </h3>
                        <a href="{{ route('accueil') }}" class="btn btn-success"> cliquez pour terminer <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> </a>
                    </div>
                @elseif($transaction_en_cours->etat === 0)
                    <h1 class="text-center" id="countdown">  </h1>

                    <div id="etat">
                        <h1> Etat : <span class="text-warning"> En cours de traitement ... <i class="fa fa-spinner fa-pulse fa-5x"> </i>  </span> </h1>
                    </div>
                    <div id="accueil" style="display: none;">
                        <h3> Opération effecutée avec succès </h3>
                        <a href="{{ route('accueil') }}" class="btn btn-success"> cliquez pour terminer <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> </a>
                    </div>

                @endif

                
            </div>
        </div>
        </div>
    </div>

<script>

    var counter = 100;
    var etat = document.getElementById('etat');
    var accueil = document.getElementById('accueil');

    setInterval(counting,1000);

    function counting(){
        counter--;

        if (counter >= 0) {
            id = document.getElementById('countdown');
            id.innerHTML = counter;
        }

        if (counter  === 0) {
            id.innerHTML = "<h3 class='text-success'> Transaction terminée </h3>";
            etat.innerHTML = " ";
            accueil.style.display='block';

        }
    }

</script>


@endsection

