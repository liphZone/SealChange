@extends('layout.admin.index')
@section('content')
@section('title','Detail transaction')

    <div style="margin-left: 20%" class="col-md-7 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"> <h4> DETAIL DE LA TRANSACTION : référence : {{ request('reference') }}</h4> </h4>
                <div class="template-demo">
                    <p> Id de la transaction : {{ $transaction->id_transaction }} </p>
                    <p> Monnaie envoyé  : <b> {{ $coin_enter->libelle }} </b> </p>
                    @if ($transaction->devise_enter === 'USD')
                        <p> Montant envoyé   : <b> {{" $transaction->amount $" }}</b> </p>
                    @else
                        <p> Montant envoyé   : <b> {{" $transaction->amount F CFA" }} </b> </p>
                    @endif
                
                    <p> Monnaie à reçevoir : <b> {{ $coin_out->libelle }} </b> </p>
                    @if ($transaction->devise_out === 'USD')
                        <p> Montant à reçevoir   : <b> {{" $transaction->amount $" }} </b> </p>
                    @else
                        <p> Montant à reçevoir   : <b> {{" $transaction->having_amount F CFA" }} </b> </p>
                    @endif
                    <p> Information client : {{ "$user->nom $user->prenom" }}</p>
                    <p> Email du client : {{ $user->email }}</p>
                    <p> Contact du client :  : {{ $transaction->telephone }} </p>
                    <p> Compte du client :  : {{ $transaction->account_receiver }} </p>
                    <a href="{{ route('action_validate_transaction',$transaction->id_transaction) }}" onclick="return action()" class="btn btn-success btn-block"> Valider transaction </a>
                </div>
            </div>
        </div>
    </div>

    <script>            
        function action() {
            var r = confirm("Etes-vous sur d'avoir effectué la transaction du client?");
            if (r == false) {
                return false;
            }
        }
    </script>
@endsection


