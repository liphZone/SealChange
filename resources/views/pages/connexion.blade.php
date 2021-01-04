@section('title','Connexion')
<!DOCTYPE html>
<html lang="en">
 @include('layout.client.partials.head')
  <body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
          <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
            <div class="row w-100">
              <div class="col-lg-4 mx-auto">
                <div class="auto-form-wrapper">
                    <h4 class="text-center"> Connectez-vous </h4>
                  <form action="{{ route('action_login') }}" method="POST">
                    @csrf
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
                      <button class="btn btn-primary submit-btn btn-block">Connexion</button>
                    </div>
                    <div class="form-group d-flex justify-content-between">
                      {{-- <div class="form-check form-check-flat mt-0">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input" checked> Keep me signed in </label>
                      </div> --}}
                      <a href="{{ route('form_password_forget') }}" class="text-small forgot-password text-black">Mot de passe oublié ?</a>
                    </div>
                    {{-- <div class="form-group">
                      <button class="btn btn-block g-login">
                        <img class="mr-3" src="../../../assets/images/file-icons/icon-google.svg" alt="">Log in with Google</button>
                    </div> --}}
                    <div class="text-block text-center my-3">
                      {{-- <span class="text-small font-weight-semibold">Not a member ?</span> --}}
                      <a href="{{ route('form_register') }}" class="text-black text-small">Créer un compte</a>
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