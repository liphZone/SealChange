@section('title','Inscription')
<!DOCTYPE html>
<html lang="en">
@include('layout.client.partials.head')
  <body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
          <div class="content-wrapper d-flex align-items-center auth register-bg-1 theme-one">
            <div class="row w-100">
              <div class="col-lg-4 mx-auto">
                <h2 class="text-center mb-4">Inscription</h2>
                <div class="auto-form-wrapper">
                  <form action="{{ route('action_register') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" name="nom" placeholder="Nom" required>
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="mdi mdi-check-circle-outline"></i>
                                </span>
                            </div>
                        </div>
                        @error('nom')
                            <div style="color: red;"> {{ $message }} </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" name="prenom" placeholder="Prénom(s)" required>
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="mdi mdi-check-circle-outline"></i>
                                </span>
                            </div>
                        </div>
                        @error('prenom')
                            <div style="color: red;"> {{ $message }} </div>
                        @enderror
                    </div>
                
                    <div class="form-group">
                        <div class="input-group">
                            <input type="email" class="form-control" name="email" placeholder="Votre adresse mail" required>
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="mdi mdi-check-circle-outline"></i>
                                </span>
                            </div>
                        </div>
                        @error('email')
                            <div style="color: red;"> {{ $message }} </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <input type="password" class="form-control" name="password" placeholder="Mot de passe" required>
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="mdi mdi-check-circle-outline"></i>
                                </span>
                            </div>
                        </div>
                        @error('password')
                            <div style="color: red;"> {{ $message }} </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <input type="password" class="form-control" name="password_confirmation" placeholder="Confirmation du mot de passe" required>
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="mdi mdi-check-circle-outline"></i>
                                </span>
                            </div>
                        </div>
                        @error('password_confirmation')
                            <div style="color: red;"> {{ $message }} </div>
                        @enderror
                    </div>
                   
                    <div class="form-group">
                      <button class="btn btn-primary submit-btn btn-block"> S'inscrire </button>
                    </div>
                    <div class="text-block text-center my-3">
                      <span class="text-small font-weight-semibold">Vous avez déjà un compte ?</span>
                      <a href="{{ route('form_login') }}" class="text-black text-small">Connexion</a>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
      </div>
        <script src="//code.jquery.com/jquery.js"></script>
        @include('flashy::message')

    @include('layout.client.partials.scriptjs')
  </body>
</html>