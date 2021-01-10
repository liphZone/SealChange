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
                                <a href="#" class="btn btn-outline-primary" title="voir"> <i class="fa fa-eye" aria-hidden="true"></i> </a> |
                                <a href="#" class="btn btn-outline-success" title="modifier"> <i class="fa fa-edit"></i> </a> |
                                <a href="#" class="btn btn-outline-danger" title="supprimer"> <i class="fa fa-trash-o" aria-hidden="true"></i> </a>
                                <a href="{{ route('upgrade',$clients->id) }}" title="promouvoir" onclick="return Action()" class="btn btn-outline-info"> <i class="fa fa-angle-double-up" aria-hidden="true"></i> </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>            
    function Action() {
        var r = confirm("Vous allez promouvoir ce utilisateur au statut d'administrateur,voulez-vous continuer?");
        if (r == false) {
        return false;
        }
    }
</script>
@endsection