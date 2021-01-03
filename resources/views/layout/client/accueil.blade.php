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
  <a href="{{ route('link_prices') }}" class="btn btn-outline-primary"> Prices</a>

  

  <h3> FORMULAIRE DE CHANGE  </h3>

<form class="forms-sample" action="" method="POST">
    @csrf
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <select name="send" class="form-control" required>
                        <option value=""> Ce que j'envoie</option>
                            @foreach ($monnaie as $monnaies)
                                <option value="">  {{ $monnaies->libelle }} </option>
                            @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <select name="send" class="form-control" required>
                        <option value=""> Ce que je reçois </option>
                        <option value=""></option>
                        <option value=""></option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    
    <div class="row">
        <div class="col-md-4">
        </div>
        <div class="col-md-7">
            <button type="submit" class="btn btn-danger mr-2"> Valider </button>
        </div>
        <div class="col-md-1">
        </div>
    </div>
  </form>

@endsection