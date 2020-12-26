@extends('layout.admin.index')
@section('content')
@section('title','Ajouter administrateur')

<h3> AJOUTER UN ADMINISTRATEUR </h3>
<form class="forms-sample" action="{{ route('personnes.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label> Nom </label>
        <input type="text" class="form-control" name="nom" required>
        @error('nom')
            <div style="color: red;"> {{ $message }} </div>
        @enderror
    </div>

    <div class="form-group">
        <label> Prénom(s) </label>
        <input type="text" class="form-control" name="prenom" required>
        @error('prenom')
            <div style="color: red;"> {{ $message }} </div>
        @enderror
    </div>

    <div class="form-group">
        <label> Email </label>
        <input type="email" class="form-control" name="email" required>
        @error('email')
            <div style="color: red;"> {{ $message }} </div>
        @enderror
    </div>
    <h3> CREATION D'UN COMPTE </h3>
    <div class="form-group">
        <label> Mot de passe </label>
        <input type="password" class="form-control" name="password" required>
        @error('password')
            <div style="color: red;"> {{ $message }} </div>
        @enderror
    </div>

    <div class="form-group">
        <label> Confirmation du mot de passe </label>
        <input type="password" class="form-control" name="password_confirmation" required>
        @error('password_confirmation')
            <div style="color: red;"> {{ $message }} </div>
        @enderror
    </div>

    <button type="submit" class="btn btn-success btn-block mr-2"> Ajouter </button>
  </form>
@endsection