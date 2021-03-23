@extends('layout.admin.index')
@section('content')
@section('title','Modifier un taux')

<h3> MODIFIER un taux </h3>
<form class="forms-sample" action="{{ route('rates.update',$rate->id) }}" method="POST">
    @csrf
    @method('put')
    <div class="form-group">
        <label> Monnaie  1 </label>
        <input type="text" class="form-control" name="monnaie_enter" value="{{ $rate->monnaie_enter }}" readonly>
        @error('monnaie_enter')
            <div style="color: red;"> {{ $message }} </div>
        @enderror
    </div>

    <div class="form-group">
        <label> Devise  1 </label>
        <input type="text" class="form-control" name="devise_enter" value="{{ $rate->devise_enter }}" readonly>
        @error('devise_enter')
            <div style="color: red;"> {{ $message }} </div>
        @enderror
    </div>

    <div class="form-group">
        <label> Valeur  1 </label>
        <input type="text" class="form-control" name="valeur_enter" value="{{ $rate->valeur_enter }}" readonly>
        @error('valeur_enter')
            <div style="color: red;"> {{ $message }} </div>
        @enderror
    </div>

    <div class="form-group">
        <label> Monnaie  2 </label>
        <input type="text" class="form-control" name="monnaie_out" value="{{ $rate->monnaie_out }}" readonly>
        @error('monnaie_out')
            <div style="color: red;"> {{ $message }} </div>
        @enderror
    </div>

    <div class="form-group">
        <label> Devise  2 </label>
        <input type="text" class="form-control" name="devise_out" value="{{ $rate->devise_out }}" readonly>
        @error('devise_out')
            <div style="color: red;"> {{ $message }} </div>
        @enderror
    </div>

    <div class="form-group">
        <label> Valeur  2 </label>
        <input type="text" class="form-control" name="valeur_out" value="{{ $rate->valeur_out }}" required>
        @error('valeur_out')
            <div style="color: red;"> {{ $message }} </div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary btn-block mr-2"> Modifier </button>
  </form>
@endsection