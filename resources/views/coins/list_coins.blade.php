@extends('layout.admin.index')
@section('content')
@section('title','Liste des monnaies')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <a href=" {{ route('add_coin') }} " class="btn btn-outline-primary btn-rounded"> <i class="fa fa-plus-circle"></i> Nouvelle monnaie </a>
        <p class="card-description"> <h4 class="text-center">LISTE DES MONNAIES</h4>  </p>
        <table class="table table-striped">
          <thead>
            <tr>
              <th> Image </th>
              <th> Libelle </th>
              <th> Description </th>
              <th> Action </th>
            </tr>
          </thead>
          <tbody>
                @foreach ($coin as $coins)
                    <tr>
                        <td class="py-1">
                        <img src="{{ $coins->image }}" alt="coin"/> </td>
                        <td> {{ $coins->libelle }} </td>
                        <td> {{ substr($coins->description,0,25)}}... </td>
                        <td>
                            <a href="#" class="btn btn-primary"> <i class="fa fa-eye" aria-hidden="true"></i> Voir </a> |
                            <a href="#" class="btn btn-success"> <i class="fa fa-edit"></i>  Modifier </a> |
                            <a href="#" class="btn btn-danger"> <i class="fa fa-trash-o" aria-hidden="true"></i> Supprimer </a>
                        </td>
                    </tr>
                @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection