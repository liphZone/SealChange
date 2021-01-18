@extends('layout.client.index')
@section('content')
@section('title','transaction')

@foreach ($monnaie as $monnaies)
    @if (request('id') == "$monnaies->id" AND strtolower($monnaies->libelle) === strtolower('Perfect Money'))

        <form class="forms-sample" action="{{ route('action_perfect_money') }}" method="POST">
            @csrf
                <input hidden type="text" class="form-control" name="coin_enter" id="coin_enter" value="{{ request('id') }}" readonly>
            
            <div class="form-group">
                <label for=""> Moyen de réception </label>
                <select class="form-control" onchange="moyenReceptionPerfectMoney()" name="coin_out" id="coin_out" required>
                    <option value="">Choisir </option>
                    @foreach ($monnaie as $monnaies)
                        <option value="{{ $monnaies->id }}">{{ $monnaies->libelle }} </option>
                    @endforeach
                </select>
                @error('coin_out')
                    <div style="color: red;"> {{ $message }} </div>
                @enderror
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

            <button id="operation" type="submit" class="btn btn-primary btn-block mr-2"> Valider </button>
        
        </form>
            
    
    @elseif(request('id') == "$monnaies->id" AND strtolower($monnaies->libelle) === strtolower('Flooz'))

        <form class="forms-sample" action="{{ route('action_flooz') }}" method="POST">
            @csrf
            <input hidden type="text" class="form-control" name="coin_enter" id="coin_enter" value="{{ request('id') }}" readonly>
            <div class="form-group">
                <label for=""> Moyen de réception </label>
                <select class="form-control" onchange="moyenReceptionFlooz()" name="coin_out" id="coin_out" required>
                    <option value="">Choisir </option>
                    @foreach ($monnaie as $monnaies)
                        <option value="{{ $monnaies->id }}">{{ $monnaies->libelle }} </option>
                    @endforeach
                </select>
                @error('coin_out')
                    <div style="color: red;"> {{ $message }} </div>
                @enderror
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

    @elseif(request('id') == "$monnaies->id" AND strtolower($monnaies->libelle) === strtolower('Bitcoin'))
        <marquee scrollamount=10 behavior="" direction=""> <h4> En cours de traitement ... </h4> </marquee>

    @elseif(request('id') == "$monnaies->id" AND strtolower($monnaies->libelle) === strtolower('Advcash') ||
        strtolower($monnaies->libelle) === strtolower('Advanced Cash'))
        <marquee scrollamount=10 behavior="" direction=""> <h4> En cours de traitement ... </h4> </marquee>

        
    @elseif(request('id') == "$monnaies->id" AND strtolower($monnaies->libelle) === strtolower('Payeer') ||
        strtolower($monnaies->libelle) === strtolower('Payer'))

        <form class="forms-sample" action="{{ route('action_payeer') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for=""> Saisir le montant </label>
                <input type="number" min="1" class="form-control" name="montant" required>
                @error('montant')
                    <div style="color: red;"> {{ $message }} </div>
                @enderror
            </div>

            <div class="form-group">
                <label for=""> Monnaie de payement </label>
                <select class="form-control" name="currency" id="" required>
                    <option value=""> Choisir </option>
                    <option value="EUR"> Euro </option>
                    <option value="USD"> Dollar </option>
                    <option value="BTC"> Bitcoin </option>
                </select>
                @error('currency')
                    <div style="color: red;"> {{ $message }} </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success btn-block mr-2"> Opérer </button>
        </form>
    @endif
@endforeach
<script>
    function moyenReceptionPerfectMoney(){
       var coin_enter = document.getElementById('coin_enter').value;
       var coin_out = document.getElementById('coin_out').value;

        if (coin_enter == coin_out) {
            alert('Transaction impossible');
           document.getElementById('operation').disabled = true;
        } else {
            document.getElementById('operation').disabled = false;
        }
    }

    function moyenReceptionFlooz(){
       var coin_enter = document.getElementById('coin_enter').value;
       var coin_out = document.getElementById('coin_out').value;

        if (coin_enter == coin_out) {
            alert('Transaction impossible');
           document.getElementById('operation').disabled = true;
        } else {
            document.getElementById('operation').disabled = false;
        }
    }

</script>
@endsection