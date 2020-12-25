<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item nav-profile">
        <a href="{{ route('logout') }}" class="nav-link">
          <div class="profile-image">
            <img class="img-xs rounded-circle" src="{{ asset('AdminTemplate/assets/images/user.png') }}" alt="profile image">
            <div class="dot-indicator bg-success"></div>
          </div>
          <div class="text-wrapper">
            <p class="designation">Se Déconnecter</p>
          </div>
        </a>
      </li>

      <li class="nav-item nav-category"> Menu Principal </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('accueil_admin') }}">
          <i class="menu-icon typcn typcn-document-text"></i>
          <span class="menu-title"> <i class="fa fa-dashboard"></i> Accueil </span> 
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#Administrateurs" aria-expanded="false" aria-controls="Administrateurs">
          <i class="menu-icon typcn typcn-coffee"></i>
          <span class="menu-title"> <i class="fa fa-users"></i> Administrateurs </span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="Administrateurs">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item">
              <a class="nav-link" href="#"> <i class="fa fa-plus"></i> &nbsp;  Ajouter administrateur </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#"> <i class="fa fa-list-ul"></i> &nbsp; Liste des administrateurs </a>
            </li>
          </ul>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#Monnaies" aria-expanded="false" aria-controls="Monnaies">
          <i class="menu-icon typcn typcn-coffee"></i>
          <span class="menu-title"> <i class="fa fa-money"></i> Monnaies </span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="Monnaies">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('add_coin') }}"> <i class="fa fa-plus"></i> &nbsp;  Nouvelle monnaie </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('add_type') }}"> <i class="fa fa-plus"></i> &nbsp;  Ajouter une catégorie </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('list_coins') }}"> <i class="fa fa-list-ul"></i> &nbsp; Liste des monnaies </a>
            </li>
          </ul>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="menu-icon typcn typcn-document-text"></i>
          <span class="menu-title"> <i class="fa fa-history"></i> Historique </span>
        </a>
      </li>
    </ul>
  </nav>