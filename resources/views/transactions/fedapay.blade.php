@extends('layout.client.index')
@section('content')
@section('title','Transaction')


<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
    <div class="card-body">
        <h4 class="card-title"> <h3 class="text-center"> INFORMATION TRANSACTION </h3> </h4>
        <div class="template-demo">
            <h1>
                TRANSFERT DE <span class="font-weight-bold"> {{ $entree }} </span> VERS <span class="font-weight-bold"> {{ $sortie }} </span>
            </h1>
            <form action="{{ $link }}" method="GET">
                <button class="btn btn sucess" type="submit"> cliquez finaliser le payement <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> </button>
            </form>
            
        </div>
    </div>
    </div>
</div>

@endsection