@extends('layout.client.index')
@section('content')
@section('title','Accueil')
<style>
  .traitVertical{
    border-left: 4px solid #000;
    display: inline-block;
    height: 100%;
    margin-left:  30%;
  }
</style>

<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-3 col-md-6">
            <div class="d-flex">
              <div class="wrapper">
                <h3 class="mb-0 font-weight-semibold">32,451</h3>
                <h5 class="mb-0 font-weight-medium text-primary">Visits</h5>
                <p class="mb-0 text-muted">+14.00(+0.50%)</p>
              </div>
              <div class="wrapper my-auto ml-auto ml-lg-4">
                <canvas height="50" width="100" id="stats-line-graph-1"></canvas>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 mt-md-0 mt-4">
            <div class="d-flex">
              <div class="wrapper">
                <h3 class="mb-0 font-weight-semibold">15,236</h3>
                <h5 class="mb-0 font-weight-medium text-primary">Impressions</h5>
                <p class="mb-0 text-muted">+138.97(+0.54%)</p>
              </div>
              <div class="wrapper my-auto ml-auto ml-lg-4">
                <canvas height="50" width="100" id="stats-line-graph-2"></canvas>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 mt-md-0 mt-4">
            <div class="d-flex">
              <div class="wrapper">
                <h3 class="mb-0 font-weight-semibold">7,688</h3>
                <h5 class="mb-0 font-weight-medium text-primary">Conversation</h5>
                <p class="mb-0 text-muted">+57.62(+0.76%)</p>
              </div>
              <div class="wrapper my-auto ml-auto ml-lg-4">
                <canvas height="50" width="100" id="stats-line-graph-3"></canvas>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 mt-md-0 mt-4">
            <div class="d-flex">
              <div class="wrapper">
                <h3 class="mb-0 font-weight-semibold">1,553</h3>
                <h5 class="mb-0 font-weight-medium text-primary">Downloads</h5>
                <p class="mb-0 text-muted">+138.97(+0.54%)</p>
              </div>
              <div class="wrapper my-auto ml-auto ml-lg-4">
                <canvas height="50" width="100" id="stats-line-graph-4"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@php
  $dollar_franc = \App\Models\Rate::where('monnaie_send','USD')->where('monnaie_receive','XOF')->first();
  $franc_dollar = \App\Models\Rate::where('monnaie_send','XOF')->where('monnaie_receive','USD')->first();
@endphp


  <div class="row">

    <div class="col-md-4">
      <div class="card-body">
        <h4 class="card-title"> CE QUE J'ENVOIE  : <h3 style="color:blue" id="ce_que_jenvoie"> </h3> </h4>
        @foreach ($categorie as $categories)
          <p class="card-description">{{ $categories->libelle_type }}</p>
          <div class="template-demo">
            @foreach ($monnaie as $monnaies)
              @if ($monnaies->type_id === $categories->id)
                <button id="{{ $monnaies->id }}" value="{{ $monnaies->libelle }}" name="coin_enter" type="button" onclick="choiceMoney(this)" class="btn btn-primary btn-fw">
                  <img src="{{ asset('Zone') }}/{{ $monnaies->image }}" height="20px;" width="20px;" style="border-radius: 10px;" alt="{{ $monnaies->libelle }}"> 
                   {{ $monnaies->libelle }}
                </button>
              @endif
            @endforeach
          </div>
          <br>
        @endforeach
      </div>
    </div>

    <div class="col-md-4">
      <span class="traitVertical"></span>
    </div>

    <div class="col-md-4">
      <div class="card-body">
        <h4 class="card-title"> CE QUE JE RECOIS  : <h3 style="color:blue" id="ce_que_je_recois"> </h3> </h4>
        @foreach ($categorie as $categories)
          <p class="card-description">{{ $categories->libelle_type }}</p>
          <div class="template-demo">
            @foreach ($monnaie as $monnaies)
              @if ($monnaies->type_id === $categories->id)
                <button id="{{ $monnaies->id }}" value="{{ $monnaies->libelle }}" name="coin_out" type="button" onclick="choiceMoney(this)" class="btn btn-primary btn-fw">
                  <img src="{{ asset('Zone') }}/{{ $monnaies->image }}" height="20px;" width="20px;" style="border-radius: 10px;" alt="{{ $monnaies->libelle }}"> 
                  {{ $monnaies->libelle }} 
                </button>
              @endif
            @endforeach
          </div>
          <br>
        @endforeach
      </div>
    </div>

  </div>

  <h2 class="text-center" id="etat">  </h2> 
  <div class="row">
    <div class="col-md-12">
      <form class="forms-sample" id="sendPerfectMoney" action="{{ route('action_waiting_perfect_money') }}" method="POST" style="display: none">
        @csrf
        <div class="form-group" hidden>
          <input id="input_enter_pm" class="form-control" type="text" name="coin_enter_pm" placeholder="Entrer" required>
          <input id="input_out_pm" class="form-control" type="text" name="coin_out_pm" placeholder="Sortie" required>
        </div>

        <div class="form-group">
          <label for=""> Votre Compte Perfect Money </label>
          <input type="text" class="form-control" name="myaccount" id="myaccount" autocomplete="off" required>
          @error('myaccount')
            <div style="color: red;"> {{ $message }} </div>
          @enderror
        </div>
    
        <div class="form-group">
          <label for=""> Montant à transferer </label>
          <input type="number" min="1" class="form-control" onkeyup="amountPerfectMoney()" name="amount" id="amount_pm" autocomplete="off" required>
          @error('amount')
            <div style="color: red;"> {{ $message }} </div>
          @enderror
        </div>

        <input hidden type="text" name="rate" class="form-control" id="dollar_franc" value="{{ $dollar_franc->valeur }}" readonly>
    
        <div class="form-group" id="div_perfect_money" style="display: block;">
          <label id="label_perfect_money" for=""> Compte Récepteur </label>
          <input type="text" class="form-control" name="accountreceiver" id="account_receive_pm" value="0" autocomplete="off" required>
          @error('accountreceiver')
            <div style="color: red;"> {{ $message }} </div>
          @enderror
        </div>

        <div class="form-group">
          <input hidden type="text" class="form-control" name="devise_enter_pm" id="devise_enter_pm" value="USD" readonly>
          <input hidden type="text" class="form-control" name="devise_out_pm" id="devise_out_pm" readonly>
        </div>

        <div class="form-group" hidden>
          <input type="text" class="form-control" name="id_transaction" value="{{ $id_transaction }}" autocomplete="off" readonly>
          @error('id_transaction')
            <div style="color: red;"> {{ $message }} </div>
          @enderror
        </div>

        <div class="form-group">
          <label for=""> Montant à reçevoir </label>
          <input type="number" class="form-control" name="having_amount" id="montant_total_pm" readonly>
          @error('having_amount')
            <div style="color: red;"> {{ $message }} </div>
          @enderror
        </div>

        <button id="operation_pm" type="submit" class="btn btn-primary btn-block mr-2"> Valider </button>
      </form>


      <form class="forms-sample" action="{{ route('action_waiting_payeer') }}" method="POST" id="sendPayeer" style="display: none">
        @csrf
        <div class="form-group" hidden>
          <input id="input_enter_payeer" class="form-control" type="text" name="coin_enter_payeer" required>
          <input id="input_out_payeer" class="form-control" type="text" name="coin_out_payeer" required>
        </div>

        <span class="badge badge-primary text-wrap">
          Veuillez effectuer un dépot sur le compte ci-dessous :
        </span> <br>
        <label for=""> Adresse Payeer</label>
        <div class="form-inline">
          <input type="text" class="form-control" name="myaccount" size="40" id="copyMe" value="P1040648631" readonly>
        <button class="bg-blue-500 hover:bg-blue-700 text-dark font-bold py-2 px-4 border border-blue-700 rounded" onclick="copyMeOnClipboard()">
          Copier
        </button>
          @error('myaccount')
            <div style="color: red;"> {{ $message }} </div>
          @enderror
        </div>

        <div class="form-group">
          <label for=""> Saisir le montant </label>
          <input type="number" min="2" class="form-control" name="amount" onkeyup="amountPayeer()" id="amount_payeer" value="{{ old('montant') }}" required>
          @error('montant')
            <div style="color: red;"> {{ $message }} </div>
          @enderror
          <span class="text-danger"> Montant minimal : 2$ </span>
        </div>

        <div class="form-group" hidden>
          <input type="text" class="form-control" name="devise_enter_payeer" value="USD" readonly>
          <input type="text" class="form-control" name="devise_out" id="devise_out_payeer" readonly>
        </div>

        <input hidden type="text" name="rate" class="form-control" id="dollar_franc" value="{{ $dollar_franc->valeur }}" readonly>

        <div class="form-group" id="div_payeer" style="display: block;">
          <label id="label_payeer" for=""> Compte Récepteur </label>
          <input type="text" class="form-control" name="account_receiver" id="account_receive_pm" value="0" autocomplete="off" required>
          @error('accountreceiver')
            <div style="color: red;"> {{ $message }} </div>
          @enderror
        </div>

        <div class="form-group">
          <label for=""> Id de la transaction </label>
          <input type="number" class="form-control" name="id_transaction" autocomplete="off" required>
          @error('id_transaction')
            <div style="color: red;"> {{ $message }} </div>
          @enderror
        </div>

        <div class="form-group">
          <label for=""> Montant à reçevoir </label>
          <input type="number" class="form-control" name="having_amount" id="montant_total_payeer" readonly>
          @error('having_amount')
            <div style="color: red;"> {{ $message }} </div>
          @enderror
        </div>

        <button id="operation_payeer" type="submit" class="btn btn-success btn-block mr-2"> Opérer </button>
      </form>


      <form class="forms-sample" action="{{ route('action_waiting_mtn') }}" method="POST" id="sendMtn" style="display: none">
        @csrf
        <div class="form-group" hidden>
          <input id="input_enter_mtn" class="form-control" type="text" name="coin_enter_mtn" required>
          <input id="input_out_mtn" class="form-control" type="text" name="coin_out_mtn" required>
        </div>

        <div class="form-group">
          <label for=""> Saisir le montant </label>
          <input type="number" min="500" class="form-control" onkeyup="amountMtn()" name="amount" id="amount_mtn" value="{{ old('montant') }}" required>
          @error('montant')
            <div style="color: red;"> {{ $message }} </div>
          @enderror
        </div>

        <div class="form-group">
          <input hidden type="text" class="form-control" name="devise_enter_mtn" value="XOF" readonly>
          <input hidden type="text" class="form-control" name="devise_out" id="devise_out_mtn" readonly>
        </div>

        <input hidden type="text" name="rate" class="form-control" id="franc_dollar" value="{{ $franc_dollar->valeur }}" readonly>


        <div class="form-group" id="div_mtn" style="display: block;">
          <label for=""> Adresse receptrice </label>
          <input type="text" class="form-control" name="account_receiver" value="0" id="account_receive" placeholder="ex: P6872131 ou U4514252" autocomplete="off" required>
          @error('account_receiver')
            <div style="color: red;"> {{ $message }} </div>
          @enderror
        </div>

        <div class="form-group" hidden>
          <input type="text" class="form-control" name="id_transaction" value="{{ $id_transaction }}" autocomplete="off" readonly>
          @error('id_transaction')
            <div style="color: red;"> {{ $message }} </div>
          @enderror
        </div>

        <div class="form-group">
          <label for=""> Montant à reçevoir </label>
          <input type="number" class="form-control" name="having_amount" id="montant_total_mtn" readonly>
          @error('having_amount')
            <div style="color: red;"> {{ $message }} </div>
          @enderror
        </div>

        <button id="operation_mtn" type="submit" class="btn btn-success btn-block mr-2"> Opérer </button>
      </form>


      <form class="forms-sample" action="{{ route('action_waiting_flooz') }}" method="POST" id="sendFlooz" style="display: none">
        @csrf
        <div class="form-group" hidden>
          <input id="input_enter_flooz" class="form-control" type="text" name="coin_enter_flooz" required>
          <input id="input_out_flooz" class="form-control" type="text" name="coin_out_flooz" required>
        </div>

        <div class="form-group">
          <label for=""> Saisir le montant </label>
          <input type="number" min="500" class="form-control" onkeyup="amountFlooz()" name="amount" id="amount_flooz" value="{{ old('montant') }}" required>
          @error('montant')
            <div style="color: red;"> {{ $message }} </div>
          @enderror
        </div>

        <div class="form-group">
          <input hidden type="text" class="form-control" name="devise_enter_flooz"  value="XOF" readonly>
          <input hidden type="text" class="form-control" name="devise_out" id="devise_out_flooz" value="XOF" readonly>
        </div>

        <input hidden type="text" name="rate" class="form-control" id="franc_dollar" value="{{ $franc_dollar->valeur }}" readonly>

        <div class="form-group" id="div_flooz" style="display: block;">
          <label id="label_flooz" for=""> Adresse receptrice </label>
          <input type="text" class="form-control" name="account_receiver" value="0" id="account_receive" autocomplete="off" required>
          @error('account_receiver')
            <div style="color: red;"> {{ $message }} </div>
          @enderror
        </div>

        <div class="form-group" hidden>
          <input type="text" class="form-control" name="id_transaction" value="{{ $id_transaction }}" autocomplete="off" readonly>
          @error('id_transaction')
            <div style="color: red;"> {{ $message }} </div>
          @enderror
        </div>

        <div class="form-group">
          <label for=""> Montant à reçevoir </label>
          <input type="number" class="form-control" name="having_amount" id="montant_total_flooz" readonly>
          @error('having_amount')
            <div style="color: red;"> {{ $message }} </div>
          @enderror
        </div>

        <button id="operation_flooz" type="submit" class="btn btn-success btn-block mr-2"> Opérer </button>
      </form>


      <form class="forms-sample" action="{{ route('action_waiting_t_money') }}" method="POST" id="sendTMoney" style="display: none">
        @csrf
        <div class="form-group" hidden>
          <input id="input_enter_tm" class="form-control" type="text" name="coin_enter_tm" required>
          <input id="input_out_tm" class="form-control" type="text" name="coin_out_tm" required>
        </div>

        <div class="form-group">
          <label for=""> Saisir le montant </label>
          <input type="number" min="500" class="form-control" onkeyup="amountTMoney()" name="amount" id="amount_tm" value="{{ old('montant') }}" required>
          @error('montant')
            <div style="color: red;"> {{ $message }} </div>
          @enderror
        </div>

        <div class="form-group">
          <input hidden type="text" class="form-control" name="devise_enter_tm" value="XOF" readonly>
          <input hidden type="text" class="form-control" name="devise_out" id="devise_out_tm" readonly>
        </div>

        <input hidden type="text" name="rate" class="form-control" id="franc_dollar" value="{{ $franc_dollar->valeur }}" readonly>

        <div class="form-group" id="div_t_money" style="display: block;">
          <label id="label_t_money" for=""> Adresse receptrice </label>
          <input type="text" class="form-control" name="account_receiver" value="0" id="account_receive" autocomplete="off" required>
          @error('account_receiver')
            <div style="color: red;"> {{ $message }} </div>
          @enderror
        </div>

        <div class="form-group" hidden>
          <input type="text" class="form-control" name="id_transaction" value="{{ $id_transaction }}" autocomplete="off" readonly>
          @error('id_transaction')
            <div style="color: red;"> {{ $message }} </div>
          @enderror
        </div>

        <div class="form-group">
          <label for=""> Montant à reçevoir </label>
          <input type="number" class="form-control" name="having_amount" id="montant_total_tm" readonly>
          @error('having_amount')
            <div style="color: red;"> {{ $message }} </div>
          @enderror
        </div>

        <button id="operation_tm" type="submit" class="btn btn-success btn-block mr-2"> Opérer </button>
      </form>
      

      <form class="forms-sample" action="{{ route('action_waiting_bitcoin') }}" method="POST" id="sendBitcoin" style="display: none">
        @csrf
        <div class="form-group" hidden>
          <input id="input_enter_btc" class="form-control" type="text" name="coin_enter_btc" required>
          <input id="input_out_btc" class="form-control" type="text" name="coin_out_btc" required>
        </div>

        <div class="form-group">
          <label for=""> Saisir le montant ( en dollar ) </label>
          <input type="number" step="any" class="form-control" name="amount" onkeyup="amountBitcoin()" id="amount_btc" value="{{ old('montant') }}" required>
          @error('montant')
            <div style="color: red;"> {{ $message }} </div>
          @enderror
        </div>

        <input hidden type="text" name="rate" class="form-control" id="franc_dollar" value="{{ $dollar_franc->valeur }}" readonly>

        <div class="form-group">
          <input hidden type="text" class="form-control" name="devise_enter_btc" id="devise_enter_btc" value="USD" readonly>
        </div>

        <div class="form-group">
          <label for=""> E mail </label>
          <input type="email" class="form-control" name="email" autocomplete="off" required>
          @error('email')
            <div style="color: red;"> {{ $message }} </div>
          @enderror
        </div>

        <div class="form-group" hidden>
          <label for=""> Devise sortante </label>
          <input type="text" class="form-control" name="devise_out" id="devise_out_btc" readonly>
        </div>

        <div class="form-group">
          <label for=""> Montant à reçevoir </label>
          <input type="number" class="form-control" name="having_amount" id="montant_total_btc" readonly>
          @error('having_amount')
            <div style="color: red;"> {{ $message }} </div>
          @enderror
        </div>

        <button id="operation_btc" class="btn btn-success btn-block mr-2"> Opérer </button>
      </form>

      <form class="forms-sample" action="{{ route('action_waiting_advcash') }}" method="POST" id="sendAdvcash" style="display: none">
        @csrf
        <div class="form-group" hidden>
          <input id="input_enter_advcash" class="form-control" type="text" name="coin_enter_advcash" required>
          <input id="input_out_advcash" class="form-control" type="text" name="coin_out_advcash" required>
        </div>

  
        <span class="badge badge-primary text-wrap">
          Veuillez effectuer un dépot sur le compte ci-dessous :
        </span> <br>
        <label for=""> Votre compte Advcash </label>
        <div class="form-group">
          <input type="text" class="form-control" value="U033816068648" size="40" id="copyMe" name="myaccount" readonly>
          @error('myaccount')
            <div style="color: red;"> {{ $message }} </div>
          @enderror
        </div>

        <div class="form-group">
          <label for=""> Saisir le montant </label>
          <input type="number" min="2" class="form-control" name="amount" onkeyup="amountAdvcash()" id="amount_advcash" value="{{ old('montant') }}" required>
          @error('montant')
            <div style="color: red;"> {{ $message }} </div>
          @enderror
          <span class="text-danger"> Montant minimal : 2$ </span>
        </div>

        <div class="form-group" hidden>
          <input type="text" class="form-control" name="devise_enter_advcash" value="USD" readonly>
          <input type="text" class="form-control" name="devise_out" id="devise_out_advcash" readonly>
        </div>

        <div class="form-group" id="div_advcash" style="display: block;">
          <label id="label_advcash" for=""> Compte Récepteur </label>
          <input type="text" class="form-control" name="account_receiver" id="account_receive_advcash" value="0" autocomplete="off" required>
          @error('accountreceiver')
            <div style="color: red;"> {{ $message }} </div>
          @enderror
        </div>

        <div class="form-group">
          <label for=""> Montant à reçevoir </label>
          <input type="number" class="form-control" name="having_amount" id="montant_total_advcash" readonly>
          @error('having_amount')
            <div style="color: red;"> {{ $message }} </div>
          @enderror
        </div>

        <button id="operation_advcash" type="submit" class="btn btn-success btn-block mr-2"> Opérer </button>
      </form>


    </div>
  </div>


<script>

    const copyText = document.querySelector("#copyMe")
    const showText = document.querySelector("p")

    const copyMeOnClipboard = () => {
      copyText.select()
      copyText.setSelectionRange(0, 99999) // used for mobile phone
      document.execCommand("copy")
      showText.innerHTML = `${copyText.value} is copied`
      setTimeout(() => {
        showText.innerHTML = ""
      }, 1000)
    }


    function amountPerfectMoney(){
    var devise_sortie_pm = document.getElementById('devise_out_pm').value;
    var taux = document.getElementById('dollar_franc').value;
    var amount_pm = document.getElementById('amount_pm').value;
    var mt_receive_pm = document.getElementById('montant_total_pm').value;
    
    if (devise_sortie_pm === 'USD') {
      document.getElementById('montant_total_pm').value = amount_pm;
    }
    else if(devise_sortie_pm === 'XOF'){
      document.getElementById('montant_total_pm').value = amount_pm*taux;
    }
  }

  function amountPayeer(){
    var taux = document.getElementById('dollar_franc').value;
    var devise_sortie_payeer = document.getElementById('devise_out_payeer').value;
    if (devise_sortie_payeer === 'USD') {
      var amount_payeer = document.getElementById('amount_payeer').value;
      var mt =  amount_payeer;
      document.getElementById('montant_total_payeer').value = mt;
    }else if(devise_sortie_payeer === 'XOF'){
      var amount_payeer = document.getElementById('amount_payeer').value;
      var mt = amount_payeer*taux;
      document.getElementById('montant_total_payeer').value = mt;
    }
  }

  function amountMtn(){
    var devise_sortie_mtn = document.getElementById('devise_out_mtn').value;
    var amount_mtn = document.getElementById('amount_mtn').value;
    var taux = document.getElementById('franc_dollar').value;
    
    if (devise_sortie_mtn == 'USD'){
      var mt =  amount_mtn*taux;
      document.getElementById('montant_total_mtn').value = mt;
    }else if(devise_sortie_mtn == 'XOF'){
      var mt =  amount_mtn;
      document.getElementById('montant_total_mtn').value = mt;
    }
  }


  function amountFlooz(){
    var devise_sortie_flooz = document.getElementById('devise_out_flooz').value;
    var taux = document.getElementById('franc_dollar').value;
    var amount_pm = document.getElementById('amount_pm').value;
    var amount_flooz = document.getElementById('amount_flooz').value;
    var mt_receive_flooz  = document.getElementById('montant_total_flooz').value; 
    
    if (devise_sortie_flooz == 'USD'){
      var mt =  amount_flooz*taux ;
      document.getElementById('montant_total_flooz').value = mt;
    }else if(devise_sortie_flooz == 'XOF'){
      var mt =  amount_flooz;
      document.getElementById('montant_total_flooz').value = mt;
    }
  }

  function amountTMoney(){
    devise_sortie_tm = document.getElementById('devise_out_tm').value;
    var amount_tm = document.getElementById('amount_tm').value;
    var taux = document.getElementById('franc_dollar').value;
    if (devise_sortie_tm == 'USD'){
      var mt =  amount_tm*taux;
      document.getElementById('montant_total_tm').value = mt;
    }else if(devise_sortie_tm == 'XOF'){
      var mt =  amount_tm;
      document.getElementById('montant_total_tm').value = mt;
    }
  }
 
  function amountBitcoin(){
    var taux = document.getElementById('dollar_franc').value ;
    if (document.getElementById('devise_out_btc').value === 'XOF') {
      var amount_btc = document.getElementById('amount_btc').value;
      var mt =  amount_btc*taux;
      document.getElementById('montant_total_btc').value = mt;
    }else if(document.getElementById('devise_out_btc').value === 'USD'){
      var amount_btc = document.getElementById('amount_btc').value;
      var mt = amount_btc
      document.getElementById('montant_total_btc').value = mt;
    }
  }

  function amountAdvcash(){
    var taux = document.getElementById('dollar_franc').value ;
    if (document.getElementById('devise_out_advcash').value === 'USD') {
      var amount_advcash = document.getElementById('amount_advcash').value;
      var mt =  amount_advcash;
      document.getElementById('montant_total_advcash').value = mt;
    }else if(document.getElementById('devise_out_advcash').value === 'XOF'){
      var amount_advcash = document.getElementById('amount_advcash').value;
      var mt = amount_advcash*taux
      document.getElementById('montant_total_advcash').value = mt;
    }
  }

  
  function choiceMoney(element){
    //Afficher adresse receptrice ou numero de telephone 
    if (element.name === 'coin_out') {
      if (element.value.toLowerCase() === 'flooz' || element.value.toLowerCase() === 't money' ||
      element.value.toLowerCase() === 'tmoney' || element.value.toLowerCase() === 'mtn' ||
      element.value.toLowerCase() === 'mtn money' || element.value.toLowerCase() === 'mtn mobile money') 
      {
        document.getElementById('devise_out_pm').value = 'XOF';
        document.getElementById('devise_out_tm').value = 'XOF';
        document.getElementById('div_t_money').style.display='none';
        document.getElementById('div_perfect_money').style.display='none';
        document.getElementById('div_flooz').style.display='none';
        document.getElementById('div_mtn').style.display='none';
        document.getElementById('devise_out_flooz').value = 'XOF';
        document.getElementById('div_payeer').style.display='none';
        document.getElementById('devise_out_payeer').value = 'XOF';
        document.getElementById('devise_out_mtn').value = 'XOF';
        document.getElementById('devise_out_btc').value = 'XOF';
        document.getElementById('div_advcash').style.display='none';
        document.getElementById('devise_out_advcash').value = 'XOF';
      }
      else if(element.value.toLowerCase() === 'bitcoin' || element.value.toLowerCase() === 'bit coin')
      {
        document.getElementById('label_perfect_money').innerHTML = 'Votre adresse Bitcoin';
        document.getElementById('devise_out_pm').value = 'USD';
        document.getElementById('label_flooz').innerHTML = 'Votre adresse Bitcoin';
        document.getElementById('label_t_money').innerHTML = 'Votre adresse Bitcoin';
        document.getElementById('div_t_money').style.display='block';
        document.getElementById('devise_out_tm').value = 'USD';
        document.getElementById('div_perfect_money').style.display='block';
        document.getElementById('div_flooz').style.display='block';
        document.getElementById('devise_out_flooz').value = 'USD';
        document.getElementById('div_payeer').style.display='block';
        document.getElementById('label_payeer').innerHTML = 'Votre adresse Bitcoin';
        document.getElementById('devise_out_payeer').value = 'USD';
        document.getElementById('div_mtn').style.display='block';
        document.getElementById('devise_out_mtn').value = 'USD';
        document.getElementById('div_advcash').style.display='block';
        document.getElementById('label_advcash').innerHTML = 'Votre adresse Bitcoin';
        document.getElementById('devise_out_advcash').value = 'USD';
      }
      else
      {
        document.getElementById('label_perfect_money').innerHTML = 'Compte Récepteur';
        document.getElementById('devise_out_pm').value = 'USD';
        document.getElementById('label_flooz').innerHTML = 'Compte Récepteur';
        document.getElementById('label_t_money').innerHTML = 'Compte Récepteur';
        document.getElementById('div_t_money').style.display='block';
        document.getElementById('div_perfect_money').style.display='block';
        document.getElementById('div_flooz').style.display='block';
        document.getElementById('devise_out_flooz').value = 'USD';
        document.getElementById('div_payeer').style.display='block';
        document.getElementById('label_payeer').innerHTML = 'Compte Récepteur';
        document.getElementById('devise_out_payeer').value = 'USD';
        document.getElementById('devise_out_btc').value = 'USD';
        document.getElementById('devise_out_tm').value = 'USD';
        document.getElementById('div_mtn').style.display='block';
        document.getElementById('devise_out_mtn').value = 'USD';
        document.getElementById('div_advcash').style.display='block';
        document.getElementById('devise_out_advcash').value = 'USD';
        document.getElementById('label_advcash').innerHTML = 'Compte Récepteur';
      }
    }
    //Fin
    

    if (element.name == 'coin_enter') {
      //Recuperation du name du bouton
      var name_button_enter = element.name;

      //Recuperation de l'id du bouton
      var id_button_enter = element.id;

      //Recuperation de la valeur du bouton
      var value_button_enter = element.value;

      //J'attribue, la valeur du bouton cliqué, au h3 d'id = ce_que_jenvoie 
      document.getElementById('ce_que_jenvoie').innerHTML = value_button_enter;

      /* *** Formulaire Perfect Money *** */

      // Atribution de id_button_enter a la l'input coin_enter_pm 
      var input_enter_pm = document.getElementById('input_enter_pm').value;
      document.getElementById('input_enter_pm').value = id_button_enter;

      /* *** Fin  Formulaire Perfect Money *** */

      /* *** Formulaire Mtn *** */

      // Atribution de id_button_enter a la l'input coin_enter_mtn 
      var input_enter_mtn = document.getElementById('input_enter_mtn').value;
      document.getElementById('input_enter_mtn').value = id_button_enter;

      /* *** Formulaire Mtn *** */


      /* *** Formulaire Flooz *** */

      // Atribution de id_button_enter a la l'input coin_enter_flooz 
      var input_enter_flooz = document.getElementById('input_enter_flooz').value;
      document.getElementById('input_enter_flooz').value = id_button_enter;

      /* *** Formulaire Flooz *** */

      /* *** Formulaire TMoney *** */

      // Atribution de id_button_enter a la l'input coin_enter_t money 
      var input_enter_tm = document.getElementById('input_enter_tm').value;
      document.getElementById('input_enter_tm').value = id_button_enter;

      /* *** Formulaire TMoney *** */

      /* *** Formulaire Payeer *** */

      // Atribution de id_button_enter a la l'input coin_enter_payeer
      var input_enter_payeer = document.getElementById('input_enter_payeer').value;
      document.getElementById('input_enter_payeer').value = id_button_enter;

      /* *** Formulaire Payeer *** */


      /* *** Formulaire Bitcoin *** */

      // Atribution de id_button_enter a la l'input coin_enter_btc
      var input_enter_btc = document.getElementById('input_enter_btc').value;
      document.getElementById('input_enter_btc').value = id_button_enter;

      /* *** Formulaire Bitcoin *** */

      /* *** Formulaire Advcash *** */

      // Atribution de id_button_enter a la l'input coin_enter_advcash
      var input_enter_advcash = document.getElementById('input_enter_advcash').value;
      document.getElementById('input_enter_advcash').value = id_button_enter;

      /* *** Formulaire Advcash *** */
    }
    else if(element.name == 'coin_out'){
      //Recuperation du name du bouton
      var name_button_out = element.name;

      //Recuperation de l'id du bouton
      var id_button_out = element.id;

      //Recuperation de la valeur du bouton
      var value_button_out = element.value;

      //J'attribue, la valeur du bouton cliqué, au h3 d'id = ce_que_je_recois 
      document.getElementById('ce_que_je_recois').innerHTML = value_button_out;

      /* *** Formulaire Perfect Money *** */

      //Atribution de id_button_out a la l'input coin_out_pm
      document.getElementById('input_out_pm').value = id_button_out;

      /* *** Fin  Formulaire Perfect Money *** */

      /* *** Formulaire Payeer *** */

      // Atribution de id_button_out a la l'input coin_out_payeer 
      var input_out_payeer = document.getElementById('input_out_payeer').value;
      document.getElementById('input_out_payeer').value = id_button_out;

      /* *** Formulaire Payeer *** */

      /* *** Formulaire Mtn *** */

      // Atribution de id_button_out a la l'input coin_out_mtn 
      var input_out_mtn = document.getElementById('input_out_mtn').value;
      document.getElementById('input_out_mtn').value = id_button_out;

      /* *** Formulaire Mtn *** */

      /* *** Formulaire Flooz *** */

      // Atribution de id_button_out a la l'input coin_out_flooz 
      var input_out_flooz = document.getElementById('input_out_flooz').value;
      document.getElementById('input_out_flooz').value = id_button_out;

      /* *** Formulaire Flooz *** */

      /* *** Formulaire TMoney *** */

      // Atribution de id_button_out a la l'input coin_out_tm 
      var input_out_tm = document.getElementById('input_out_tm').value;
      document.getElementById('input_out_tm').value = id_button_out;

       /* *** Formulaire TMoney *** */

      /* *** Formulaire Bitcoin *** */

      // Atribution de id_button_out a la l'input coin_out_btc
      var input_out_btc = document.getElementById('input_out_btc').value;
      document.getElementById('input_out_btc').value = id_button_out;

      /* *** Formulaire Bitcoin *** */

       /* *** Formulaire Advcash *** */

      // Atribution de id_button_out a la l'input coin_out_advcash
      var input_out_advcash = document.getElementById('input_out_advcash').value;
      document.getElementById('input_out_advcash').value = id_button_out;

      /* *** Formulaire Advcash *** */
      
    }

    //Si on a les meme valeur , la transaction est impossible
    if (document.getElementById('input_enter_pm').value == document.getElementById('input_out_pm').value)
    {
      document.getElementById('etat').innerHTML = "<span style='color:red;'> Transaction impossible </span>"
      document.getElementById('operation_pm').disabled = true;
      document.getElementById('operation_mtn').disabled = true;
      document.getElementById('operation_flooz').disabled = true;
      document.getElementById('operation_tm').disabled = true;
      document.getElementById('operation_payeer').disabled = true;
      document.getElementById('operation_btc').disabled = true;
      document.getElementById('operation_advcash').disabled = true;
    }
    else
    {
        document.getElementById('etat').innerHTML = " "
        document.getElementById('operation_pm').disabled = false;
        document.getElementById('operation_mtn').disabled = false;
        document.getElementById('operation_flooz').disabled = false;
        document.getElementById('operation_tm').disabled = false;
        document.getElementById('operation_payeer').disabled = false;
        document.getElementById('operation_btc').disabled = false;
        document.getElementById('operation_advcash').disabled = false;
      }
    //Fsi

    //Afficher ce formulaire si seulement on envoie  du Perfect Money
    if (value_button_enter == 'PerfectMoney' || value_button_enter === 'Perfect money' || 
      value_button_enter.toLowerCase() === 'perfect money') {
      document.getElementById('sendPerfectMoney').style.display='block';
      document.getElementById('sendMtn').style.display='none';
      document.getElementById('sendFlooz').style.display='none';
      document.getElementById('sendTMoney').style.display='none';
      document.getElementById('sendPayeer').style.display='none';
      document.getElementById('sendBitcoin').style.display='none';
      document.getElementById('sendAdvcash').style.display='none';
    }
    else if(value_button_enter.toLowerCase() == 'mtn' || value_button_enter.toLowerCase() == 'mtn mobile money' 
    || value_button_enter.toLowerCase() == 'mtn money') {
      document.getElementById('sendMtn').style.display='block';
      document.getElementById('sendFlooz').style.display='none';
      document.getElementById('sendPerfectMoney').style.display='none';
      document.getElementById('sendTMoney').style.display='none';
      document.getElementById('sendPayeer').style.display='none';
      document.getElementById('sendBitcoin').style.display='none';
      document.getElementById('sendAdvcash').style.display='none';
    }
    else if(value_button_enter.toLowerCase() == 'flooz') {
      document.getElementById('sendFlooz').style.display='block';
      document.getElementById('sendPerfectMoney').style.display='none';
      document.getElementById('sendMtn').style.display='none';
      document.getElementById('sendTMoney').style.display='none';
      document.getElementById('sendPayeer').style.display='none';
      document.getElementById('sendBitcoin').style.display='none';
      document.getElementById('sendAdvcash').style.display='none';
    }
    else if(value_button_enter.toLowerCase() == 'tmoney' || value_button_enter.toLowerCase() == 't money') {
      document.getElementById('sendTMoney').style.display='block';
      document.getElementById('sendMtn').style.display='none';
      document.getElementById('sendFlooz').style.display='none';
      document.getElementById('sendPerfectMoney').style.display='none';
      document.getElementById('sendPayeer').style.display='none';
      document.getElementById('sendBitcoin').style.display='none';
      document.getElementById('sendAdvcash').style.display='none';
    }
    else if(value_button_enter == 'Payeer' || value_button_enter.toLowerCase() == 'payeer') {
      document.getElementById('sendPayeer').style.display='block';
      document.getElementById('sendPerfectMoney').style.display='none';
      document.getElementById('sendMtn').style.display='none';
      document.getElementById('sendFlooz').style.display='none';
      document.getElementById('sendTMoney').style.display='none';
      document.getElementById('sendBitcoin').style.display='none';
      document.getElementById('sendAdvcash').style.display='none';
    }
    else if(value_button_enter.toLowerCase() == 'bitcoin' || value_button_enter.toLowerCase() == 'bit coin' || value_button_enter.toLowerCase() == 'btc') {
      document.getElementById('sendBitcoin').style.display='block';
      document.getElementById('sendPayeer').style.display='none';
      document.getElementById('sendPerfectMoney').style.display='none';
      document.getElementById('sendMtn').style.display='none';
      document.getElementById('sendFlooz').style.display='none';
      document.getElementById('sendTMoney').style.display='none';
      document.getElementById('sendAdvcash').style.display='none';
    }
    else if(value_button_enter == 'Advcash' || value_button_enter.toLowerCase() == 'advcash' || 
    value_button_enter.toLowerCase() == 'adv cash') {
      document.getElementById('sendAdvcash').style.display='block';
      document.getElementById('sendBitcoin').style.display='none';
      document.getElementById('sendPayeer').style.display='none';
      document.getElementById('sendPerfectMoney').style.display='none';
      document.getElementById('sendMtn').style.display='none';
      document.getElementById('sendFlooz').style.display='none';
      document.getElementById('sendTMoney').style.display='none';
    }
    else{
      document.getElementById('sendMtn').style.display='none';
      document.getElementById('sendFlooz').style.display='none';
      document.getElementById('sendTMoney').style.display='none';
      document.getElementById('sendPerfectMoney').style.display='none';
      document.getElementById('sendPayeer').style.display='none';
      document.getElementById('sendBitcoin').style.display='none';
      document.getElementById('sendAdvcash').style.display='none';
    }
  }

</script>

@endsection