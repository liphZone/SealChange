@extends('layout.client.index')
@section('content')
@section('title','Accueil')

<h3> FORMULAIRE DE CHANGE  </h3>


<form class="forms-sample" action="" method="POST">
    @csrf
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <select name="send" class="form-control" required>
                        <option value=""> Ce que j'envoie</option>
                        <option value=""></option>
                        <option value=""></option>
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