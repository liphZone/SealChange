@extends('layout.admin.index')
@section('content')
@section('title','Ajouter catégorie')

<h3> AJOUTER UN NOUVEAU TYPE </h3>
<form class="forms-sample" action="{{ route('types.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label> Libelle </label>
        <input type="text" class="form-control" name="libelle_type" required>
        @error('libelle_type')
            <div style="color: red;"> {{ $message }} </div>
        @enderror
    </div>

    <button type="submit" class="btn btn-success btn-block mr-2"> Ajouter </button>
  </form>
@endsection