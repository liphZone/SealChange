@extends('layout.admin.index')
@section('content')
@section('title','Liste taux')

{{-- @php
    $pm = \App\Models\Rate::groupBy('monnaie_enter')->get();
@endphp --}}


<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <a href="{{ route('add_rate') }}" class="btn btn-outline-primary btn-rounded"> <i class="fa fa-plus-circle"></i> Ajouter un  taux </a>
            <p class="card-description"> <h3 class="text-center"> LISTE DES TAUX </h3> </p>
            <table class="table table-hover">
                <thead>
                    <tr>
                    <th> Monnaie 1 </th>
                    <th> Devise 1 </th>
                    <th> Valeur 1 </th>
                    <th> Monnaie 2 </th>
                    <th> Devise 2 </th>
                    <th> Valeur 2 </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rate as $rates)
                        <tr>
                            <td> {{ $rates->monnaie_enter }} </td>
                            <td> {{ $rates->devise_enter }} </td>
                            <td> {{ $rates->valeur_enter }} </td>
                            <td> {{ $rates->monnaie_out }} </td>
                            <td> {{ $rates->devise_out }} </td>
                            <td> {{ $rates->valeur_out }} </td>
                            <td>
                                <a href="{{ route('edit_rate',$rates->id) }}" class="btn btn-outline-success" title="modifier"> <i class="fa fa-edit" aria-hidden="true"></i>  </a> 
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 text-center">
       {{$rate->links()}}
    </div>
</div>

@endsection