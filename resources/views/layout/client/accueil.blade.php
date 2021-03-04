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
          <input type="number" min="1" class="form-control" name="amount" id="amount_pm" autocomplete="off" required>
          @error('amount')
            <div style="color: red;"> {{ $message }} </div>
          @enderror
        </div>
    
        <div class="form-group">
          <label for=""> Compte Récepteur ou numéro(avec l'indicatif) </label>
          <input type="text" class="form-control" name="accountreceive" id="account_receive" autocomplete="off" required>
          @error('accountreceive')
            <div style="color: red;"> {{ $message }} </div>
          @enderror
        </div>

        <div class="form-group">
          <input hidden type="text" class="form-control" name="devise_enter_pm" id="devise_enter_pm" readonly>
        </div>

        <div class="form-group">
          <label for=""> Devise sortante </label>
          <select class="form-control" onchange="choixDeviseSortantePerfectMoney()" name="devise_out_pm" id="devise_out_pm" required>
            <option value=""> Choisir </option>
            <option value="EUR"> Euro </option>
            <option value="USD"> Dollar </option>
            <option value="XOF"> F CFA </option>
          </select>
        </div>

        <div class="form-group">
          <label for=""> Montant à reçevoir </label>
          <input type="number" class="form-control" name="total" id="montant_total_pm" readonly>
          @error('total')
            <div style="color: red;"> {{ $message }} </div>
          @enderror
        </div>

        <button id="operation_pm" type="submit" class="btn btn-primary btn-block mr-2"> Valider </button>
      </form>


      <form class="forms-sample" action="{{ route('action_waiting_mtn') }}" method="POST" id="sendMtn" style="display: none">
        @csrf
        <div class="form-group" hidden>
          <input id="input_enter_mtn" class="form-control" type="text" name="coin_enter_mtn" required>
          <input id="input_out_mtn" class="form-control" type="text" name="coin_out_mtn" required>
        </div>

        <div class="form-group">
          <label for=""> Saisir le montant </label>
          <input type="number" min="1" class="form-control" name="amount" id="amount_mtn" value="{{ old('montant') }}" required>
          @error('montant')
            <div style="color: red;"> {{ $message }} </div>
          @enderror
        </div>

        <div class="form-group">
          <input hidden type="text" class="form-control" name="devise_enter_mtn" value="XOF" readonly>
        </div>

        <div class="form-group">
          <label for=""> Adresse receptrice </label>
          <input type="text" class="form-control" name="account_receiver" id="account_receive" placeholder="ex: P6872131 ou U4514252" autocomplete="off" required>
          @error('account_receiver')
            <div style="color: red;"> {{ $message }} </div>
          @enderror
        </div>

        <div class="form-group">
          <label for=""> Devise sortante </label>
          <select class="form-control" onchange="choixDeviseSortanteMtn()" name="devise_out" id="devise_out_mtn" required>
            <option value=""> Choisir  </option>
            <option value="EUR"> Euro </option>
            <option value="USD"> Dollar </option>
          </select>
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
          <input type="number" min="1" class="form-control" name="amount" id="amount_flooz" value="{{ old('montant') }}" required>
          @error('montant')
            <div style="color: red;"> {{ $message }} </div>
          @enderror
        </div>

        <div class="form-group">
          <input hidden type="text" class="form-control" name="devise_enter_flooz" value="XOF" readonly>
        </div>

        <div class="form-group">
          <label for=""> Adresse receptrice </label>
          <input type="text" class="form-control" name="account_receiver" id="account_receive" placeholder="ex: P6872131 ou U4514252" autocomplete="off" required>
          @error('account_receiver')
            <div style="color: red;"> {{ $message }} </div>
          @enderror
        </div>

        <div class="form-group">
          <label for=""> Devise sortante </label>
          <select class="form-control" onchange="choixDeviseSortanteFlooz()" name="devise_out" id="devise_out_flooz" required>
            <option value=""> Choisir  </option>
            <option value="EUR"> Euro </option>
            <option value="USD"> Dollar </option>
          </select>
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
          <input type="number" min="1" class="form-control" name="amount" id="amount_tm" value="{{ old('montant') }}" required>
          @error('montant')
            <div style="color: red;"> {{ $message }} </div>
          @enderror
        </div>

        <div class="form-group">
          <input hidden type="text" class="form-control" name="devise_enter_tm" value="XOF" readonly>
        </div>

        <div class="form-group">
          <label for=""> Adresse receptrice </label>
          <input type="text" class="form-control" name="account_receiver" id="account_receive" placeholder="ex: P6872131 ou U4514252" autocomplete="off" required>
          @error('account_receiver')
            <div style="color: red;"> {{ $message }} </div>
          @enderror
        </div>

        <div class="form-group">
          <label for=""> Devise sortante </label>
          <select class="form-control" onchange="choixDeviseSortanteTMoney()" name="devise_out" id="devise_out_tm" required>
            <option value=""> Choisir  </option>
            <option value="EUR"> Euro </option>
            <option value="USD"> Dollar </option>
          </select>
        </div>

        <div class="form-group">
          <label for=""> Montant à reçevoir </label>
          <input type="number" class="form-control" name="total" id="montant_total_tm" readonly>
          @error('total')
            <div style="color: red;"> {{ $message }} </div>
          @enderror
        </div>

        <button id="operation_tm" type="submit" class="btn btn-success btn-block mr-2"> Opérer </button>
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
        <label id="label_payeer" for=""> Adresse Payeer</label>
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
        </div>

        <div class="form-group">
          <label for=""> Id de la transaction </label>
          <input type="text" class="form-control" name="id_transaction" autocomplete="off" required>
          @error('id_transaction')
            <div style="color: red;"> {{ $message }} </div>
          @enderror
        </div>

        <div class="form-group" hidden>
          <label for=""> Devise sortante </label>
          <input type="text" class="form-control" name="devise_out" id="devise_out_payeer" readonly>
        </div>

        <div class="form-group">
          <label for=""> Montant à reçevoir </label>
          <input type="number" class="form-control" name="having_amount" id="montant_total_payeer" readonly>
          @error('total')
            <div style="color: red;"> {{ $message }} </div>
          @enderror
        </div>

        <button id="operation_payeer" type="submit" class="btn btn-success btn-block mr-2"> Opérer </button>
      </form>


      <form class="forms-sample" action="{{ route('action_waiting_adv_cash') }}" method="POST" id="sendAdvCash" style="display: none">
        @csrf
        <div class="form-group" hidden>
          <input id="input_enter_adv" class="form-control" type="text" name="coin_enter_adv" required>
          <input id="input_out_adv" class="form-control" type="text" name="coin_out_adv" required>
        </div>

        <div class="form-group">
          <label for=""> Votre Compte Advcash</label>
          <input type="text" class="form-control" name="myaccount" id="myaccount_adv" autocomplete="off" required>
          @error('myaccount')
            <div style="color: red;"> {{ $message }} </div>
          @enderror
        </div>

        <div class="form-group">
          <label for=""> Saisir le montant </label>
          <input type="number" min="1" class="form-control" name="amount" id="amount_adv" value="{{ old('montant') }}" required>
          @error('montant')
            <div style="color: red;"> {{ $message }} </div>
          @enderror
        </div>

        <div class="form-group">
          <input hidden type="text" class="form-control" name="devise_enter_adv" id="devise_enter_adv" value="USD" readonly>
        </div>

        <div class="form-group">
          <label for=""> Adresse receptrice </label>
          <input type="text" class="form-control" name="account_receiver" id="account_receive" placeholder="ex: P6872131 ou U4514252" autocomplete="off" required>
          @error('account_receiver')
            <div style="color: red;"> {{ $message }} </div>
          @enderror
        </div>

        <div class="form-group">
          <label for=""> E mail </label>
          <input type="email" class="form-control" name="email" autocomplete="off" required>
          @error('email')
            <div style="color: red;"> {{ $message }} </div>
          @enderror
        </div>

        <div class="form-group">
          <label for=""> Devise sortante </label>
          <select class="form-control" onchange="choixDeviseSortanteAdvCash()" name="devise_out" id="devise_out_adv" required>
            <option value=""> Choisir  </option>
            <option value="EUR"> Euro </option>
            <option value="USD"> Dollar </option>
          </select>
        </div>

        <div class="form-group">
          <label for=""> Montant à reçevoir </label>
          <input type="number" class="form-control" name="total" id="montant_total_adv" readonly>
          @error('total')
            <div style="color: red;"> {{ $message }} </div>
          @enderror
        </div>

        <button id="operation_adv" type="submit" class="btn btn-success btn-block mr-2"> Opérer </button>
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

  function choixDeviseSortanteMtn(){
    devise_out = document.getElementById('devise_out_mtn').value;
    var amount_mtn = document.getElementById('amount_mtn').value;
    if (devise_out == 'EUR'){
      var mt =  amount_mtn*0.0015 + amount_mtn*0.0015*0.02
      document.getElementById('montant_total_mtn').value = mt;
    }else if(devise_out == 'USD'){
      var mt =  amount_mtn*0.0019 + amount_mtn*0.0019*0.02
      document.getElementById('montant_total_mtn').value = mt;
    }
  }


  function choixDeviseSortanteFlooz(){
    devise_out = document.getElementById('devise_out_flooz').value;
    var amount_flooz = document.getElementById('amount_flooz').value;
    if (devise_out == 'EUR'){
      var mt =  amount_flooz*0.0015 + amount_flooz*0.0015*0.02
      document.getElementById('montant_total_flooz').value = mt;
    }else if(devise_out == 'USD'){
      var mt =  amount_flooz*0.0019 + amount_flooz*0.0019*0.02
      document.getElementById('montant_total_flooz').value = mt;
    }
  }

  function choixDeviseSortanteTMoney(){
    devise_out = document.getElementById('devise_out_tm').value;
    var amount_tm = document.getElementById('amount_tm').value;
    if (devise_out == 'EUR'){
      var mt =  amount_tm*0.0015 + amount_tm*0.0015*0.02
      document.getElementById('montant_total_tm').value = mt;
    }else if(devise_out == 'USD'){
      var mt =  amount_tm*0.0019 + amount_tm*0.0019*0.02
      document.getElementById('montant_total_tm').value = mt;
    }
  }

 
  function choixDeviseSortanteAdvCash(){
    var account_sender = document.getElementById('myaccount_adv').value;
    var first_letter_account_sender =  account_sender.substr(account_sender,1);
    if (first_letter_account_sender == 'U') {
      var devise_enter_adv = document.getElementById('devise_enter_adv').value = 'USD';
      devise_out = document.getElementById('devise_out_adv').value
      if (devise_out == 'EUR'){
        var amount_adv = document.getElementById('amount_adv').value;
        var mt =  (amount_adv*0.82 + amount_adv*0.82*0.02);
        document.getElementById('montant_total_adv').value = mt;
      }else if(devise_out == 'USD'){
        var amount_adv = document.getElementById('amount_adv').value;
        var mt =  amount_adv*1 + amount_adv*0.02
        document.getElementById('montant_total_adv').value = mt;
      }
    }else if(first_letter_account_sender == 'E'){
      var devise_enter_adv = document.getElementById('devise_enter_adv').value = 'USD';
      devise_out = document.getElementById('devise_out_adv').value
      if (devise_out == 'EUR'){
        var amount_adv = document.getElementById('amount_adv').value;
        var mt = amount_adv*1 + amount_adv*0.02;
        document.getElementById('montant_total_adv').value = mt;
        alert(document.getElementById('montant_total_adv').value);
      }else if(devise_out == 'USD'){
        var mt = amount_adv*1.22 + amount_adv*1.22*0.02
        document.getElementById('montant_total_adv').value = mt;
      }
      else if(devise_out == 'XOF'){
        var mt = amount_adv*656.43 + amount_adv*656.43*0.02
        document.getElementById('montant_total_adv').value = mt;
      }
    }
  }

  function choixDeviseSortantePerfectMoney(){
    var account_sender = document.getElementById('myaccount').value;
    var first_letter_account_sender =  account_sender.substr(account_sender,1);
    if (first_letter_account_sender == 'U') {
      var devise_enter_pm = document.getElementById('devise_enter_pm').value = 'USD';
      devise_out = document.getElementById('devise_out_pm').value
      if (devise_out == 'EUR'){
        var amount_pm = document.getElementById('amount_pm').value;
        var mt = amount_pm*0.82 + amount_pm*0.82*0.02;
        document.getElementById('montant_total_pm').value = mt;
      }else if(devise_out == 'USD'){
        var amount_pm = document.getElementById('amount_pm').value;
        var mt =  amount_pm*1 + amount_pm*0.02
        document.getElementById('montant_total_pm').value = mt;
      }
      else if(devise_out == 'XOF'){
        var amount_pm = document.getElementById('amount_pm').value;
        var mt = amount_pm*539.22 + amount_pm*539.22*0.02
        document.getElementById('montant_total_pm').value = mt;
      }
    }else if(first_letter_account_sender == 'E'){
      var devise_enter_pm = document.getElementById('devise_enter_pm').value = 'EUR';
      devise_out = document.getElementById('devise_out_pm').value
      if (devise_out == 'EUR'){
        var amount_pm = document.getElementById('amount_pm').value;
        var mt = amount_pm*1 + amount_pm*0.02;
        document.getElementById('montant_total_pm').value = mt;
        alert(document.getElementById('montant_total_pm').value);
      }else if(devise_out == 'USD'){
        var mt =  amount_pm*1.22 + amount_pm*1.22*0.02
        document.getElementById('montant_total_pm').value = mt;
      }
      else if(devise_out == 'XOF'){
        var mt =  amount_pm*656.43 + amount_pm*656.43*0.02
        document.getElementById('montant_total_pm').value = mt;
      }
    }
  }

  function amountPayeer(){
    if (document.getElementById('devise_out_payeer').value === 'XOF') {
      var amount_payeer = document.getElementById('amount_payeer').value;
      var mt =  amount_payeer*545 + amount_payeer*545*0.02;
      document.getElementById('montant_total_payeer').value = mt;
    }else if(document.getElementById('devise_out_payeer').value === 'USD'){
      var amount_payeer = document.getElementById('amount_payeer').value;
      var mt = amount_payeer*1 + amount_payeer*0.02;
      document.getElementById('montant_total_payeer').value = mt;
    }
  }

  
  function choiceMoney(element){
    //Afficher adresse receptrice ou numero de telephone 
    if (element.name === 'coin_out') {
        if (element.value.toLowerCase() === 'flooz' || element.value.toLowerCase() === 't money' 
        || element.value.toLowerCase() === 'tmoney' || element.value.toLowerCase() === 'mtn' 
        || element.value.toLowerCase() === 'mtn money' || element.value.toLowerCase() === 'mtn mobile money') {
        document.getElementById('devise_out_payeer').value = 'XOF';
      }else{
        document.getElementById('devise_out_payeer').value = 'USD';
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

      /* *** Formulaire AdvCash *** */

      // Atribution de id_button_enter a la l'input coin_enter_adv
      var input_enter_adv = document.getElementById('input_enter_adv').value;
      document.getElementById('input_enter_adv').value = id_button_enter;

      /* *** Formulaire AdvCash *** */
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

      /* *** Formulaire Payeer *** */

      // Atribution de id_button_out a la l'input coin_out_tm 
      var input_out_payeer = document.getElementById('input_out_payeer').value;
      document.getElementById('input_out_payeer').value = id_button_out;

      /* *** Formulaire Payeer *** */

      /* *** Formulaire AdvCash *** */

      // Atribution de id_button_out a la l'input coin_out_adv
      var input_out_adv = document.getElementById('input_out_adv').value;
      document.getElementById('input_out_adv').value = id_button_out;

      /* *** Formulaire AdvCash *** */
      
    }

    //Si on a les meme valeur , la transaction est impossible
    if (document.getElementById('input_enter_pm').value == document.getElementById('input_out_pm').value){
      document.getElementById('etat').innerHTML = "<span style='color:red;'> Transaction impossible </span>"
      document.getElementById('operation_pm').disabled = true;
      document.getElementById('operation_mtn').disabled = true;
      document.getElementById('operation_flooz').disabled = true;
      document.getElementById('operation_tm').disabled = true;
      document.getElementById('operation_payeer').disabled = true;
      document.getElementById('operation_adv').disabled = true;
    }
    else{
        document.getElementById('etat').innerHTML = " "
        document.getElementById('operation_pm').disabled = false;
        document.getElementById('operation_mtn').disabled = false;
        document.getElementById('operation_flooz').disabled = false;
        document.getElementById('operation_tm').disabled = false;
        document.getElementById('operation_payeer').disabled = false;
        document.getElementById('operation_adv').disabled = false;
      }
    //Fsi

    //Afficher ce formulaire si seulement on envoie  du Perfect Money
    if (value_button_enter == 'PerfectMoney' || value_button_enter === 'Perfect money' || value_button_enter.toLowerCase() === 'perfect money') {
      document.getElementById('sendPerfectMoney').style.display='block';
      document.getElementById('sendMtn').style.display='none';
      document.getElementById('sendFlooz').style.display='none';
      document.getElementById('sendTMoney').style.display='none';
      document.getElementById('sendPayeer').style.display='none';
      document.getElementById('sendAdvCash').style.display='none';
    }
    else if(value_button_enter.toLowerCase() == 'mtn' || value_button_enter.toLowerCase() == 'mtn mobile money' 
    || value_button_enter.toLowerCase() == 'mtn money') {
      document.getElementById('sendMtn').style.display='block';
      document.getElementById('sendFlooz').style.display='none';
      document.getElementById('sendPerfectMoney').style.display='none';
      document.getElementById('sendTMoney').style.display='none';
      document.getElementById('sendPayeer').style.display='none';
      document.getElementById('sendAdvCash').style.display='none';
    }
    else if(value_button_enter.toLowerCase() == 'flooz') {
      document.getElementById('sendFlooz').style.display='block';
      document.getElementById('sendPerfectMoney').style.display='none';
      document.getElementById('sendMtn').style.display='none';
      document.getElementById('sendTMoney').style.display='none';
      document.getElementById('sendPayeer').style.display='none';
      document.getElementById('sendAdvCash').style.display='none';
    }
    else if(value_button_enter.toLowerCase() == 'tmoney' || value_button_enter.toLowerCase() == 't money') {
      document.getElementById('sendTMoney').style.display='block';
      document.getElementById('sendMtn').style.display='none';
      document.getElementById('sendFlooz').style.display='none';
      document.getElementById('sendPerfectMoney').style.display='none';
      document.getElementById('sendPayeer').style.display='none';
      document.getElementById('sendAdvCash').style.display='none';
    }
    else if(value_button_enter == 'Payeer' || value_button_enter.toLowerCase() == 'payeer') {
      document.getElementById('sendPayeer').style.display='block';
      document.getElementById('sendPerfectMoney').style.display='none';
      document.getElementById('sendMtn').style.display='none';
      document.getElementById('sendFlooz').style.display='none';
      document.getElementById('sendTMoney').style.display='none';
      document.getElementById('sendAdvCash').style.display='none';
    }
    else if(value_button_enter == 'AdvCash' || value_button_enter.toLowerCase() == 'advcash' || value_button_enter.toLowerCase() == 'Advcach' || value_button_enter.toLowerCase() == 'adv cash') {
      document.getElementById('sendAdvCash').style.display='block';
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
      document.getElementById('sendAdvCash').style.display='none';
    }
  }

</script>

@endsection