@extends('layout.admin.index')
@section('content')
@section('title','Liste Utilisateurs')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">LISTE DES UTILISATEURS</h4>
            {{-- <p class="card-description"> Add class <code>.table-hover</code> </p> --}}
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
                    @foreach ($client as $clients)
                        <tr>
                            <td> {{ "$clients->nom $clients->prenom" }} </td>
                            <td> {{ $clients->email }} </td>
                            <td> {{ $clients->contact }} </td>
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