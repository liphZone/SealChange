@extends('layout.client.index')
@section('content')
@section('title','Historique')


<div class="dropdown col-mf-4 offset-md-4" style="margin-top: 10%;">
    <button class="btn btn-outline-primary dropdown-toggle" type="button"
     id="dropdownMenuOutlineButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> VOUS VOULEZ CONSULTER LES TRANSACTIONS DE </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuOutlineButton1">
        @foreach ($categorie as $categories)
            <h6 class="dropdown-header">{{ $categories->libelle_type }}</h6>
            @foreach ($monnaie as $monnaies)
                @if ($monnaies->type_id === $categories->id)
                    <a class="dropdown-item" href="{{ route('form_historique',$monnaies->id) }}">  <img src="{{ asset('Zone') }}/{{ $monnaies->image }}" height="40px;" width="40px;" style="border-radius: 20px;" alt=""> 
                        {{ $monnaies->libelle }}  </a>
                    <div class="dropdown-divider"></div>
                @endif
            @endforeach
        @endforeach
    </div>
</div>



  
@endsection