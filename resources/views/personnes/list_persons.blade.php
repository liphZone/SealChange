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
                            <td>
                                <a href="#" class="btn btn-outline-primary"> <i class="fa fa-eye" aria-hidden="true"></i> Voir </a> |
                                <a href="#" class="btn btn-outline-success"> <i class="fa fa-edit" aria-hidden="true"></i> Modifier </a> |
                                <a href="#" class="btn btn-outline-danger"> <i class="fa fa-trash-o" aria-hidden="true"></i> Supprimer </a> |
                                <a href="{{ route('retrograde',$personnes->id) }}" onclick="return Action()" class="btn btn-outline-info"> <i class="fa fa-angle-double-down" aria-hidden="true"></i> Retrograder </a>
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
        var r = confirm("Vous allez destituer ce utilisateur au statut de simple administrateur,voulez-vous continuer?");
        if (r == false) {
        return false;
        }
    }
</script>
@endsection