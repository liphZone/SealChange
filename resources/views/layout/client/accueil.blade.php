@extends('layout.client.index')
@section('content')
@section('title','Accueil')
<div class="row">
    <div class="col-md-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-3 col-md-6">
              <div class="d-flex">
                <div class="wrapper">
                  <h3 class="mb-0 font-weight-semibold">32,451</h3>
                  <h5 class="mb-0 font-weight-medium text-primary">Visits</h5>
                  <p class="mb-0 text-muted">+14.00(+0.50%)</p>
                </div>
                <div class="wrapper my-auto ml-auto ml-lg-4">
                  <canvas height="50" width="100" id="stats-line-graph-1"></canvas>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 mt-md-0 mt-4">
              <div class="d-flex">
                <div class="wrapper">
                  <h3 class="mb-0 font-weight-semibold">15,236</h3>
                  <h5 class="mb-0 font-weight-medium text-primary">Impressions</h5>
                  <p class="mb-0 text-muted">+138.97(+0.54%)</p>
                </div>
                <div class="wrapper my-auto ml-auto ml-lg-4">
                  <canvas height="50" width="100" id="stats-line-graph-2"></canvas>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 mt-md-0 mt-4">
              <div class="d-flex">
                <div class="wrapper">
                  <h3 class="mb-0 font-weight-semibold">7,688</h3>
                  <h5 class="mb-0 font-weight-medium text-primary">Conversation</h5>
                  <p class="mb-0 text-muted">+57.62(+0.76%)</p>
                </div>
                <div class="wrapper my-auto ml-auto ml-lg-4">
                  <canvas height="50" width="100" id="stats-line-graph-3"></canvas>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 mt-md-0 mt-4">
              <div class="d-flex">
                <div class="wrapper">
                  <h3 class="mb-0 font-weight-semibold">1,553</h3>
                  <h5 class="mb-0 font-weight-medium text-primary">Downloads</h5>
                  <p class="mb-0 text-muted">+138.97(+0.54%)</p>
                </div>
                <div class="wrapper my-auto ml-auto ml-lg-4">
                  <canvas height="50" width="100" id="stats-line-graph-4"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<h2 class="text-center"> QUE DESIREZ-VOUS RECUPERER ?</h2>
  <div>
    <ul>
      @foreach ($categorie as $categories)
        <h6 class="dropdown-header"> <b>{{ $categories->libelle_type }}</b> </h6>
        @foreach ($monnaie as $monnaies)
          @if ($monnaies->type_id === $categories->id)
            <li>  
              <a class="dropdown-item" id="coin_enter" data-toggle="modal" data-target="#coin" href="{{ $monnaies->id }}"> 
                <img src="{{ $monnaies->image }}" height="40px;" width="40px;" style="border-radius: 20px;" alt=""> 
                {{ $monnaies->libelle }}  
              </a>
            </li>
            <hr>
          @endif
        @endforeach
      @endforeach
    </ul>
  </div>

  <div class="modal fade" id="coin">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"> PAR QUEL MOYEN ? </h4>
          <button type="button" class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <ul>
            <li id="coint_out">Envoie : {{ request('id') }} </li>
            @foreach ($categorie as $categories)
            <h6 class="dropdown-header"> <b>{{ $categories->libelle_type }}</b> </h6>
            @foreach ($monnaie as $monnaies)
              @if ($monnaies->type_id === $categories->id)
                <li>  
                  <a class="dropdown-item" data-toggle="modal" data-target="#infos" href="{{ route('page_prices',$monnaies->id) }}"> 
                    <img src="{{ $monnaies->image }}" height="40px;" width="40px;" style="border-radius: 20px;" alt=""> 
                    {{ $monnaies->libelle }}  
                  </a>
                </li>
                <hr>
              @endif
            @endforeach
          @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>

@endsection