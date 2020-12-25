 <!-- partial:partials/_navbar.html -->
 <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
      <a class="navbar-brand brand-logo" href="#">
        SEAL CHANGE </a>
      <a class="navbar-brand brand-logo-mini" href="#">
        S </a>
    </div>
    
    <div class="navbar-menu-wrapper d-flex align-items-center">
      <form class="ml-auto search-form d-none d-md-block" action="#">
        <div class="form-group">
          <input type="search" class="form-control" placeholder="Search Here">
        </div>
      </form>
      <ul class="navbar-nav ml-auto">
          <li class="nav-item font-weight-semibold d-none d-lg-block"> A propos </li>
          <li class="nav-item font-weight-semibold d-none d-lg-block"> Service </li>
          <li class="nav-item font-weight-semibold d-none d-lg-block"> Contact </li>
        <li class="nav-item dropdown d-none d-xl-inline-block user-dropdown">
          <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
            <img class="img-xs rounded-circle" src="AdminTemplate/assets/images/user.png" alt="Profile image"> </a>
          <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
            <div class="dropdown-header text-center">
              <img class="img-md rounded-circle" src="AdminTemplate/assets/images/user.png" alt="Profile image">
              <p class="mb-1 mt-3 font-weight-semibold"> Utilisateur </p>
              <p class="font-weight-light text-muted mb-0"> {{ auth()->user()->email }} </p>
            </div>
            <a class="dropdown-item" href="{{ route('profile') }}"> Mon profil</a>
            <a class="dropdown-item" href="{{ route('logout') }}"> Déconnexion <i class="dropdown-item-icon ti-power-off"></i></a>
          </div>
        </li>
      </ul>
      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
        <span class="mdi mdi-menu"></span>
      </button>
    </div>
  </nav>