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
  $pin            = rand(10000,20000);
@endphp

@if (strtolower($monnaie_entree->libelle) === 'perfect money' || strtolower($monnaie_entree->libelle) === 'perfectmoney' ||
strtolower($monnaie_entree->libelle) === 'perfet money')

  @if (strtolower($monnaie_sortie->libelle) === 'flooz' || strtolower($monnaie_sortie->libelle) === 'tmoney' || 
  strtolower($monnaie_sortie->libelle) === 't money' || strtolower($monnaie_sortie->libelle) === 'mtn' ||
  strtolower($monnaie_sortie->libelle) === 'm t n' || strtolower($monnaie_sortie->libelle) === 'mtn money' ||
  strtolower($monnaie_sortie->libelle) === 'mtn mobile money')
  
    <div class="accordion" id="accordionExample">
      <div class="card">
        <div class="card-header" id="headingOne">
          <h2 class="mb-0">
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
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
            <button class="btn btn-primary collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              DETAIL DE LA COMMANDE (cliquez pour dérouler) <i class="fa fa-arrow-circle-down" aria-hidden="true"></i>
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
                    @if ($devise_out === 'USD')
                      {{ $montant_a_recevoir }}  <i class="fa fa-dollar" aria-hidden="true"></i>
                    @elseif($devise_out === 'XOF')
                      {{ $montant_a_recevoir }} F CFA
                    @endif
                  </li>
                  
                </ul>
                <div style="float: right">
                  <p class="text-light bg-dark pl-1"> TOTAL :  
                  @if ($devise_out === 'USD')
                    {{ $montant_a_recevoir }}  <i class="fa fa-dollar" aria-hidden="true"></i>
                  @elseif($devise_out === 'XOF')
                    {{ $montant_a_recevoir }} F CFA
                  @endif </p>
    
                  <form action="{{ route('form_action_perfect_money') }}" method="POST">
                    @csrf

                    <label for=""> Numéro de téléphone </label>
                    <div class="form-inline">
                      <select class="form-control" onchange="choiceIndicatifPhone()" name="indicatif" id="indicatif_phone">
                        <option value=""> Choisir </option>
                        @foreach ($phone as $cle=>$valeur)
                          <option value=" {{ "+".$valeur }}"> (+ {{ $valeur }}) </option>
                        @endforeach
                      </select>
                      <input class="form-control" type="tel" name="telephone" id="phone" autocomplete="off" required>
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
                      <button class="btn btn-outline-danger btn-lg" type="submit" title="payement"> Regler Payement avec Perfect Money </button>
                  </form>
                
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  @elseif(strtolower($monnaie_sortie->libelle) === 'bitcoin' || strtolower($monnaie_sortie->libelle) === 'bit coin')

    <div class="accordion" id="accordionExample">
      <div class="card">
        <div class="card-header" id="headingOne">
          <h2 class="mb-0">
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
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
            <button class="btn btn-primary collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              DETAIL DE LA COMMANDE (cliquez pour dérouler) <i class="fa fa-arrow-circle-down" aria-hidden="true"></i>
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
                  <li> Vous avez envoyé : {{ "$montant" }} <i class="fa fa-dollar" aria-hidden="true"></i> </li>
                  <li>
                    Vous reçevez :
                      {{ $montant_a_recevoir }} <i class="fa fa-dollar"></i> de Bitcoin
                  </li>
                </ul>
                <div style="float: right">
                  <p class="text-light bg-dark pl-1"> TOTAL : {{ $montant_a_recevoir }} <i class="fa fa-dollar"></i></p>
    
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
                      <button class="btn btn-outline-danger btn-lg" type="submit" title="payement"> Regler Payement avec Perfect Money </button>
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
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
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
            <button class="btn btn-primary collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              DETAIL DE LA COMMANDE (cliquez pour dérouler) <i class="fa fa-arrow-circle-down" aria-hidden="true"></i>
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
                  <li> Vous avez envoyé : {{ "$montant" }} <i class="fa fa-dollar"></i> </li> 
                  <li>
                    Vous reçevez :
                      {{ $montant_a_recevoir }} <i class="fa fa-dollar"></i>
                  </li>
                  
                </ul>
                <div style="float: right">
                  <p class="text-light bg-dark pl-1"> TOTAL : {{ $montant_a_recevoir }} <i class="fa fa-dollar"></i></p>
    
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
                      <button class="btn btn-outline-danger btn-lg" type="submit" title="payement"> Regler Payement avec Perfect Money </button>
                  </form>
                
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endif

@elseif(strtolower($monnaie_entree->libelle) === 'payeer' || strtolower($monnaie_entree->libelle) === 'payer')

  @if (strtolower($monnaie_sortie->libelle) === 'flooz' || strtolower($monnaie_sortie->libelle) === 'tmoney' || 
  strtolower($monnaie_sortie->libelle) === 't money' || strtolower($monnaie_sortie->libelle) === 'mtn' ||
  strtolower($monnaie_sortie->libelle) === 'm t n' || strtolower($monnaie_sortie->libelle) === 'mtn money' ||
  strtolower($monnaie_sortie->libelle) === 'mtn mobile money')
     
    <form action="{{ route('action_payeer') }}" method="POST">
      @csrf

      <label for=""> Numéro de téléphone </label>
      <div class="form-inline">
        <select class="form-control" onchange="choiceIndicatifPhone()" name="indicatif" id="indicatif_phone">
          <option value=""> Choisir </option>
          @foreach ($phone as $cle=>$valeur)
            <option value=" {{ "+".$valeur }}"> (+ {{ $valeur }}) </option>
          @endforeach
        </select>
        <input class="form-control" type="tel" name="telephone" id="phone" autocomplete="off" required>
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
        <button class="btn btn-outline-primary btn-lg" type="submit" title="payement"> Valider</button>
      </div>
    </form>
                
  @elseif (strtolower($monnaie_sortie->libelle) === 'bitcoin' || strtolower($monnaie_sortie->libelle) === 'bit coin')

    <form action="{{ route('action_payeer') }}" method="POST">
      @csrf

      <div class="form-group" hidden>
        <input class="form-control" type="text" name="id_transaction" value="{{ $id_transaction }}" readonly>
        <input class="form-control" type="text" name="myaccount" value="{{ $moncompte }}" readonly>
        <input class="form-control" type="text" name="amount" value="{{ $montant }}" readonly>
        <input class="form-control" type="text" name="having_amount" value="{{ $montant_a_recevoir }}" readonly>
        <input class="form-control" type="text" name="coin_enter" value="{{ $coin_enter }}" readonly>
        <input class="form-control" type="text" name="coin_out" value="{{ $coin_out }}" readonly>
        <input class="form-control" type="text" name="devise_enter" value="{{ $devise_enter }}" readonly>
        <input class="form-control" type="text" name="account_receiver" value="{{ $account_receiver }}" readonly>
        <input class="form-control" type="text" name="devise_out" value="{{ $devise_out }}" readonly>
      </div>
      <div class="mt-3">
        <button class="btn btn-outline-primary btn-lg" type="submit" title="payement"> Valider pour continuer <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
      </div>
    </form>
                
  @else
    
    <form action="{{ route('action_payeer') }}" method="POST">
      @csrf
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
        <button class="btn btn-outline-primary btn-lg" type="submit" title="payement"> Valider pour continuer <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
      </div>
    </form>
                

  @endif

@elseif(strtolower($monnaie_entree->libelle) === 'mtn' || strtolower($monnaie_entree->libelle) === 'm t n' ||
strtolower($monnaie_entree->libelle) === 'mtn money' || strtolower($monnaie_entree->libelle) === 'mtn mobile money')

  @if (strtolower($monnaie_sortie->libelle) === 'flooz' || strtolower($monnaie_sortie->libelle) === 'tmoney' ||
  strtolower($monnaie_sortie->libelle) === 't money')
    <div class="accordion" id="accordionExample">
      <div class="card">
        <div class="card-header" id="headingOne">
          <h2 class="mb-0">
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
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
            <button class="btn btn-primary collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              DETAIL DE LA COMMANDE (cliquez pour dérouler) <i class="fa fa-arrow-circle-down" aria-hidden="true"></i>
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
                  <li> Vous avez envoyé : {{ "$montant" }} F CFA </li>
                  <li>
                    Vous reçevez :
                    {{ $montant_a_recevoir }} F CFA
                  </li>
                  
                </ul>
                <div style="float: right">
                  <p class="text-light bg-dark pl-1"> TOTAL :{{ $montant_a_recevoir }}  F CFA </p>
  
                  <form action="{{ route('action_mobile_money') }}" method="POST">
                    @csrf
                    <label for=""> Votre numéro de téléphone </label>
                    <div class="form-inline">
                      <select class="form-control" onchange="choiceIndicatifPhone()" name="indicatif" id="indicatif_phone">
                        <option value=""> Choisir </option>
                        @foreach ($phone as $cle=>$valeur)
                          <option value=" {{ "+".$valeur }}"> (+ {{ $valeur }}) </option>
                        @endforeach
                      </select>
                      <input class="form-control" type="tel" name="telephone" id="phone" autocomplete="off" required>
                      @error('telephone')
                        <div style="color: red;"> {{ $message }} </div>
                      @enderror
                    </div>

                    <label for=""> Votre numérode réception </label>
                    <div class="form-inline">
                      <select class="form-control" onchange="choiceIndicatifPhoneReceive()" name="indicatif" id="indicatif_phone_receive">
                        <option value=""> Choisir </option>
                        @foreach ($phone as $cle=>$valeur)
                          <option value=" {{ "+".$valeur }}"> (+ {{ $valeur }}) </option>
                        @endforeach
                      </select>
                      <input class="form-control" type="tel" name="account_receive" id="phone_receive" autocomplete="off" required>
                      @error('account_receive')
                        <div style="color: red;"> {{ $message }} </div>
                      @enderror
                    </div>
                    <div class="form-group" hidden>
                      <input class="form-control" type="text" name="id_transaction" value="{{ $id_transaction }}" readonly>
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
  @else
    <div class="accordion" id="accordionExample">
      <div class="card">
        <div class="card-header" id="headingOne">
          <h2 class="mb-0">
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
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
            <button class="btn btn-primary collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              DETAIL DE LA COMMANDE (cliquez pour dérouler) <i class="fa fa-arrow-circle-down" aria-hidden="true"></i>
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
                      <select class="form-control" onchange="choiceIndicatifPhone()" name="indicatif" id="indicatif_phone">
                        <option value=""> Choisir </option>
                        @foreach ($phone as $cle=>$valeur)
                          <option value=" {{ "+".$valeur }}"> (+ {{ $valeur }}) </option>
                        @endforeach
                      </select>
                      <input class="form-control" type="tel" name="telephone" id="phone" autocomplete="off" required>
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
  @endif

@elseif(strtolower($monnaie_entree->libelle) === 'flooz')

  @if (strtolower($monnaie_sortie->libelle) === 'tmoney' ||  strtolower($monnaie_sortie->libelle) === 't money' ||
  strtolower($monnaie_sortie->libelle) === 'mtn' || strtolower($monnaie_sortie->libelle) === 'm t n' || 
  strtolower($monnaie_sortie->libelle) === 'mtn money' || strtolower($monnaie_sortie->libelle) === 'mtn mobile money')
    <div class="accordion" id="accordionExample">
      <div class="card">
        <div class="card-header" id="headingOne">
          <h2 class="mb-0">
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
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
            <button class="btn btn-primary collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              DETAIL DE LA COMMANDE (cliquez pour dérouler) <i class="fa fa-arrow-circle-down" aria-hidden="true"></i>
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
                  <li> Vous avez envoyé : {{ "$montant" }} F CFA </li>
                  <li>
                    Vous reçevez :
                    @if ($devise_out === 'USD')
                      {{ $montant_a_recevoir }}  <i class="fa fa-dollar" aria-hidden="true"></i>
                    @elseif($devise_out === 'XOF')
                      {{ $montant_a_recevoir }} F CFA
                    @endif
                  </li>
                </ul>
                <div style="float: right">
                  <p class="text-light bg-dark pl-1"> TOTAL :  
                  @if ($devise_out === 'USD')
                    {{ $montant_a_recevoir }}  <i class="fa fa-dollar" aria-hidden="true"></i>
                  @elseif($devise_out === 'XOF')
                    {{ $montant_a_recevoir }} F CFA
                  @endif </p>

                  <form action="{{ route('action_mobile_money') }}" method="POST">
                    @csrf
                    <label for=""> Votre numéro de téléphone </label>
                    <div class="form-inline">
                      <select class="form-control" onchange="choiceIndicatifPhone()" name="indicatif" id="indicatif_phone">
                        <option value=""> Choisir </option>
                        @foreach ($phone as $cle=>$valeur)
                          <option value=" {{ "+".$valeur }}"> (+ {{ $valeur }}) </option>
                        @endforeach
                      </select>
                      <input class="form-control" type="tel" name="telephone" id="phone" autocomplete="off" required>
                      @error('telephone')
                        <div style="color: red;"> {{ $message }} </div>
                      @enderror
                    </div>

                    <label for=""> Votre numérode réception </label>
                    <div class="form-inline">
                      <select class="form-control" onchange="choiceIndicatifPhoneReceive()" name="indicatif" id="indicatif_phone_receive">
                        <option value=""> Choisir </option>
                        @foreach ($phone as $cle=>$valeur)
                          <option value=" {{ "+".$valeur }}"> (+ {{ $valeur }}) </option>
                        @endforeach
                      </select>
                      <input class="form-control" type="tel" name="account_receive" id="phone_receive" autocomplete="off" required>
                      @error('account_receive')
                        <div style="color: red;"> {{ $message }} </div>
                      @enderror
                    </div>
                    <div class="form-group" hidden>
                      <input class="form-control" type="text" name="id_transaction" value="{{ $id_transaction }}" readonly>
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

  @else
      
    <div class="accordion" id="accordionExample">
      <div class="card">
        <div class="card-header" id="headingOne">
          <h2 class="mb-0">
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
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
            <button class="btn btn-primary collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              DETAIL DE LA COMMANDE (cliquez pour dérouler) <i class="fa fa-arrow-circle-down" aria-hidden="true"></i>
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
                  <li> Vous avez envoyé : {{ "$montant" }} F CFA </li>
                  <li>
                    Vous reçevez :
                    @if ($devise_out === 'USD')
                      {{ $montant_a_recevoir }}  <i class="fa fa-dollar" aria-hidden="true"></i>
                    @elseif($devise_out === 'XOF')
                      {{ $montant_a_recevoir }} F CFA
                    @endif
                  </li>
                </ul>
                <div style="float: right">
                  <p class="text-light bg-dark pl-1"> TOTAL :  
                  @if ($devise_out === 'USD')
                    {{ $montant_a_recevoir }}  <i class="fa fa-dollar" aria-hidden="true"></i>
                  @elseif($devise_out === 'XOF')
                    {{ $montant_a_recevoir }} F CFA
                  @endif </p>

                  <form action="{{ route('action_mobile_money') }}" method="POST">
                    @csrf
                    <label for=""> Votre numéro de téléphone </label>
                    <div class="form-inline">
                      <select class="form-control" onchange="choiceIndicatifPhone()" name="indicatif" id="indicatif_phone">
                        <option value=""> Choisir </option>
                        @foreach ($phone as $cle=>$valeur)
                          <option value=" {{ "+".$valeur }}"> (+ {{ $valeur }}) </option>
                        @endforeach
                      </select>
                      <input class="form-control" type="tel" name="telephone" id="phone" autocomplete="off" required>
                      @error('telephone')
                        <div style="color: red;"> {{ $message }} </div>
                      @enderror
                    </div>
                  
                    <div class="form-group" hidden>
                      <input class="form-control" type="text" name="id_transaction" value="{{ $id_transaction }}" readonly>
                      <input class="form-control" type="text" name="amount" value="{{ $montant }}" readonly>
                      <input class="form-control" type="text" name="having_amount" value="{{ $montant_a_recevoir }}" readonly>
                      <input class="form-control" type="text" name="coin_enter" value="{{ $coin_enter }}" readonly>
                      <input class="form-control" type="text" name="coin_out" value="{{ $coin_out }}" readonly>
                      <input class="form-control" type="text" name="account_receive" value="{{ $account_receive }}" readonly>
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
  @endif

@elseif(strtolower($monnaie_entree->libelle) === 't money' || strtolower($monnaie_entree->libelle) === 'tmoney')

  @if (strtolower($monnaie_sortie->libelle) === 'flooz' || strtolower($monnaie_sortie->libelle) === 'mtn' ||
  strtolower($monnaie_sortie->libelle) === 'm t n' || strtolower($monnaie_sortie->libelle) === 'mtn money' ||
  strtolower($monnaie_sortie->libelle) === 'mtn mobile money')
    <div class="accordion" id="accordionExample">
      <div class="card">
        <div class="card-header" id="headingOne">
          <h2 class="mb-0">
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
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
            <button class="btn btn-primary collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              DETAIL DE LA COMMANDE (cliquez pour dérouler) <i class="fa fa-arrow-circle-down" aria-hidden="true"></i>
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
                  <li> Vous avez envoyé : {{ "$montant" }} F CFA </li>
                  <li>
                    Vous reçevez :
                      {{ $montant_a_recevoir }} F CFA
                  </li>
                  
                </ul>
                <div style="float: right">
                  <p class="text-light bg-dark pl-1"> TOTAL : {{ $montant_a_recevoir }} F CFA </p>

                  <form action="{{ route('action_t_money') }}" method="POST">
                    @csrf
                    <label for=""> Votre numéro de téléphone </label>
                    <div class="form-inline">
                      <select class="form-control" onchange="choiceIndicatifPhone()" name="indicatif" id="indicatif_phone">
                        <option value=""> Choisir </option>
                        @foreach ($phone as $cle=>$valeur)
                          <option value=" {{ "+".$valeur }}"> (+ {{ $valeur }}) </option>
                        @endforeach
                      </select>
                      <input class="form-control" type="tel" name="telephone" id="phone" autocomplete="off" required>
                      @error('telephone')
                        <div style="color: red;"> {{ $message }} </div>
                      @enderror
                    </div>

                    <label for=""> Votre numérode réception </label>
                    <div class="form-inline">
                      <select class="form-control" onchange="choiceIndicatifPhoneReceive()" name="indicatif" id="indicatif_phone_receive">
                        <option value=""> Choisir </option>
                        @foreach ($phone as $cle=>$valeur)
                          <option value=" {{ "+".$valeur }}"> (+ {{ $valeur }}) </option>
                        @endforeach
                      </select>
                      <input class="form-control" type="tel" name="account_receive" id="phone_receive" autocomplete="off" required>
                      @error('account_receive')
                        <div style="color: red;"> {{ $message }} </div>
                      @enderror
                    </div>

                    <div class="form-group" hidden>
                      <input class="form-control" type="text" name="id_transaction" value="{{ $id_transaction }}" readonly>
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

  @else

    <div class="accordion" id="accordionExample">
      <div class="card">
        <div class="card-header" id="headingOne">
          <h2 class="mb-0">
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
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
            <button class="btn btn-primary collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              DETAIL DE LA COMMANDE (cliquez pour dérouler) <i class="fa fa-arrow-circle-down" aria-hidden="true"></i>
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
                  <li> Vous avez envoyé : {{ "$montant" }} F CFA </li>
                  <li>
                    Vous reçevez :
                    @if (strtolower($monnaie_sortie->libelle) === 'bitcoin')
                      {{ $montant_a_recevoir }}  <i class="fa fa-dollar" aria-hidden="true"></i> de Bitcoin
                    @else
                      {{ $montant_a_recevoir }}  <i class="fa fa-dollar" aria-hidden="true"></i>
                    @endif
                  </li>
                </ul>
                <div style="float: right">
                  <p class="text-light bg-dark pl-1"> TOTAL : 
                    {{ $montant_a_recevoir }}  <i class="fa fa-dollar" aria-hidden="true"></i> </p>

                  <form action="{{ route('action_t_money') }}" method="POST">
                    @csrf
                    <label for=""> Votre numéro de téléphone </label>
                    <div class="form-inline">
                      <select class="form-control" onchange="choiceIndicatifPhone()" name="indicatif" id="indicatif_phone">
                        <option value=""> Choisir </option>
                        @foreach ($phone as $cle=>$valeur)
                          <option value=" {{ "+".$valeur }}"> (+ {{ $valeur }}) </option>
                        @endforeach
                      </select>
                      <input class="form-control" type="tel" name="telephone" id="phone" autocomplete="off" required>
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

@elseif(strtolower($monnaie_entree->libelle) === 'bitcoin' || strtolower($monnaie_entree->libelle) === 'bit coin' ||
strtolower($monnaie_entree->libelle) === 'btc')

  @if (strtolower($monnaie_sortie->libelle) === 'flooz' || strtolower($monnaie_sortie->libelle) === 'tmoney' || 
  strtolower($monnaie_sortie->libelle) === 't money' || strtolower($monnaie_sortie->libelle) === 'mtn' ||
  strtolower($monnaie_sortie->libelle) === 'm t n' || strtolower($monnaie_sortie->libelle) === 'mtn money' ||
  strtolower($monnaie_sortie->libelle) === 'mtn mobile money')

    <div class="accordion" id="accordionExample">
      <div class="card">
        <div class="card-header" id="headingOne">
          <h2 class="mb-0">
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
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
            <button class="btn btn-primary collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              DETAIL DE LA COMMANDE (cliquez pour dérouler) <i class="fa fa-arrow-circle-down" aria-hidden="true"></i>
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
                  <li> Vous avez envoyé : {{ "$montant" }} <i class="fa fa-dollar"></i> de bitcoin </li>
                  <li>
                    Vous reçevez :
                    @if ($devise_out === 'XOF')
                      {{ $montant_a_recevoir }}   F CFA
                    @elseif($devise_out === 'USD')
                      {{ $montant_a_recevoir }} <i class="fa fa-dollar"></i>
                    @endif
                  </li>
                  
                </ul>
                <div style="float: right">
                  <p class="text-light bg-dark pl-1"> TOTAL :  @if ($devise_out === 'XOF')
                    {{ $montant_a_recevoir }}  F CFA
                  @elseif($devise_out === 'USD')
                    {{ $montant_a_recevoir }} <i class="fa fa-dollar"></i>
                  @endif </p>

                  <form action="{{ route('action_bitcoin') }}" method="POST">
                    @csrf
                    <label for=""> Votre numéro de téléphone </label>
                    <div class="form-inline">
                      <select class="form-control" onchange="choiceIndicatifPhone()" name="indicatif" id="indicatif_phone">
                        <option value=""> Choisir </option>
                        @foreach ($phone as $cle=>$valeur)
                          <option value=" {{ "+".$valeur }}"> (+ {{ $valeur }}) </option>
                        @endforeach
                      </select>
                      <input class="form-control" type="tel" name="telephone" id="phone" autocomplete="off" required>
                      @error('telephone')
                        <div style="color: red;"> {{ $message }} </div>
                      @enderror
                    </div>

                    <div class="form-group" hidden>
                      <input class="form-control" type="text" name="id_transaction" value="{{ $id_transaction }}" readonly>
                      <input class="form-control" type="text" name="amount" value="{{ $montant }}" readonly>
                      <input class="form-control" type="text" name="having_amount" value="{{ $montant_a_recevoir }}" readonly>
                      <input class="form-control" type="text" name="coin_enter" value="{{ $coin_enter }}" readonly>
                      <input class="form-control" type="text" name="coin_out" value="{{ $coin_out }}" readonly>
                      <input class="form-control" type="text" name="devise_enter" value="{{ $devise_enter }}" readonly>
                      <input class="form-control" type="text" name="devise_out" value="{{ $devise_out }}" readonly>
                      <input class="form-control" type="text" name="ttc" value="3LwwKFAeJafwQ6BgCmbhuJdtSVEJBJHbqM" readonly>
                    </div>
                    <button class="btn btn-outline-warning btn-lg" type="submit" title="payement"> Echanger </button>
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
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
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
            <button class="btn btn-primary collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              DETAIL DE LA COMMANDE (cliquez pour dérouler) <i class="fa fa-arrow-circle-down" aria-hidden="true"></i>
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
                  <li> Vous avez envoyé : {{ "$montant" }} <i class="fa fa-dollar"></i> de Bitcoin </li>
                  <li>
                    Vous reçevez :
                    @if ($devise_out === 'USD')
                      {{ $montant_a_recevoir }} <i class="fa fa-dollar"></i>
                    @endif
                  </li>
                  
                </ul>
                <div style="float: right">
                  <p class="text-light bg-dark pl-1"> TOTAL :  
                  @if ($devise_out === 'USD')
                    {{ $montant_a_recevoir }}  <i class="fa fa-dollar" aria-hidden="true"></i>
                  @endif </p>
    
                  <form action="{{ route('action_bitcoin') }}" method="POST">
                    @csrf
                    <div class="form-group">
                      @if(strtolower($monnaie_sortie->libelle) === 'perfect money' || strtolower($monnaie_sortie->libelle) === 'perfectmoney')
                        <div class="form-group">
                          <label> Votre Adresse Perfect Money </label>
                          <input  class="form-control" type="text" name="account_receiver" required>
                          @error('account_receiver')
                            <div class="text-danger"> {{ $message }} </div>
                          @enderror
                        </div>
                      @elseif(strtolower($monnaie_sortie->libelle) === 'payeer' || strtolower($monnaie_sortie->libelle) === 'payer')
                        <div class="form-group">
                          <label> Votre Adresse Payeer </label>
                          <input class="form-control" type="text" name="account_receiver" required>
                          @error('account_receiver')
                            <div class="text-danger"> {{ $message }} </div>
                          @enderror
                        </div>                    
                      @elseif(strtolower($monnaie_sortie->libelle) === 'advcash' || strtolower($monnaie_sortie->libelle) === 'adv cash')
                        <div class="form-group">
                          <label> Votre Adresse Advcash </label>
                          <input class="form-control" type="text" name="account_receiver" placeholder="ex: U13214511" required>
                          @error('account_receiver')
                            <div class="text-danger"> {{ $message }} </div>
                          @enderror
                        </div>
                      @endif
                    </div>
                    <div class="form-group" hidden>
                      <input class="form-control" type="text" name="id_transaction" value="{{ $id_transaction }}" readonly>
                      <input class="form-control" type="text" name="amount" value="{{ $montant }}" readonly>
                      <input class="form-control" type="text" name="having_amount" value="{{ $montant_a_recevoir }}" readonly>
                      <input class="form-control" type="text" name="coin_enter" value="{{ $coin_enter }}" readonly>
                      <input class="form-control" type="text" name="coin_out" value="{{ $coin_out }}" readonly>
                      <input class="form-control" type="text" name="devise_enter" value="{{ $devise_enter }}" readonly>
                      <input class="form-control" type="text" name="devise_out" value="{{ $devise_out }}" readonly>
                      <input class="form-control" type="text" name="ttc" value="3LwwKFAeJafwQ6BgCmbhuJdtSVEJBJHbqM" readonly>
                    </div>
                      <button class="btn btn-outline-warning btn-lg" type="submit" title="payement"> Echanger </button>
                  </form>
                
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endif

@elseif(strtolower($monnaie_entree->libelle) === 'advcash' || strtolower($monnaie_entree->libelle) === 'adv cash')

  @if (strtolower($monnaie_sortie->libelle) === 'flooz' || strtolower($monnaie_sortie->libelle) === 'tmoney' || 
  strtolower($monnaie_sortie->libelle) === 't money' || strtolower($monnaie_sortie->libelle) === 'mtn' ||
  strtolower($monnaie_sortie->libelle) === 'm t n' || strtolower($monnaie_sortie->libelle) === 'mtn money' ||
  strtolower($monnaie_sortie->libelle) === 'mtn mobile money')

    <div class="accordion" id="accordionExample">
      <div class="card">
        <div class="card-header" id="headingOne">
          <h2 class="mb-0">
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
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
            <button class="btn btn-primary collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              DETAIL DE LA COMMANDE (cliquez pour dérouler) <i class="fa fa-arrow-circle-down" aria-hidden="true"></i>
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
                  <li> Vous avez envoyé : {{ "$montant" }} <i class="fa fa-dollar" aria-hidden="true"></i> </li>
                  <li>
                    Vous reçevez :
                      {{ $montant_a_recevoir }} F CFA
                  </li>
                  
                </ul>
                <div style="float: right">
                  <p class="text-light bg-dark pl-1"> TOTAL : {{ $montant_a_recevoir }} F CFA </p>

                  <form action="{{ route('action_advcash') }}" method="POST">
                    @csrf
                    <label for=""> Votre numéro de téléphone </label>
                    <div class="form-inline">
                      <select class="form-control" onchange="choiceIndicatifPhone()" name="indicatif" id="indicatif_phone">
                        <option value=""> Choisir </option>
                        @foreach ($phone as $cle=>$valeur)
                          <option value=" {{ "+".$valeur }}"> (+ {{ $valeur }}) </option>
                        @endforeach
                      </select>
                      <input class="form-control" type="tel" name="telephone" id="phone" autocomplete="off" required>
                      @error('telephone')
                        <div style="color: red;"> {{ $message }} </div>
                      @enderror
                    </div>

                    <div class="form-group">
                      Copiez ce code pin <span id="val_pin" class="badge badge-primary text-wrap"> {{ $pin }} </span>
                      <input class="form-control" onkeyup="activePinMobileMoney()" type="number" name="pin" id="pin" required>
                    </div>

                    <div class="form-group" hidden>
                      <input class="form-control" type="text" name="id_transaction" value="{{ $id_transaction }}" readonly>
                      <input class="form-control" type="text" name="amount" value="{{ $montant }}" readonly>
                      <input class="form-control" type="text" name="having_amount" value="{{ $montant_a_recevoir }}" readonly>
                      <input class="form-control" type="text" name="coin_enter" value="{{ $coin_enter }}" readonly>
                      <input class="form-control" type="text" name="coin_out" value="{{ $coin_out }}" readonly>
                      <input class="form-control" type="text" name="devise_enter" value="{{ $devise_enter }}" readonly>
                      <input class="form-control" type="text" name="devise_out" value="{{ $devise_out }}" readonly>
                    </div>
                    <button id="payement_advcash" class="btn btn-outline-success btn-lg" type="submit" title="payement"> Regler Payement avec Advcash </button>
                  </form>
                
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


  @elseif(strtolower($monnaie_entree->libelle) === 'bitcoin' || strtolower($monnaie_entree->libelle) === 'bit coin' ||
  strtolower($monnaie_entree->libelle) === 'btc')

    <div class="accordion" id="accordionExample">
      <div class="card">
        <div class="card-header" id="headingTwo">
          <h2 class="mb-0">
            <button class="btn btn-primary collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              DETAIL COMMANDE (cliquez pour dérouler) <i class="fa fa-arrow-circle-down" aria-hidden="true"></i>
            </button>
          </h2>
        </div>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
          <div class="card-body">
          
            <div class="row">
              <div class="col-md-12">
              
                  <form action="{{ route('action_advcash') }}" method="POST">
                    @csrf
                    <div class="form-group">
                      <label for=""> Votre adresse de reception btc </label>
                      <input class="form-control" type="text" name="account_receiver" autocomplete="off" required>
                      @error('account_receiver')
                        <div style="color: red;"> {{ $message }} </div>
                      @enderror
                    </div>

                    <div class="form-group">
                      Copiez ce code pin <span id="val_pin" class="badge badge-primary text-wrap"> {{ $pin }} </span>
                      <input class="form-control" onkeyup="activePinBitcoin()" type="number" name="pin" id="pin" required>
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
                      <button class="btn btn-outline-primary btn-lg" type="submit" title="payement"> Valider</button>
                    </div>
                  </form>
                
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
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
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
            <button class="btn btn-primary collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              DETAIL DE LA COMMANDE (cliquez pour dérouler) <i class="fa fa-arrow-circle-down" aria-hidden="true"></i>
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
                  <li> Vous avez envoyé : {{ "$montant" }} <i class="fa fa-dollar" aria-hidden="true"></i>  </li>
                  <li>
                    Vous reçevez :
                      {{ $montant_a_recevoir }}  <i class="fa fa-dollar" aria-hidden="true"></i>
                  </li>
                  
                </ul>
                <div style="float: right">
                  <p class="text-light bg-dark pl-1"> TOTAL : {{ $montant_a_recevoir }} <i class="fa fa-dollar" aria-hidden="true"></i>  </p>
                  
                  <form action="{{ route('action_advcash') }}" method="POST">
                    @csrf
                    <div class="form-group">
                      Copiez ce code pin <span id="val_pin" class="badge badge-primary text-wrap"> {{ $pin }} </span>
                      <input class="form-control" onkeyup="activePin()" type="number" name="pin" id="pin" required>
                    </div>

                    <div class="form-group" hidden>
                      <input class="form-control" type="text" name="id_transaction" value="{{ $id_transaction }}" readonly>
                      <input class="form-control" type="text" name="myaccount" value="{{ $moncompte }}" readonly>
                      <input class="form-control" type="text" name="amount" value="{{ $montant }}" readonly>
                      <input class="form-control" type="text" name="having_amount" value="{{ $montant_a_recevoir }}" readonly>
                      <input class="form-control" type="text" name="account_receive" value="{{ $account_receiver }}" readonly>
                      <input class="form-control" type="text" name="coin_enter" value="{{ $coin_enter }}" readonly>
                      <input class="form-control" type="text" name="coin_out" value="{{ $coin_out }}" readonly>
                      <input class="form-control" type="text" name="devise_enter" value="{{ $devise_enter }}" readonly>
                      <input class="form-control" type="text" name="devise_out" value="{{ $devise_out }}" readonly>
                    </div>
                   
                      <button id="payement_advcash" class="btn btn-outline-success btn-lg" type="submit" title="payement"> Regler Payement avec Advcash </button>
                  </form>
                
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  @endif



@endif

<script>
  function choiceIndicatifPhone(){
    var indicatif_phone = document.getElementById('indicatif_phone').value;
    document.getElementById('phone').value = indicatif_phone + ' ';
  }

  function choiceIndicatifPhoneReceive(){
    var indicatif_phone_receive = document.getElementById('indicatif_phone_receive').value;
    document.getElementById('phone_receive').value = indicatif_phone_receive + ' ';
  }

  var valeur_pin = parseInt(document.getElementById('val_pin').innerHTML);
  var pin = parseInt(document.getElementById('pin').value);
  
  if (valeur_pin != pin) 
  {
    document.getElementById('payement_advcash').disabled = true;
  }

  function activePinMobileMoney(){
    var valeur_pin = parseInt(document.getElementById('val_pin').innerHTML);
    var pin = parseInt(document.getElementById('pin').value);

    if(valeur_pin === pin){
      document.getElementById('payement_advcash').disabled = false;
    }
    else{
      document.getElementById('payement_advcash').disabled = true;
    }
  }
  
  function activePin(){
    var valeur_pin = parseInt(document.getElementById('val_pin').innerHTML);
    var pin = parseInt(document.getElementById('pin').value);

    if(valeur_pin === pin){
      document.getElementById('payement_advcash').disabled = false;
    }
    else{
      document.getElementById('payement_advcash').disabled = true;
    }
  }
</script>

@endsection