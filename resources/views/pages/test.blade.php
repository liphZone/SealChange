@extends('layout.client.index')
@section('content')
@section('title','TEST')

<form class="forms-sample" action="{{ route('action_test') }}" method="POST">
    @csrf

    {{-- <div class="form-group">
        <label for=""> De : </label>
        <select class="form-control" name="from" id="">
            <option value="USD"> Dollar </option>
            <option value="EUR"> Euro </option>
        </select>
        @error('from')
            <div style="color: red;"> {{ $message }} </div>
        @enderror
    </div>

    <div class="form-group">
        <label for=""> EN : </label>
        <select class="form-control" name="to" id="">
            <option value="USD"> Dollar </option>
            <option value="EUR"> Euro </option>
        </select>
        @error('to')
            <div style="color: red;"> {{ $message }} </div>
        @enderror
    </div> --}}

{{--     
    <div class="form-group">
        <label for=""> Saisir le montant </label>
        <input type="number" min="1" class="form-control" name="amount" required>
        @error('amount')
            <div style="color: red;"> {{ $message }} </div>
        @enderror
    </div> --}}

    <button type="submit" class="btn btn-success btn-block mr-2"> Opérer </button>
</form>

@endsection