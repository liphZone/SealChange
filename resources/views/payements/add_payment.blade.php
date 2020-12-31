@extends('layout.admin.index')
@section('content')
@section('title','Payement')

<h3> SAISIR VOTRE MONTANT</h3>
<form class="forms-sample" action="{{ route('payements.store') }}" method="POST">
  @csrf
    <div class="form-group">
      <label> montant </label>
      <input type="text" class="form-control" name="montant" required>
    </div>
    <button type="submit" class="btn btn-success btn-block mr-2"> Envoyer </button>
  </form>
@endsection