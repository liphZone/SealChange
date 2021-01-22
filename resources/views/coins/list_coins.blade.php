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
              <th> Action </th>
            </tr>
          </thead>
          <tbody>
            @foreach ($coin as $coins)
              <tr>
                <td class="py-1"> <img src="{{ asset('Zone') }}/{{ $coins->image }}" alt="{{ $coins->libelle }}"/> </td>
                <td> {{ $coins->libelle }} </td>
                <td>
                  <a href="{{route('edit_coin',$coins->id)}}" class="btn btn-outline-success" title="modifier"> <i class="fa fa-edit"></i>   </a> |
                  <a href="#" class="btn btn-outline-danger" title="supprimer"> <i class="fa fa-trash-o" aria-hidden="true"></i>  </a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection