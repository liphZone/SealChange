@extends('layout.admin.index')
@section('content')
@section('title','Historique')
<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <p class="card-description"> <h3 class="text-center"> HISTORIQUE DES TRANSACTIONS </h3> </p>
      <table class="table table-hover">
        <thead>
          <tr>
          <th> Référence  </th>
          <th> Monnaie envoyé  </th>
          <th> Montant envoyé  </th>
          <th> Monnaie à reçevoir </th>
          <th> Montant à reçevoir </th>
          <th> Récepteur </th>
          <th> Action </th>
          </tr>
        </thead>
        <tbody>
          @foreach ($transaction as $transactions)
            @php
              $coin_enter = \App\Models\Coin::where('id',$transactions->coin_enter)->first();
              $coin_out   = \App\Models\Coin::where('id',$transactions->coin_out)->first();
              $user       = \App\Models\Personne::where('id',$transactions->user)->first();
            @endphp

            <tr>
              <td> {{ $transactions->reference }} </td>
              <td> {{ $coin_enter->libelle }} </td>
              @if ($transactions->devise_enter === 'USD')
                <td> {{ "$transactions->amount $" }} </td>
              @elseif($transactions->devise_enter === 'XOF')
                <td> {{ "$transactions->amount F CFA" }} </td>
              @endif
              <td> {{ $coin_out->libelle }} </td>
              @if ($transactions->devise_out === 'USD')
                <td> {{ "$transactions->having_amount $" }} </td>
              @elseif($transactions->devise_out === 'XOF')
                <td> {{ "$transactions->having_amount F CFA" }} </td>
              @endif
              <td> {{ "$user->nom $user->prenom ($user->email)" }} </td>
              <td>
               
                @if (auth()->user()->type_utilisateur === 'Other_admin')
                  @if ($transactions->etat === 0 )
                    <a href="{{ route('transaction_detail',$transactions->reference) }}" class="btn btn-primary"> Voir détail </a> 
                  @else
                    <label class="badge badge-success"> terminé </label>
                  @endif
                @elseif(auth()->user()->type_utilisateur === 'Super_admin' || auth()->user()->type_utilisateur === 'Admin' ) 
                  @if ($transactions->etat === 0 )
                  <label class="badge badge-warning"> en attente ... </label> 
                  @else
                    <label class="badge badge-success"> terminé </label>
                  @endif
                  
                @endif
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
 
</div>
{{ $transaction->links() }}


@endsection