@extends('layout.admin.index')
@section('content')
@section('title','Historique')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <marquee scrollamount=10 behavior="" direction=""> <h4> Pas encore disponible  ... </h4> </marquee>
            {{-- <p class="card-description"> <h3 class="text-center"> LISTE DES ADMINISTRATEURS </h3> </p>
            <table class="table table-hover">
                <thead>
                    <tr>
                    <th> Compte </th>
                    <th> Utilisateur </th>
                    <th> Action </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td>
                            <a href="#" class="btn btn-outline-primary" title="voir"> <i class="fa fa-eye" aria-hidden="true"></i>  </a> |
                            <a href="#" class="btn btn-outline-success" title="modifier"> <i class="fa fa-edit" aria-hidden="true"></i>  </a> |
                            <a href="#" class="btn btn-outline-danger" title="supprimer"> <i class="fa fa-trash-o" aria-hidden="true"></i>  </a> 
                        </td>
                    </tr>
                </tbody>
            </table> --}}
        </div>
    </div>
</div>

@endsection