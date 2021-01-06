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
                      <a href="#" type="button" data-toggle="modal" data-target="#pwd" class="btn btn-light"
                       class="text-small forgot-password text-black">Mot de passe oublié ?</a>
                    </div>
                    <div class="text-block text-center my-3">
                      <a href="{{ route('form_register') }}" style="text-decoration: none;" class="text-black text-small">Créer un compte</a>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <div class="modal fade" id="pwd" style="margin-top: 10%;">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title"> Mot de passe oublié ?</h4>
                    <button type="button" class="close" data-dismiss="modal">
                      <span>&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form action="{{ route('action_password_forget_one') }}" method="POST">
                      @csrf
                      <div class="form-group">
                        <div class="input-group">
                            <input type="email" class="form-control" name="email" placeholder="Saisissez votre adresse mail" required>
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
                      <button class="btn btn-primary submit-btn btn-block">Valider</button>
                    </form>
                  </div>
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