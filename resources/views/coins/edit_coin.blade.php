@extends('layout.admin.index')
@section('content')
@section('title','Modifier monnaie')

<h3> MODIFIER UNE MONNAIE </h3>
<form class="forms-sample" action="{{ route('coins.update',$coin->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="form-group">
        <label> Libelle </label>
        <input type="text" class="form-control" name="libelle" value="{{ $coin->libelle }}" required>
        @error('libelle')
            <div style="color: red;"> {{ $message }} </div>
        @enderror
    </div>

    <div class="form-group">
        <label> Description </label>
        <textarea name="description" class="control-label col-lg-12" cols="auto" rows="5">
            {{ $coin->description }}
        </textarea>
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

    <button type="submit" class="btn btn-primary btn-block mr-2"> Modifier </button>
  </form>
@endsection