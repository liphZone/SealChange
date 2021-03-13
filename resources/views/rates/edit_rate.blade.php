@extends('layout.admin.index')
@section('content')
@section('title','Modifier un taux')

<h3> MODIFIER un taux </h3>
<form class="forms-sample" action="{{ route('rates.update',$rate->id) }}" method="POST">
    @csrf
    @method('put')
    <div class="form-group">
        <label> Monnaie  1 </label>
        <input type="text" class="form-control" name="monnaie_send" value="{{ $rate->monnaie_send }}" required>
        @error('monnaie_send')
            <div style="color: red;"> {{ $message }} </div>
        @enderror
    </div>

    <div class="form-group">
        <label> Monnaie 2 </label>
        <input type="text" class="form-control" name="monnaie_receive" value="{{ $rate->monnaie_receive }}" required>
        @error('monnaie_receive')
            <div style="color: red;"> {{ $message }} </div>
        @enderror
    </div>
    <div class="form-group">
        <label> Valeur </label>
        <input type="text" class="form-control" name="valeur" value="{{ $rate->valeur }}" required>
        @error('valeur')
            <div style="color: red;"> {{ $message }} </div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary btn-block mr-2"> Modifier </button>
  </form>
@endsection