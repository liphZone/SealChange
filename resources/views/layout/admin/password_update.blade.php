@extends('layout.admin.index')
@section('content')
@section('title','Modifier mot de passe')

    <h3> CHANGER MOT DE PASSE </h3>
    <form class="forms-sample" action="{{ route('action_password_update') }}" method="POST">
        @csrf
        <div class="form-group">
            <label> Nouveau mot de passe </label>
            <input type="password" class="form-control" name="password" required>
            @error('password')
                <div style="color:red;"> {{ $message }} </div>
            @enderror
        </div>

        <div class="form-group">
            <label> Confirmation </label>
            <input type="password" class="form-control" name="password_confirmation">
            @error('password_confirmation')
                <div style="color:red;"> {{ $message }} </div>
            @enderror
        </div>
    
        <button type="submit" class="btn btn-success btn-block mr-2"> Sauvegarder </button>
  </form>
@endsection