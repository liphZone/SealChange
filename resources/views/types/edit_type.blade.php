@extends('layout.admin.index')
@section('content')
@section('title','Modifier catégorie')

<h3> MODIFIER UN TYPE </h3>
<form class="forms-sample" action="{{ route('types.update',$type->id) }}" method="POST">
    @csrf
    @method('put')
    <div class="form-group">
        <label> Libelle </label>
        <input type="text" class="form-control" name="libelle_type" value="{{ $type->libelle_type }}" required>
        @error('libelle_type')
            <div style="color: red;"> {{ $message }} </div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary btn-block mr-2"> Modifier </button>
  </form>
@endsection