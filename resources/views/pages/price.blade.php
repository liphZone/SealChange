@extends('layout.client.index')
@section('content')
@section('title','Price')
<form class="forms-sample" action="#" method="POST">
  @csrf
    {{-- <div class="form-group">
      <label> Ce que j'envoie </label>
      <input type="text" class="form-control" name="coin_enter" value="{{ request('id') }}" readonly>
    </div> --}}
    <div class="form-group">
        <label> COMMENT VOULEZ-VOUS RECEVOIR? </label>
        <select class="form-control" name="coint_out" id="">
            @foreach ($categorie as $categories)
                <h6 class="dropdown-header"> {{ $categories->libelle_type }} </h6>
                @foreach ($monnaie as $monnaies)
                    @if ($monnaies->type_id === $categories->id)
                        <option value=""> {{ $monnaies->libelle }} </option>
                    @endif
                @endforeach
            @endforeach
        </select>
      </div>
    <button type="submit" class="btn btn-success btn-block mr-2"> Opérer </button>
  </form>
@endsection