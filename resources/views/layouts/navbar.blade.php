    <div class="container-fluid bg-light position-relative shadow">
      <nav
        class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0 px-lg-5"
      >
        <a
          href=""
          class="navbar-brand font-weight-bold text-secondary"
          style="font-size: 50px"
        >
          <i class="flaticon-043-teddy-bear color-info" style=""></i>
          <span class="text-primary">Nom</span>
        </a>
        <button
          type="button"
          class="navbar-toggler"
          data-toggle="collapse"
          data-target="#navbarCollapse"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div
          class="collapse navbar-collapse justify-content-between"
          id="navbarCollapse"
        >
          <div class="navbar-nav font-weight-bold mx-auto py-0">
            <a href="{{ route('page.home') }}" class="nav-item nav-link active">Accueil</a>
            <a href="{{ route('page.classes') }}" class="nav-item nav-link">Nos classes</a>
            <a href="{{ route('page.teachers') }}" class="nav-item nav-link">Nos enseignants</a>
            <a href="{{ route('page.partners') }}" class="nav-item nav-link">Nos partenaires</a>
            <a href="" class="nav-item nav-link">Gallerie</a>
            <a href="" class="nav-item nav-link">Activités</a>
            <div class="nav-item dropdown">
              <a
                href="#"
                class="nav-link dropdown-toggle"
                data-toggle="dropdown"
                >L'école</a
              >
              <div class="dropdown-menu rounded-0 m-0">
                <a href="" class="dropdown-item">Présentation de l'école</a>
                <a href="{{ route('page.events') }}" class="dropdown-item">Nos événements</a>
              </div>
            </div>
            <a href="{{ route('page.contact') }}" class="nav-item nav-link">Contact</a>
            
           
          </div>
            @auth
                <a href="{{ route('dashboard')}}" class="nav-item nav-link"><i class="fa-solid fa-user primary"></i> {{ Auth::user()->login }}</a>
                <form id="logout-form" class="nav-item nav-link" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-sm btn-danger"><small>Se déconnecter</small></button> 
                </form>
            @else
                <a  href="{{ route('login') }}" class="nav-item nav-link">Connexion</a>
                <a href="{{ route('availableappointments') }}" class="nav-item nav-link btn btn-primary px-4">Prenez rendez-vous</a>
            @endauth
        </div>
      </nav>
    </div>