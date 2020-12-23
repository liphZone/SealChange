@section('title','Mot de passe oublié')
<!DOCTYPE html>
<html lang="en">
 @include('layout.partials.head')
  <body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
          <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
            <div class="row w-100">
              <div class="col-lg-4 mx-auto">
                <div class="auto-form-wrapper">
                    <h4 class="text-center"> Reinitialiser votre mot de passe </h4>
                  <form action="" method="POST">
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
                  
                    <div class="form-group">
                      <button class="btn btn-primary submit-btn btn-block"> Envoyer </button>
                    </div>
                  
                  </form>
                </div>
               
                <p class="footer-text text-center">copyright © {{ date('Y') }} Bootstrapdash. All rights reserved.</p>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
      </div>
      <script src="//code.jquery.com/jquery.js"></script>
  @include('flashy::message')

    @include('layout.partials.scriptjs')
  </body>
 

</html>