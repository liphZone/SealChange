<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item nav-profile">
        <a href="{{ route('logout') }}" class="nav-link">
          <div class="profile-image">
            <img class="img-xs rounded-circle" src="admin/assets/images/user.png" alt="profile image">
            <div class="dot-indicator bg-success"></div>
          </div>
          <div class="text-wrapper">
            <p class="designation">Se Déconnecter</p>
          </div>
        </a>
      </li>

      <li class="nav-item nav-category"> Menu Principal </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('accueil') }}">
          <i class="menu-icon typcn typcn-document-text"></i>
          <span class="menu-title"> <i class="fa fa-dashboard"></i> Accueil </span> 
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="menu-icon typcn typcn-document-text"></i>
          <span class="menu-title"> <i class="fa fa-exchange"></i>  Convertir </span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="menu-icon typcn typcn-document-text"></i>
          <span class="menu-title"> <i class="fa fa-history"></i> Historique </span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="menu-icon typcn typcn-document-text"></i>
          <span class="menu-title"> <i class="fa fa-list-alt"></i> Liste Fieuls </span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="menu-icon typcn typcn-document-text"></i>
          <span class="menu-title"> <i class="fa fa-users"></i> Parrainage </span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
          <i class="menu-icon typcn typcn-coffee"></i>
          <span class="menu-title"> <i class="fa fa-check-square-o"></i> Mon compte </span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-basic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item">
              <a class="nav-link" href="#"> <i class="fa fa-list-ul"></i> &nbsp;  Liste des opérations </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#"> <i class="fa fa-address-card"></i> &nbsp; Bonus Referral </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('form_password_update') }}"> <i class="fa fa-gear"></i> &nbsp; Sécurité </a>
            </li>
          </ul>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="menu-icon typcn typcn-document-text"></i>
          <span class="menu-title"> <i class="fa fa-phone"></i> Support </span>
        </a>
      </li>

    </ul>
  </nav>