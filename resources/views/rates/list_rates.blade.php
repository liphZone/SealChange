@extends('layout.admin.index')
@section('content')
@section('title','Liste taux')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <a href="{{ route('add_rate') }}" class="btn btn-outline-primary btn-rounded"> <i class="fa fa-plus-circle"></i> Ajouter un  taux </a>
            <p class="card-description"> <h3 class="text-center"> LISTE DES TAUX </h3> </p>
            <table class="table table-hover">
                <thead>
                    <tr>
                    <th> Monnaie 1 </th>
                    <th> Monnaie 2 </th>
                    <th> Valeur </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rate as $rates)
                        <tr>
                            <td> {{ $rates->monnaie_send }} </td>
                            <td> {{ $rates->monnaie_receive }} </td>
                            <td> {{ $rates->valeur }} </td>
                            <td>
                                <a href="{{ route('edit_rate',$rates->id) }}" class="btn btn-outline-success" title="modifier"> <i class="fa fa-edit" aria-hidden="true"></i>  </a> 
                                {{-- <a href="#" title="retrogradrer" onclick="return Action()" class="btn btn-outline-info"> <i class="fa fa-angle-double-down" aria-hidden="true"></i>  </a> --}}
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