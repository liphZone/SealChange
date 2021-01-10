@extends('layout.client.index')
@section('content')
@section('title','transaction')
<link rel="stylesheet" href="{{ asset('IntInputTel/build/css/intlTelInput.css') }}">

<form class="forms-sample" action="{{ route('action_deal') }}" method="POST">
  @csrf
    <div class="form-group">
      <input hidden type="text" class="form-control" name="coin_enter" value="{{ request('id') }}" readonly>
    </div>

    <div class="form-group">
        <label> COMMENT VOULEZ-VOUS RECEVOIR? </label>
        <select class="form-control" name="coin_out">
            @foreach ($categorie as $categories)
                @foreach ($monnaie as $monnaies)
                    @if ($monnaies->type_id === $categories->id)
                        <option value="{{ $monnaies->id }}"> {{ $monnaies->libelle }} </option>
                    @endif
                @endforeach
            @endforeach
        </select>
        @error('coin_out')
            <div style="color: red;"> {{ $message }} </div>
        @enderror
    </div>

    <div class="form-group">
        <label for=""> Saisir le montant </label>
        <input type="number" min="1" class="form-control" name="montant" value="{{ old('montant') }}" required>
        @error('montant')
            <div style="color: red;"> {{ $message }} </div>
        @enderror
    </div>

    <label for=""> Contact </label>
        <div class="form-group">
        <input type="tel" class="form-control" id="phone" name="telephone" required>
        @error('telephone')
            <div style="color: red;"> {{ $message }} </div>
        @enderror
    </div>
    <button type="submit" class="btn btn-success btn-block mr-2"> Opérer </button>
</form>

  <script src="{{ asset('IntInputTel/build/js/intlTelInput.js') }}"></script>
  <script>
     
    var input = document.querySelector("#phone");
    window.intlTelInput(input, {
      // allowDropdown: false,
      // autoHideDialCode: false,
      // autoPlaceholder: "off",
      // dropdownContainer: document.body,
      // excludeCountries: ["us"],
      // formatOnDisplay: false,
      // geoIpLookup: function(callback) {
      //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
      //     var countryCode = (resp && resp.country) ? resp.country : "";
      //     callback(countryCode);
      //   });
      // },
      // hiddenInput: "full_number",
      // initialCountry: "auto",
      // localizedCountries: { 'de': 'Deutschland' },
      // nationalMode: false,
      // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
      // placeholderNumberType: "MOBILE",
      // preferredCountries: ['cn', 'jp'],
      // separateDialCode: true,
      utilsScript: "/IntInputTel/build/js/utils.js",
    });
  </script>
@endsection