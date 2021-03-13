@extends('layout.client.index')
@section('content')
@section('title','Crypto Transfert')

@php
  $nombre1 = rand(0,5);
  $nombre2 = rand(0,4);
@endphp

    <div class="form-inline">
      <h4>  Combien font : </h4>  &nbsp;
      <input name="one" class="bg-dark text-white text-center" id="one" class="form-control" size="5" value="{{ $nombre1 }}" type="number" readonly>
      &nbsp;&nbsp;
      <button class="btn btn-primary"> + </button> 
      &nbsp;&nbsp;
      <input name="two" class="bg-dark text-white text-center" id="two" class="form-control" size="5" value="{{ $nombre2 }}" type="number" readonly>
      &nbsp;&nbsp;
      <button class="btn btn-primary"> = </button> 
      &nbsp;&nbsp;
      <input name="result" id="result" onkeyup="calc()" size="5" class="form-control" type="number" required>  <i id="state" class="fa fa-question" aria-hidden="true"></i>
    </div> 

    <div class="mt-3 container" id="div_btc" style="display: none">
      <h4>Adresse BTC </h4>
      <p class="text-white bg-dark pl-1 font-weight-bold"> {{ $adresse_bitcoin }} </p>
      <span class="text-danger">Copiez l'adresse bitcoin ci-dessus </span>  
    </div>

    
<script>

  function calc(){
    var x = parseInt(document.getElementById('one').value);
    var y = parseInt(document.getElementById('two').value);
    var r = parseInt(document.getElementById('result').value);
    
    if (r == x + y) {
      document.getElementById('div_btc').style.display='block';
      document.getElementById('state').className='fa fa-check text-success';
    }else {
      document.getElementById('div_btc').style.display='none';
      document.getElementById('state').className='fa fa-question';
    }

  }

</script>
@endsection

