@extends('layout.admin.index')
@section('content')
@section('title','Liste administrateurs')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <a href="{{ route('add_person') }}" class="btn btn-outline-primary btn-rounded"> <i class="fa fa-plus-circle"></i> Ajouter administrateur </a>
            <p class="card-description"> <h3 class="text-center"> LISTE DES ADMINISTRATEURS </h3> </p>
            <table class="table table-hover">
                <thead>
                    <tr>
                    <th> Nom & Prénom(s)  </th>
                    <th> Email </th>
                    <th> Contact </th>
                    <th> Action </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($personne as $personnes)
                        <tr>
                            <td> {{ "$personnes->nom $personnes->prenom" }} </td>
                            <td> {{ $personnes->email }} </td>
                            <td> {{ $personnes->contact }} </td>
                            <td> <button class="btn btn-success"> Modifier </button> | <button class="btn btn-danger"> Supprimer </button>  </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection