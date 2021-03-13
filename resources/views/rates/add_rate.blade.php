@extends('layout.admin.index')
@section('content')
@section('title','Ajouter un taux')

<h3> AJOUTER UN TAUX </h3>
<form class="forms-sample" action="{{ route('rates.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label> Monnaie 1 </label>
        <select class="form-control" name="monnaie_send" id="">
            <option value=""> Choisir </option>
            <option value="USD"> Dollar  </option>
            <option value="EUR"> Euro  </option>
            <option value="XOF"> F CFA  </option>
        </select>
        @error('monnaie_send')
            <div style="color: red;"> {{ $message }} </div>
        @enderror
    </div>

    <div class="form-group">
        <label> Monnaie 2 </label>
        <select class="form-control" name="monnaie_receive" id="">
            <option value=""> Choisir </option>
            <option value="USD"> Dollar  </option>
            <option value="EUR"> Euro  </option>
            <option value="XOF"> F CFA  </option>
        </select>
        @error('monnaie_receive')
            <div style="color: red;"> {{ $message }} </div>
        @enderror
    </div>

    <div class="form-group">
        <label> Valeur </label>
        <input type="text" class="form-control" name="valeur" required>
        @error('valeur')
            <div style="color: red;"> {{ $message }} </div>
        @enderror
    </div>

    

    <button type="submit" class="btn btn-success btn-block mr-2"> Ajouter </button>
  </form>
@endsection