@extends('layout.admin.index')
@section('content')
@section('title','Liste des catégories')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <a href=" {{ route('add_type') }} " class="btn btn-outline-primary btn-rounded"> <i class="fa fa-plus-circle"></i> Nouvelle catégorie </a>
        <p class="card-description"> <h4 class="text-center">LISTE DES CATEGORIES</h4> </p>
        <table class="table table-striped">
          <thead>
            <tr>
              <th> Libelle </th>
              <th> Action </th>
            </tr>
          </thead>
          <tbody>
              @foreach ($type as $types)
                <tr>
                    <td> {{ $types->libelle_type }} </td>
                    <td>
                      <a href="#" class="btn btn-outline-success" title="modifier"> <i class="fa fa-edit"></i>  </a> |
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