    <div class="container-fluid bg-light position-relative shadow">
      <nav
        class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0 px-lg-5"
      >
        <a
          href="{{ route('page.home') }}"
          class="navbar-brand font-weight-bold text-secondary"
        >  
        <img src="{{ asset('logo/logo-ljde.png') }}" alt="Logo" width="150" height="auto" class="mb-3 mt-1">

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
            <a href="{{ route('page.us-teachers') }}" class="nav-item nav-link">Nos enseignants</a>
            <a href="{{ route('page.about') }}" class="nav-item nav-link">A propos</a>
            <a href="{{ route('page.events') }}" class="nav-item nav-link">Nos événements</a>
            <a href="" class="nav-item nav-link">Gallerie</a>            
            <a href="{{ route('page.contact') }}" class="nav-item nav-link">Contact</a>
            <a href="{{ route('page.partners') }}" class="nav-item nav-link">Nos partenaires</a>          
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