@extends('layout.client.index')
@section('content')
@section('title','Accueil')
<style>
  .traitVertical{
    border-left: 4px solid #000;
    display: inline-block;
    height: 250px;
    margin: 20px;
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
      <form class="forms-sample" action="{{ route('action_perfect_money') }}" method="POST" id="sendPerfectMoney" style="display: none">
        @csrf
        <div class="form-group" hidden>
          <input id="input_enter_pm" class="form-control" type="text" name="coin_enter_pm" placeholder="Entrer" required>
          <input id="input_out_pm" class="form-control" type="text" name="coin_out_pm" placeholder="Sortie" required>
        </div>

        <div class="form-group">
          <label for=""> Id client</label>
          <input type="text" class="form-control" name="accountid" placeholder="votre id client perfect money" autocomplete="off" required>
          @error('accountid')
              <div style="color: red;"> {{ $message }} </div>
          @enderror
        </div>
  
        <div class="form-group">
            <label for=""> Mot de passe </label>
            <input type="password" class="form-control" name="pwd" placeholder="votre mot de passe perfect money" required>
            @error('pwd')
                <div style="color: red;"> {{ $message }} </div>
            @enderror
        </div>
    
        <div class="form-group">
            <label for=""> Votre Compte Perfect Money </label>
            <input type="text" class="form-control" name="myaccount" autocomplete="off" required>
            @error('myaccount')
                <div style="color: red;"> {{ $message }} </div>
            @enderror
        </div>
    
        <div class="form-group">
          <label for=""> Montant à transferer </label>
          <input type="number" min="1" class="form-control" name="amount" autocomplete="off" required>
          @error('amount')
            <div style="color: red;"> {{ $message }} </div>
          @enderror
        </div>
    
        <div class="form-group">
          <label for=""> Compte Récepteur </label>
          <input type="text" class="form-control" name="accountreceive" autocomplete="off" required>
          @error('accountreceive')
            <div style="color: red;"> {{ $message }} </div>
          @enderror
        </div>

        <button id="operation_pm" type="submit" class="btn btn-primary btn-block mr-2"> Valider </button>
      </form>


      <form class="forms-sample" action="{{ route('action_flooz') }}" method="POST" id="sendFlooz" style="display: none">
        @csrf
        <div class="form-group" hidden>
          <input id="input_enter_flooz" class="form-control" type="text" name="coin_enter_flooz" required>
          <input id="input_out_flooz" class="form-control" type="text" name="coin_out_flooz" required>
        </div>

        <div class="form-group">
            <label for=""> Saisir le montant </label>
            <input type="number" min="1" class="form-control" name="montant" value="{{ old('montant') }}" required>
            @error('montant')
                <div style="color: red;"> {{ $message }} </div>
            @enderror
        </div>

        <button id="operation" type="submit" class="btn btn-success btn-block mr-2"> Opérer </button>
    </form>



    </div>
  </div>


<script>
  function choiceMoney(element){
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

      /* *** Formulaire Flooz *** */

      // Atribution de id_button_enter a la l'input coin_enter_flooz 
      var input_enter_flooz = document.getElementById('input_enter_flooz').value;
      document.getElementById('input_enter_flooz').value = id_button_enter;

       /* *** Formulaire Flooz *** */

     
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

      /* *** Formulaire Flooz *** */

      // Atribution de id_button_out a la l'input coin_out_flooz 
      var input_out_flooz = document.getElementById('input_out_flooz').value;
      document.getElementById('input_out_flooz').value = id_button_out;

       /* *** Formulaire Flooz *** */
      
    }

    //Si on a les meme valeur , la transaction est impossible
    if (document.getElementById('input_enter_pm').value == document.getElementById('input_out_pm').value) {
        document.getElementById('etat').innerHTML = "<span style='color:red;'> Transaction impossible </span>"
        document.getElementById('operation_pm').disabled = true;
      }
    else{
        document.getElementById('etat').innerHTML = " "
        document.getElementById('operation_pm').disabled = false;
      }
    //Fsi

    //Afficher ce formulaire si seulement on envoie  du Perfect Money
    if (value_button_enter == 'PerfectMoney' || value_button_enter.toLowerCase() == 'perfect money') {
      document.getElementById('sendPerfectMoney').style.display='block';
      document.getElementById('sendFlooz').style.display='none';
    }
    else if(value_button_enter == 'Flooz' || value_button_enter.toLowerCase() == 'flooz') {
      document.getElementById('sendFlooz').style.display='block';
      document.getElementById('sendPerfectMoney').style.display='none';
    }else{
      document.getElementById('sendFlooz').style.display='none';
      document.getElementById('sendPerfectMoney').style.display='none';
    }


  }
</script>

@endsection