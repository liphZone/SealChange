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
  $personne       = \App\Models\Personne::where('id',$user)->first();
  $monnaie_entree = \App\Models\Coin::where('id',$coin_enter)->first();
  $monnaie_sortie = \App\Models\Coin::where('id',$coin_out)->first();
@endphp

@if (strtolower($monnaie_entree->libelle) === 'payeer' || strtolower($monnaie_entree->libelle) === 'payer')
    
  @if (strtolower($monnaie_sortie->libelle) === 'flooz' || strtolower($monnaie_sortie->libelle) === 'tmoney' || 
  strtolower($monnaie_sortie->libelle) === 't money' || strtolower($monnaie_sortie->libelle) === 'mtn' ||
  strtolower($monnaie_sortie->libelle) === 'm t n' || strtolower($monnaie_sortie->libelle) === 'mtn money' ||
  strtolower($monnaie_sortie->libelle) === 'mtn mobile money')

      <div class="accordion" id="accordionExample">
        <div class="card">
          <div class="card-header" id="headingTwo">
            <h2 class="mb-0">
              <button class="btn btn-light collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                CREDITER VOTRE COMPTE MOBILE
              </button>
            </h2>
          </div>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
            <div class="card-body">
            
              <div class="row">
                <div class="col-md-12">
                
                
                    <form action="{{ route('action_send_payeer') }}" method="POST">
                      @csrf

                      <label for=""> Numéro de téléphone </label>
                      <div class="form-inline">
                        <select class="form-control" name="indicatif" id="">
                          @foreach ($phone as $cle=>$valeur)
                            <option value=" {{ "+".$valeur }}"> (+ {{ $valeur }}) </option>
                          @endforeach
                        </select>
                        <input class="form-control" type="tel" name="telephone" autocomplete="off" required>
                        @error('telephone')
                          <div style="color: red;"> {{ $message }} </div>
                        @enderror
                      </div>
                      
                      <div class="form-group" hidden>
                        <input class="form-control" type="text" name="id_transaction" value="{{ $id_transaction }}" readonly>
                        <input class="form-control" type="text" name="myaccount" value="{{ $moncompte }}" readonly>
                        <input class="form-control" type="text" name="amount" value="{{ $montant }}" readonly>
                        <input class="form-control" type="text" name="having_amount" value="{{ $montant_a_recevoir }}" readonly>
                        <input class="form-control" type="text" name="coin_enter" value="{{ $coin_enter }}" readonly>
                        <input class="form-control" type="text" name="coin_out" value="{{ $coin_out }}" readonly>
                        <input class="form-control" type="text" name="devise_enter" value="{{ $devise_enter }}" readonly>
                        <input class="form-control" type="text" name="devise_out" value="{{ $devise_out }}" readonly>
                      </div>
                      <div class="mt-3">
                        <button class="btn btn-outline-warning btn-lg" type="submit" title="payement"> Valider</button>
                      </div>
                    </form>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>



    @elseif (strtolower($monnaie_sortie->libelle) === 'perfect money' || strtolower($monnaie_sortie->libelle) === 'perfectmoney' || 
    strtolower($monnaie_sortie->libelle) === 'perfet money' )
      <div class="accordion" id="accordionExample">

        <div class="card">
          <div class="card-header" id="headingTwo">
            <h2 class="mb-0">
              <button class="btn btn-light collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                DETAIL COMMANDE
              </button>
            </h2>
          </div>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
            <div class="card-body">
            
              <div class="row">
                <div class="col-md-12">
                
                    <form action="{{ route('action_send_payeer') }}" method="POST">
                      @csrf
                      <div class="form-group">
                        <label for="">Confirmer votre adresse perfect money </label>
                        <input class="form-control" type="text" name="account_receiver" autocomplete="off" required>
                        @error('account_receiver')
                          <div style="color: red;"> {{ $message }} </div>
                        @enderror
                      </div>

                      <div class="form-group" hidden>
                        <input class="form-control" type="text" name="id_transaction" value="{{ $id_transaction }}" readonly>
                        <input class="form-control" type="text" name="myaccount" value="{{ $moncompte }}" readonly>
                        <input class="form-control" type="text" name="amount" value="{{ $montant }}" readonly>
                        <input class="form-control" type="text" name="having_amount" value="{{ $montant_a_recevoir }}" readonly>
                        <input class="form-control" type="text" name="coin_enter" value="{{ $coin_enter }}" readonly>
                        <input class="form-control" type="text" name="coin_out" value="{{ $coin_out }}" readonly>
                        <input class="form-control" type="text" name="devise_enter" value="{{ $devise_enter }}" readonly>
                        <input class="form-control" type="text" name="devise_out" value="{{ $devise_out }}" readonly>
                      </div>
                      <div class="mt-3">
                        <button class="btn btn-outline-warning btn-lg" type="submit" title="payement"> Valider</button>
                      </div>
                    </form>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  @endif

@elseif(strtolower($monnaie_entree->libelle) === 'perfect money' || strtolower($monnaie_entree->libelle) === 'perfectmoney' 
|| strtolower($monnaie_entree->libelle) === 'perfet money')

      @if (strtolower($monnaie_sortie->libelle) === 'flooz' || strtolower($monnaie_sortie->libelle) === 'tmoney' || 
      strtolower($monnaie_sortie->libelle) === 't money' || strtolower($monnaie_sortie->libelle) === 'mtn' ||
      strtolower($monnaie_sortie->libelle) === 'm t n' || strtolower($monnaie_sortie->libelle) === 'mtn money' ||
      strtolower($monnaie_sortie->libelle) === 'mtn mobile money')
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
                          {{ $montant_a_recevoir }}  <i class="fa fa-eur" aria-hidden="true"></i>
                        @elseif($devise_out === 'USD')
                          {{ $montant_a_recevoir }} <i class="fa fa-dollar"></i>
                        @endif
                      </li>
                      
                    </ul>
                    <div style="float: right">
                      <p class="text-light bg-dark pl-1"> TOTAL :  @if ($devise_out === 'EUR')
                        {{ $montant_a_recevoir }}  <i class="fa fa-eur" aria-hidden="true"></i>
                      @elseif($devise_out === 'USD')
                        {{ $montant_a_recevoir }} <i class="fa fa-dollar"></i>
                      @endif </p>
        
                      <form action="{{ route('form_action_perfect_money') }}" method="POST">
                        @csrf

                        <label for=""> Numéro de téléphone </label>
                        <div class="form-inline">
                          <select class="form-control" name="indicatif" id="">
                            @foreach ($phone as $cle=>$valeur)
                              <option value=" {{ "+".$valeur }}"> (+ {{ $valeur }}) </option>
                            @endforeach
                          </select>
                          <input class="form-control" type="tel" name="telephone" autocomplete="off" required>
                          @error('telephone')
                            <div style="color: red;"> {{ $message }} </div>
                          @enderror
                        </div>
                        <div class="form-group" hidden>
                          <input class="form-control" type="text" name="id_transaction" value="{{ $id_transaction }}" readonly>
                          <input class="form-control" type="text" name="myaccount" value="{{ $moncompte }}" readonly>
                          <input class="form-control" type="text" name="montant" value="{{ $montant }}" readonly>
                          <input class="form-control" type="text" name="having_amount" value="{{ $montant_a_recevoir }}" readonly>
                          <input class="form-control" type="text" name="account_receive" value="{{ $account_receive }}" readonly>
                          <input class="form-control" type="text" name="coin_enter" value="{{ $coin_enter }}" readonly>
                          <input class="form-control" type="text" name="coin_out" value="{{ $coin_out }}" readonly>
                          <input class="form-control" type="text" name="devise_enter" value="{{ $devise_enter }}" readonly>
                          <input class="form-control" type="text" name="devise_out" value="{{ $devise_out }}" readonly>
                          <input type="text" name="payee_name" value="{{ $payee_name }}">
                        </div>
                        @if ($personne->pays === null && $personne->ville === null && $personne->identity === null && 
                          $personne->selfie === null && $personne->image_justivicative === null)
                          <h4 style="color:red;"> Veuillez valider votre identité ! </h4>
                          <button disabled class="btn btn-outline-danger btn-lg" title="payement" type="submit"> Regler Payement avec Perfect Money</button>
                        @else
                          <button class="btn btn-outline-danger btn-lg" type="submit" title="payement"> Regler Payement avec Perfect Money </button>
                        @endif
                      </form>
                    
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      @else
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
                          {{ $montant_a_recevoir }}  <i class="fa fa-eur" aria-hidden="true"></i>
                        @elseif($devise_out === 'USD')
                          {{ $montant_a_recevoir }} <i class="fa fa-dollar"></i>
                        @endif
                      </li>
                      
                    </ul>
                    <div style="float: right">
                      <p class="text-light bg-dark pl-1"> TOTAL :  @if ($devise_out === 'EUR')
                        {{ $montant_a_recevoir }}  <i class="fa fa-eur" aria-hidden="true"></i>
                      @elseif($devise_out === 'USD')
                        {{ $montant_a_recevoir }} <i class="fa fa-dollar"></i>
                      @endif </p>
        
                      <form action="{{ route('form_action_perfect_money') }}" method="POST">
                        @csrf
                        <div class="form-group" hidden>
                          <input class="form-control" type="text" name="id_transaction" value="{{ $id_transaction }}" readonly>
                          <input class="form-control" type="text" name="myaccount" value="{{ $moncompte }}" readonly>
                          <input class="form-control" type="text" name="montant" value="{{ $montant }}" readonly>
                          <input class="form-control" type="text" name="having_amount" value="{{ $montant_a_recevoir }}" readonly>
                          <input class="form-control" type="text" name="account_receive" value="{{ $account_receive }}" readonly>
                          <input class="form-control" type="text" name="coin_enter" value="{{ $coin_enter }}" readonly>
                          <input class="form-control" type="text" name="coin_out" value="{{ $coin_out }}" readonly>
                          <input class="form-control" type="text" name="devise_enter" value="{{ $devise_enter }}" readonly>
                          <input class="form-control" type="text" name="devise_out" value="{{ $devise_out }}" readonly>
                          <input type="text" name="payee_name" value="{{ $payee_name }}">
                        </div>
                        @if ($personne->pays === null && $personne->ville === null && $personne->identity === null && 
                          $personne->selfie === null && $personne->image_justivicative === null)
                          <h4 style="color:red;"> Veuillez valider votre identité ! </h4>
                          <button disabled class="btn btn-outline-danger btn-lg" title="payement" type="submit"> Regler Payement avec Perfect Money</button>
                        @else
                          <button class="btn btn-outline-danger btn-lg" type="submit" title="payement"> Regler Payement avec Perfect Money </button>
                        @endif
                      </form>
                    
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      @endif

@elseif(strtolower($monnaie_entree->libelle) === 'flooz')

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
                  {{ $montant_a_recevoir }}  <i class="fa fa-eur" aria-hidden="true"></i>
                  @elseif($devise_out === 'USD')
                  {{ $montant_a_recevoir }} <i class="fa fa-dollar"></i>
                  @endif
                </li>
                
              </ul>
              <div style="float: right">
                <p class="text-light bg-dark pl-1"> TOTAL :  @if ($devise_out === 'EUR')
                  {{ $montant_a_recevoir }}  <i class="fa fa-eur" aria-hidden="true"></i>
                @elseif($devise_out === 'USD')
                  {{ $montant_a_recevoir }} <i class="fa fa-dollar"></i>
                @endif </p>

                <form action="{{ route('action_mobile_money') }}" method="POST">
                  @csrf
                  <label for=""> Votre numéro de téléphone </label>
                  <div class="form-inline">
                    <select class="form-control" name="indicatif" id="">
                      @foreach ($phone as $cle=>$valeur)
                        <option value=" {{ "+".$valeur }}"> (+ {{ $valeur }}) </option>
                      @endforeach
                    </select>
                    <input class="form-control" type="tel" name="telephone" autocomplete="off" required>
                    @error('telephone')
                      <div style="color: red;"> {{ $message }} </div>
                    @enderror
                  </div>
                  <div class="form-group" hidden>
                    <input class="form-control" type="text" name="id_transaction" value="{{ $id_transaction }}" readonly>
                    <input class="form-control" type="text" name="account_receive" value="{{ $account_receive }}" readonly>
                    <input class="form-control" type="text" name="amount" value="{{ $montant }}" readonly>
                    <input class="form-control" type="text" name="having_amount" value="{{ $montant_a_recevoir }}" readonly>
                    <input class="form-control" type="text" name="coin_enter" value="{{ $coin_enter }}" readonly>
                    <input class="form-control" type="text" name="coin_out" value="{{ $coin_out }}" readonly>
                    <input class="form-control" type="text" name="devise_enter" value="{{ $devise_enter }}" readonly>
                    <input class="form-control" type="text" name="devise_out" value="{{ $devise_out }}" readonly>
                  </div>
                    <button class="btn btn-outline-success btn-lg" type="submit" title="payement"> Regler Payement avec Flooz </button>
                </form>
              
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


@elseif( strtolower($monnaie_entree->libelle) === 'mtn' || strtolower($monnaie_entree->libelle) === 'm t n' 
|| strtolower($monnaie_entree->libelle) === 'mtn money' || strtolower($monnaie_entree->libelle) === 'mtn mobile money')

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
                  {{ $montant_a_recevoir }}  <i class="fa fa-eur" aria-hidden="true"></i>
                  @elseif($devise_out === 'USD')
                  {{ $montant_a_recevoir }} <i class="fa fa-dollar"></i>
                  @endif
                </li>
                
              </ul>
              <div style="float: right">
                <p class="text-light bg-dark pl-1"> TOTAL :  @if ($devise_out === 'EUR')
                  {{ $montant_a_recevoir }}  <i class="fa fa-eur" aria-hidden="true"></i>
                @elseif($devise_out === 'USD')
                  {{ $montant_a_recevoir }} <i class="fa fa-dollar"></i>
                @endif </p>

                <form action="{{ route('action_mobile_money') }}" method="POST">
                  @csrf
                  <label for=""> Votre numéro de téléphone </label>
                  <div class="form-inline">
                    <select class="form-control" name="indicatif" id="">
                      @foreach ($phone as $cle=>$valeur)
                        <option value=" {{ "+".$valeur }}"> (+ {{ $valeur }}) </option>
                      @endforeach
                    </select>
                    <input class="form-control" type="tel" name="telephone" autocomplete="off" required>
                    @error('telephone')
                      <div style="color: red;"> {{ $message }} </div>
                    @enderror
                  </div>
                  <div class="form-group" hidden>
                    <input class="form-control" type="text" name="id_transaction" value="{{ $id_transaction }}" readonly>
                    <input class="form-control" type="text" name="account_receive" value="{{ $account_receive }}" readonly>
                    <input class="form-control" type="text" name="amount" value="{{ $montant }}" readonly>
                    <input class="form-control" type="text" name="having_amount" value="{{ $montant_a_recevoir }}" readonly>
                    <input class="form-control" type="text" name="coin_enter" value="{{ $coin_enter }}" readonly>
                    <input class="form-control" type="text" name="coin_out" value="{{ $coin_out }}" readonly>
                    <input class="form-control" type="text" name="devise_enter" value="{{ $devise_enter }}" readonly>
                    <input class="form-control" type="text" name="devise_out" value="{{ $devise_out }}" readonly>
                  </div>
              
                    <button class="btn btn-outline-warning btn-lg" type="submit" title="payement"> Regler Payement avec Mtn </button>
                </form>
              
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  
@elseif( strtolower($monnaie_entree->libelle) === 't money' || strtolower($monnaie_entree->libelle) === 'tmoney')

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
                  {{ $montant_a_recevoir }}  <i class="fa fa-eur" aria-hidden="true"></i>
                  @elseif($devise_out === 'USD')
                  {{ $montant_a_recevoir }} <i class="fa fa-dollar"></i>
                  @endif
                </li>
                
              </ul>
              <div style="float: right">
                <p class="text-light bg-dark pl-1"> TOTAL :  @if ($devise_out === 'EUR')
                  {{ $montant_a_recevoir }}  <i class="fa fa-eur" aria-hidden="true"></i>
                @elseif($devise_out === 'USD')
                  {{ $montant_a_recevoir }} <i class="fa fa-dollar"></i>
                @endif </p>

                <form action="{{ route('action_t_money') }}" method="POST">
                  @csrf
                  <label for=""> Votre numéro de téléphone </label>
                  <div class="form-inline">
                    <select class="form-control" name="indicatif" id="">
                      @foreach ($phone as $cle=>$valeur)
                        <option value=" {{ "+".$valeur }}"> (+ {{ $valeur }}) </option>
                      @endforeach
                    </select>
                    <input class="form-control" type="tel" name="telephone" autocomplete="off" required>
                    @error('telephone')
                      <div style="color: red;"> {{ $message }} </div>
                    @enderror
                  </div>

                  <div class="form-group" hidden>
                    <input class="form-control" type="text" name="id_transaction" value="{{ $id_transaction }}" readonly>
                    <input class="form-control" type="text" name="account_receive" value="{{ $account_receive }}" readonly>
                    <input class="form-control" type="text" name="amount" value="{{ $montant }}" readonly>
                    <input class="form-control" type="text" name="having_amount" value="{{ $montant_a_recevoir }}" readonly>
                    <input class="form-control" type="text" name="coin_enter" value="{{ $coin_enter }}" readonly>
                    <input class="form-control" type="text" name="coin_out" value="{{ $coin_out }}" readonly>
                    <input class="form-control" type="text" name="devise_enter" value="{{ $devise_enter }}" readonly>
                    <input class="form-control" type="text" name="devise_out" value="{{ $devise_out }}" readonly>
                  </div>
              
                    <button class="btn btn-outline-warning btn-lg" type="submit" title="payement"> Regler Payement avec TMoney </button>
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