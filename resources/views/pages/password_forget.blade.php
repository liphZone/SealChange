@section('title','Mot de passe oublié')
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

                  <h4 class="text-center"> Reinitialiser votre mot de passe </h4>
                  <p> <h4> Mot de passe généré : <span style="background-color: green;"> {{ request('pwd') }} </span> </h4> </p>
                  <p> <h4> Veuillez copier et utiliser le mot de passe ci-dessus </h4> </p>
                  <p> vous pouvez toutefois le modifier après être connecté</p>
                  <form action="{{ route('action_password_forget_two') }}" method="POST">
                    @csrf
                    <div class="form-group">
                      <div class="input-group">
                        <input hidden type="text" name="user" value="{{ request('user') }}" readonly id="">
                          <input type="password" class="form-control" name="password" placeholder="Saisissez le mot de passe" required>
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
                      <button class="btn btn-primary submit-btn btn-block"> Valider </button>
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