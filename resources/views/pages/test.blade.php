@extends('layout.client.index')
@section('content')
@section('title','TEST')

<form class="forms-sample" action="{{ route('action_test') }}" method="POST">
  @csrf
    <div class="form-group">
        <label for=""> Saisir le montant </label>
        <input type="number" min="1" class="form-control" name="montant" value="{{ old('montant') }}" required>
        @error('montant')
            <div style="color: red;"> {{ $message }} </div>
        @enderror
    </div>

    <label for=""> Compte </label>
        <div class="form-group">
        <input class="form-control" type="text" name="compte">
        @error('compte')
            <div style="color: red;"> {{ $message }} </div>
        @enderror
    </div>
    <button type="submit" class="btn btn-success btn-block mr-2"> Opérer </button>
</form>

@endsection