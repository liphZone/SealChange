@extends('layout.client.index')
@section('content')
@section('title','Commande')
<style>
  .traitVertical{
    border-left: 4px solid #000;
    display: inline-block;
    width: 250px;
    margin: 20px;
  }
</style>
@php
  $personne = \App\Models\Personne::where('id',$user)->first();
  $monnaie_entree = \App\Models\Coin::where('id',$coin_enter)->first();
  $monnaie_sortie= \App\Models\Coin::where('id',$coin_out)->first();
@endphp

@if (strtolower($monnaie_entree->libelle) === 'flooz')
    
  <div class="accordion" id="accordionExample">
    <div class="card">
      <div class="card-header" id="headingOne">
        <h2 class="mb-0">
          <button class="btn btn-light" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
           INFORMATIONS FACTURATION
          </button>
        </h2>
      </div>
  
      <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <p class="text-light bg-dark pl-1"> Prénom(s) : {{ $personne->prenom }} </p>
            </div>
            <div class="col-md-6">
              <p class="text-light bg-dark pl-1"> Nom :  {{ $personne->nom }} </p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <p class="text-light bg-dark pl-1"> Pays :  {{ $personne->pays }} </p>
            </div>
            <div class="col-md-6">
              <p class="text-light bg-dark pl-1"> Ville :  {{ $personne->ville }} </p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <p class="text-light bg-dark pl-1"> Téléphone :  {{ $personne->contact }} </p>
            </div>
            <div class="col-md-6">
              <p class="text-light bg-dark pl-1"> Adresse :   {{ $personne->adresse }} </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" id="headingTwo">
        <h2 class="mb-0">
          <button class="btn btn-light collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            DETAIL DE LA COMMANDE
          </button>
        </h2>
      </div>
      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <p class="text-light bg-dark pl-1"> PRODUIT </p>
            </div>
            <div class="col-md-6">
              <p class="text-light bg-dark pl-1"> TOTAL </p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <p> <h3 class="text-center"> Transaction De {{ $monnaie_entree->libelle }} Vers {{ $monnaie_sortie->libelle }} </h3> </p>
              <ul>
                <li> Vous avez envoyé : {{ "$montant $devise_enter" }} </li>
                <li>
                  Vous reçevez :
                  @if ($devise_out === 'EUR')
                   {{ $total }}  <i class="fa fa-eur" aria-hidden="true"></i>
                  @elseif($devise_out === 'USD')
                   {{ $total }} <i class="fa fa-dollar"></i>
                  @endif
                </li>
                
              </ul>
              <div style="float: right">
                <p class="text-light bg-dark pl-1"> TOTAL :  @if ($devise_out === 'EUR')
                  {{ $total }}  <i class="fa fa-eur" aria-hidden="true"></i>
                @elseif($devise_out === 'USD')
                   {{ $total }} <i class="fa fa-dollar"></i>
                @endif </p>

                <form action="{{ route('action_flooz') }}" method="POST">
                  @csrf
                  <div class="form-group" hidden>
                    <input class="form-control" type="text" name="id" value="{{ $id }}" readonly>
                    <input class="form-control" type="text" name="account_receive" value="{{ $account_receive }}" readonly>
                    <input class="form-control" type="text" name="montant" value="{{ $montant }}" readonly>
                    <input class="form-control" type="text" name="coin_enter" value="{{ $coin_enter }}" readonly>
                    <input class="form-control" type="text" name="coin_out" value="{{ $coin_out }}" readonly>
                  </div>
                  @if ($personne->pays === null || $personne->ville === null || $personne->identity === null || 
                    $personne->selfie === null || $personne->image_justivicative === null)
                    <h4 style="color:red;"> Veuillez valider votre identité ! </h4>
                    <button disabled class="btn btn-outline-danger btn-lg" title="payement" type="submit"> Regler Payement avec Flooz </button>
                  @else
                    <button class="btn btn-outline-success btn-lg" type="submit" title="payement"> Regler Payement avec Flooz </button>
                  @endif
                </form>
              
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@elseif (strtolower($monnaie_entree->libelle) === 't money' || strtolower($monnaie_entree->libelle) === 'tmoney')
    
  <div class="accordion" id="accordionExample">
    <div class="card">
      <div class="card-header" id="headingOne">
        <h2 class="mb-0">
          <button class="btn btn-light" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
           INFORMATIONS FACTURATION
          </button>
        </h2>
      </div>
  
      <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <p class="text-light bg-dark pl-1"> Prénom(s) : {{ $personne->prenom }} </p>
            </div>
            <div class="col-md-6">
              <p class="text-light bg-dark pl-1"> Nom :  {{ $personne->nom }} </p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <p class="text-light bg-dark pl-1"> Pays :  {{ $personne->pays }} </p>
            </div>
            <div class="col-md-6">
              <p class="text-light bg-dark pl-1"> Ville :  {{ $personne->ville }} </p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <p class="text-light bg-dark pl-1"> Téléphone :  {{ $personne->contact }} </p>
            </div>
            <div class="col-md-6">
              <p class="text-light bg-dark pl-1"> Adresse :   {{ $personne->adresse }} </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" id="headingTwo">
        <h2 class="mb-0">
          <button class="btn btn-light collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            DETAIL DE LA COMMANDE
          </button>
        </h2>
      </div>
      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <p class="text-light bg-dark pl-1"> PRODUIT </p>
            </div>
            <div class="col-md-6">
              <p class="text-light bg-dark pl-1"> TOTAL </p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <p> <h3 class="text-center"> Transaction De {{ $monnaie_entree->libelle }} Vers {{ $monnaie_sortie->libelle }} </h3> </p>
              <ul>
                <li> Vous avez envoyé : {{ "$montant $devise_enter" }} </li>
                <li>
                  Vous reçevez :
                  @if ($devise_out === 'EUR')
                   {{ $total }}  <i class="fa fa-eur" aria-hidden="true"></i>
                  @elseif($devise_out === 'USD')
                   {{ $total }} <i class="fa fa-dollar"></i>
                  @endif
                </li>
                
              </ul>
              <div style="float: right">
                <p class="text-light bg-dark pl-1"> TOTAL :  @if ($devise_out === 'EUR')
                  {{ $total }}  <i class="fa fa-eur" aria-hidden="true"></i>
                @elseif($devise_out === 'USD')
                   {{ $total }} <i class="fa fa-dollar"></i>
                @endif </p>

                <form action="{{ route('action_t_money') }}" method="POST">
                  @csrf
                  <div class="form-group" hidden>
                    <input class="form-control" type="text" name="id" value="{{ $id }}" readonly>
                    <input class="form-control" type="text" name="account_receive" value="{{ $account_receive }}" readonly>
                    <input class="form-control" type="text" name="montant" value="{{ $montant }}" readonly>
                    <input class="form-control" type="text" name="coin_enter" value="{{ $coin_enter }}" readonly>
                    <input class="form-control" type="text" name="coin_out" value="{{ $coin_out }}" readonly>
                  </div>
                  @if ($personne->pays === null || $personne->ville === null || $personne->identity === null || 
                    $personne->selfie === null || $personne->image_justivicative === null)
                    <h4 style="color:red;"> Veuillez valider votre identité ! </h4>
                    <button disabled class="btn btn-outline-danger btn-lg" title="payement" type="submit"> Regler Payement avec T Money </button>
                  @else
                    <button class="btn btn-outline-danger btn-lg" type="submit" title="payement"> Regler Payement avec T Money </button>
                  @endif
                </form>
              
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>



@elseif(strtolower($monnaie_entree->libelle) === 'perfect money' || strtolower($monnaie_entree->libelle) === 'perfectmoney'
    || strtolower($monnaie_entree->libelle) === 'perfet money')
  <div class="accordion" id="accordionExample">
    <div class="card">
      <div class="card-header" id="headingOne">
        <h2 class="mb-0">
          <button class="btn btn-light" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          INFORMATIONS FACTURATION
          </button>
        </h2>
      </div>

      <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <p class="text-light bg-dark pl-1"> Prénom(s) : {{ $personne->prenom }} </p>
            </div>
            <div class="col-md-6">
              <p class="text-light bg-dark pl-1"> Nom :  {{ $personne->nom }} </p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <p class="text-light bg-dark pl-1"> Pays :  {{ $personne->pays }} </p>
            </div>
            <div class="col-md-6">
              <p class="text-light bg-dark pl-1"> Ville :  {{ $personne->ville }} </p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <p class="text-light bg-dark pl-1"> Téléphone :  {{ $personne->contact }} </p>
            </div>
            <div class="col-md-6">
              <p class="text-light bg-dark pl-1"> Adresse :   {{ $personne->adresse }} </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" id="headingTwo">
        <h2 class="mb-0">
          <button class="btn btn-light collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            DETAIL DE LA COMMANDE
          </button>
        </h2>
      </div>
      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <p class="text-light bg-dark pl-1"> PRODUIT </p>
            </div>
            <div class="col-md-6">
              <p class="text-light bg-dark pl-1"> TOTAL </p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <p> <h3 class="text-center"> Transaction De {{ $monnaie_entree->libelle }} Vers {{ $monnaie_sortie->libelle }} </h3> </p>
              <ul>
                <li> Vous avez envoyé : {{ "$montant $devise_enter" }} </li>
                <li>
                  Vous reçevez :
                  @if ($devise_out === 'EUR')
                    {{ $total }}  <i class="fa fa-eur" aria-hidden="true"></i>
                  @elseif($devise_out === 'USD')
                    {{ $total }} <i class="fa fa-dollar"></i>
                  @endif
                </li>
                
              </ul>
              <div style="float: right">
                <p class="text-light bg-dark pl-1"> TOTAL :  @if ($devise_out === 'EUR')
                  {{ $total }}  <i class="fa fa-eur" aria-hidden="true"></i>
                @elseif($devise_out === 'USD')
                  {{ $total }} <i class="fa fa-dollar"></i>
                @endif </p>

                <form action="{{ route('action_perfect_money') }}" method="POST">
                  @csrf
                  <div class="form-group" hidden>
                    <input class="form-control" type="text" name="id" value="{{ $id }}" readonly>
                    <input class="form-control" type="text" name="account_receive" value="{{ $account_receive }}" readonly>
                    <input class="form-control" type="text" name="montant" value="{{ $montant }}" readonly>
                    <input class="form-control" type="text" name="coin_enter" value="{{ $coin_enter }}" readonly>
                    <input class="form-control" type="text" name="coin_out" value="{{ $coin_out }}" readonly>
                  </div>
                  {{-- @if ($personne->pays === null || $personne->ville === null || $personne->identity === null || 
                    $personne->selfie === null || $personne->image_justivicative === null)
                    <h4 style="color:red;"> Veuillez valider votre identité ! </h4>
                    <button disabled class="btn btn-outline-danger btn-lg" title="payement" type="submit"> Regler Payement avec Perfect Money</button>
                  @else --}}
                    <button class="btn btn-outline-danger btn-lg" type="submit" title="payement"> Regler Payement avec Perfect Money </button>
                  {{-- @endif --}}
                </form>
              
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>



@elseif(strtolower($monnaie_entree->libelle) === 'payeer' || strtolower($monnaie_entree->libelle) === 'payer')
    <div class="accordion" id="accordionExample">
      <div class="card">
        <div class="card-header" id="headingOne">
          <h2 class="mb-0">
            <button class="btn btn-light" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            INFORMATIONS FACTURATION
            </button>
          </h2>
        </div>

        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <p class="text-light bg-dark pl-1"> Prénom(s) : {{ $personne->prenom }} </p>
              </div>
              <div class="col-md-6">
                <p class="text-light bg-dark pl-1"> Nom :  {{ $personne->nom }} </p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <p class="text-light bg-dark pl-1"> Pays :  {{ $personne->pays }} </p>
              </div>
              <div class="col-md-6">
                <p class="text-light bg-dark pl-1"> Ville :  {{ $personne->ville }} </p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <p class="text-light bg-dark pl-1"> Téléphone :  {{ $personne->contact }} </p>
              </div>
              <div class="col-md-6">
                <p class="text-light bg-dark pl-1"> Adresse :   {{ $personne->adresse }} </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header" id="headingTwo">
          <h2 class="mb-0">
            <button class="btn btn-light collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              DETAIL DE LA COMMANDE
            </button>
          </h2>
        </div>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <p class="text-light bg-dark pl-1"> PRODUIT </p>
              </div>
              <div class="col-md-6">
                <p class="text-light bg-dark pl-1"> TOTAL </p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <p> <h3 class="text-center"> Transaction De {{ $monnaie_entree->libelle }} Vers {{ $monnaie_sortie->libelle }} </h3> </p>
                <ul>
                  <li> Vous avez envoyé : {{ "$montant $devise_enter" }} </li>
                  <li>
                    Vous reçevez :
                    @if ($devise_out === 'EUR')
                      {{ $total }}  <i class="fa fa-eur" aria-hidden="true"></i>
                    @elseif($devise_out === 'USD')
                      {{ $total }} <i class="fa fa-dollar"></i>
                    @endif
                  </li>
                  
                </ul>
                <div style="float: right">
                  <p class="text-light bg-dark pl-1"> TOTAL :  @if ($devise_out === 'EUR')
                    {{ $total }}  <i class="fa fa-eur" aria-hidden="true"></i>
                  @elseif($devise_out === 'USD')
                    {{ $total }} <i class="fa fa-dollar"></i>
                  @endif </p>

                  <form action="{{ route('action_payeer') }}" method="POST">
                    @csrf
                    <div class="form-group" hidden>
                      <input class="form-control" type="text" name="id" value="{{ $id }}" readonly>
                      <input class="form-control" type="text" name="account_receive" value="{{ $account_receive }}" readonly>
                      <input class="form-control" type="text" name="montant" value="{{ $montant }}" readonly>
                      <input class="form-control" type="text" name="coin_enter" value="{{ $coin_enter }}" readonly>
                      <input class="form-control" type="text" name="coin_out" value="{{ $coin_out }}" readonly>
                    </div>
                    {{-- @if ($personne->pays === null || $personne->ville === null || $personne->identity === null || 
                      $personne->selfie === null || $personne->image_justivicative === null)
                      <h4 style="color:red;"> Veuillez valider votre identité ! </h4>
                      <button disabled class="btn btn-outline-danger btn-lg" title="payement" type="submit"> Regler Payement avec Payeer</button>
                    @else --}}
                      <button class="btn btn-outline-primary btn-lg" type="submit" title="payement"> Regler Payement avec Payeer </button>
                    {{-- @endif --}}
                  </form>
                
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

@endif

@endsection