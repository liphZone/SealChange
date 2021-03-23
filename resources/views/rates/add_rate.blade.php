@extends('layout.admin.index')
@section('content')
@section('title','Ajouter un taux')

<h3 class="text-center"> AJOUTER UN TAUX </h3>
<form class="forms-sample" action="{{ route('rates.store') }}" method="POST">
    @csrf
    <h3> Monnaie 1 </h3>
    <div class="form-group">
        <label> Monnaie </label>
        <select class="form-control" onchange="monnaieEntree()" name="monnaie_enter" id="coin_enter" required>
            <option value=""> Choisir </option>
            @foreach ($coin as $coins)
                <option value="{{ $coins->libelle }}"> {{ $coins->libelle }}</option>
            @endforeach
        </select>
        @error('monnaie_enter')
            <div style="color: red;"> {{ $message }} </div>
        @enderror
    </div>

    <div class="form-group">
        <label> Devise </label>
        <input class="form-control" type="text" name="devise_enter" id="devise_enter" readonly>
    </div>
    {{-- <div class="form-group">
        <label> Devise </label>
        <select class="form-control" name="devise_enter" id="devise_enter" required>
            <option value=""> Choisir </option>
            <option value="USD"> Dollar  </option>
            <option value="EUR"> Euro  </option>
            <option value="XOF"> F CFA  </option>
        </select>
        @error('devise_enter')
            <div style="color: red;"> {{ $message }} </div>
        @enderror
    </div> --}}

    <div class="form-group" id="div_valeur_enter">
        <label> Valeur </label>
        <input type="text" class="form-control" name="valeur_enter" value="1" id="valeur_enter" required>
        @error('valeur_enter')
            <div style="color: red;"> {{ $message }} </div>
        @enderror
    </div>
    <span id="valeur_enter_text" class="text-danger"> </span>

    <h3> Monnaie 2 </h3>

    <div class="form-group">
        <label> Monnaie </label>
        <select class="form-control" name="monnaie_out" onchange="monnaieSortie()" id="coin_out" required>
            <option value=""> Choisir </option>
            @foreach ($coin as $coins)
                <option value="{{ $coins->libelle }}"> {{ $coins->libelle }}</option>
            @endforeach
        </select>
        @error('monnaie_out')
            <div style="color: red;"> {{ $message }} </div>
        @enderror
    </div>

    <div class="form-group">
        <label> Devise </label>
        <input class="form-control" type="text" name="devise_out" id="devise_out" readonly>
    </div>
    {{-- <div class="form-group">
        <label> Devise </label>
        <select class="form-control" name="devise_out" id="devise_out" required>
            <option value=""> Choisir </option>
            <option value="USD"> Dollar  </option>
            <option value="EUR"> Euro  </option>
            <option value="XOF"> F CFA  </option>
        </select>
        @error('devise_out')
            <div style="color: red;"> {{ $message }} </div>
        @enderror
    </div> --}}

    <div class="form-group">
        <label> Valeur </label>
        <input type="text" class="form-control" name="valeur_out" id="valeur_out" required>
        @error('valeur_out')
            <div style="color: red;"> {{ $message }} </div>
        @enderror
    </div>

    <button type="submit" class="btn btn-success btn-block mr-2"> Ajouter </button>
  </form>

  <script>
      function monnaieEntree(){
        var coin_enter = document.getElementById('coin_enter').value;
        if (coin_enter.toLowerCase() === 'advcash' || coin_enter.toLowerCase() === 'adv cash' || 
        coin_enter.toLowerCase() === 'perfect money' || coin_enter.toLowerCase() === 'perfet money' || coin_enter.toLowerCase() === 'perfectmoney' || 
        coin_enter.toLowerCase() === 'payeer' || coin_enter.toLowerCase() === 'payer')
       
        {
            document.getElementById('devise_enter').value = 'USD';
            document.getElementById('valeur_enter').value = 1;
            document.getElementById('div_valeur_enter').style.display='none';
            document.getElementById('valeur_enter_text').innerHTML='La valeur est définie à 1 pour le calcul';
        }
        else if(coin_enter.toLowerCase() === 'flooz' || 
        coin_enter.toLowerCase() === 't money' || coin_enter.toLowerCase() === 'tmoney' || 
        coin_enter.toLowerCase() === 'mtn' || coin_enter.toLowerCase() === 'mobile money' || coin_enter.toLowerCase() === 'mtn money' || coin_enter.toLowerCase() === 'mtn mobile money')
        {
            document.getElementById('devise_enter').value = 'XOF';
            document.getElementById('valeur_enter').value = 1000;
            document.getElementById('div_valeur_enter').style.display='none';
            document.getElementById('valeur_enter_text').innerHTML='La valeur est définie à 1000 pour le calcul';
        }    
        else if( coin_enter.toLowerCase() === 'btc' || coin_enter.toLowerCase() === 'bitcoin' || coin_enter.toLowerCase() === 'bit coin' ||
        coin_enter.toLowerCase() === 'limo' || coin_enter.toLowerCase() === 'limo dollar' || coin_enter.toLowerCase() === 'dollar limo') 
        {
            document.getElementById('devise_enter').value = 'USD';
            document.getElementById('valeur_enter').value = 0.00001;
            document.getElementById('div_valeur_enter').style.display='none';
            document.getElementById('valeur_enter_text').innerHTML='La valeur est définie à 0.00001 pour le calcul';
        }        
      }

      function monnaieSortie(){
        var coin_out = document.getElementById('coin_out').value;
        if (coin_out.toLowerCase() === 'advcash' || coin_out.toLowerCase() === 'adv cash' || 
        coin_out.toLowerCase() === 'perfect money' || coin_out.toLowerCase() === 'perfet money' || coin_out.toLowerCase() === 'perfectmoney' || 
        coin_out.toLowerCase() === 'payeer' || coin_out.toLowerCase() === 'payer' ||
        coin_out.toLowerCase() === 'btc' || coin_out.toLowerCase() === 'bitcoin' || coin_out.toLowerCase() === 'bit coin' ||
        coin_out.toLowerCase() === 'limo' || coin_out.toLowerCase() === 'limo dollar' || coin_out.toLowerCase() === 'dollar limo')
        {
            document.getElementById('devise_out').value = 'USD';
        }
        else if(coin_out.toLowerCase() === 'flooz' || 
        coin_out.toLowerCase() === 't money' || coin_out.toLowerCase() === 'tmoney' || 
        coin_out.toLowerCase() === 'mtn' || coin_out.toLowerCase() === 'mobile money' || coin_out.toLowerCase() === 'mtn money' || coin_out.toLowerCase() === 'mtn mobile money')
        {
            document.getElementById('devise_out').value = 'XOF';

        }      
        
      }
  </script>





@endsection