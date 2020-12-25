@extends('layout.admin.index')
@section('content')
@section('title','Nouvelle monnaie')

<h3> AJOUTER UNE NOUVELLE MONNAIE </h3>
<form class="forms-sample" action="{{ route('coins.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label> Libelle </label>
        <input type="text" class="form-control" name="libelle" required>
        @error('libelle')
            <div style="color: red;"> {{ $message }} </div>
        @enderror
    </div>

    <div class="form-group">
        <label> Description </label>
        <textarea name="description" class="control-label col-lg-12" cols="auto" rows="5"></textarea>
        @error('description')
            <div style="color: red;"> {{ $message }} </div>
        @enderror
    </div>

    <div class="form-group">
        <label> Image </label>
        <input type="file" class="form-control" name="image">
        @error('image')
            <div style="color: red;"> {{ $message }} </div>
        @enderror
    </div>

    <div class="form-group">
        <label> Catégorie </label>
        <select class="form-control" name="type_id" required>
            <option value="">Choisir </option>
            @foreach ($type as $types)
                <option value="{{ $types->id }}"> {{ $types->libelle_type }}</option>
            @endforeach
        </select>
        @error('type_id')
            <div style="color: red;"> {{ $message }} </div>
        @enderror
    </div>

    <button type="submit" class="btn btn-success btn-block mr-2"> Ajouter </button>
  </form>
@endsection