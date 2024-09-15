@extends('layouts.template')

@section('content')

<!-- Header Start -->
<div class="container-fluid bg-primary mb-5">
  <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
    <h3 class="display-3 font-weight-bold text-white">Le Jardin Des Enfants</h3>
    <div class="d-inline-flex text-white">
      <p class="m-0"><a class="text-white" href="/">Accueil</a></p>
      <p class="m-0 px-2">/</p>
      <p class="m-0">Présentation</p>
    </div>
  </div>
</div>
<!-- Header End -->

<!-- Présentation Start -->
<div class="container-fluid py-5">
  <div class="container">
    <div class="text-center pb-4">
      <p class="section-title px-5"><span class="px-2">Notre École</span></p>
      <h1 class="mb-4">Un Environnement d'Apprentissage Amical et Stimulant</h1>
    </div>
    
    <!-- Historique Start -->
    <div class="row mb-5">
      <div class="col-md-12">
        <div class="card h-100 shadow-lg border-0 rounded">
          <div class="card-body text-center">
            <h5 class="card-title font-weight-bold">Notre Historique</h5>
            <p class="card-text">Depuis sa création en 2001, Le Jardin Des Enfants s'est consacré à fournir un environnement éducatif de haute qualité pour les jeunes enfants. Fondée avec la mission de soutenir le développement intégral des tout-petits, notre école a évolué pour répondre aux besoins divers et croissants des familles. Nous avons mis en place des programmes enrichissants qui favorisent l'exploration, la créativité et l'apprentissage autonome dans un cadre chaleureux et sécurisé.</p>

<p class="card-text">Au fil des années, nous avons renforcé notre engagement envers l'excellence éducative en adaptant notre approche pédagogique aux avancées en matière de développement précoce. Nos enseignants qualifiés et passionnés travaillent chaque jour pour offrir une expérience d'apprentissage stimulante qui prépare les enfants à réussir dans les prochaines étapes de leur parcours éducatif. Le Jardin Des Enfants est fier de son héritage et continue de se développer pour offrir aux nouvelles générations un lieu où elles peuvent s'épanouir et créer des souvenirs précieux.</p>          </div>
        </div>
      </div>
    </div>
    <!-- Historique End -->
    
    <!-- Valeurs Start -->
    <div class="row mb-5">
      <div class="col-md-12">
        <div class="card h-100 shadow-lg border-0 rounded">
          <div class="card-body text-center">
            <h5 class="card-title font-weight-bold">Nos Valeurs</h5>
            <ul class="list-unstyled">
              <li><i class="fa fa-check-circle text-primary"></i> Bien-être des enfants</li>
              <li><i class="fa fa-check-circle text-primary"></i> Créativité et imagination</li>
              <li><i class="fa fa-check-circle text-primary"></i> Apprentissage par le jeu</li>
              <li><i class="fa fa-check-circle text-primary"></i> Inclusion et respect</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- Valeurs End -->
    
    <!-- Activités Start -->
    <div class="row mb-5">
      <div class="col-md-12">
        <div class="card h-100 shadow-lg border-0 rounded">
          <div class="card-body text-center">
            <h5 class="card-title font-weight-bold">Nos Activités</h5>
            <p class="card-text">Nous proposons une gamme d'activités adaptées aux jeunes enfants, y compris des jeux éducatifs, des ateliers créatifs, et des activités en plein air. Nos programmes sont conçus pour encourager le développement des compétences sociales, émotionnelles et cognitives.</p>
          </div>
        </div>
      </div>
    </div>
    <!-- Activités End -->
    
    <!-- Installations Start -->
    <div class="row mb-5">
      <div class="col-md-12">
        <div class="card h-100 shadow-lg border-0 rounded">
          <div class="card-body text-center">
            <h5 class="card-title font-weight-bold">Nos Installations</h5>
            <p class="card-text">Notre école maternelle est équipée de salles de classe colorées, d'aires de jeux sécurisées, et d'espaces de détente. Nous mettons un point d'honneur à offrir un environnement sûr et stimulant pour chaque enfant.</p>
          </div>
        </div>
      </div>
    </div>
    <!-- Installations End -->
    
    <!-- Contact Start -->
    <div class="row">
      <div class="col-md-12">
        <div class="card h-100 shadow-lg border-0 rounded">
          <div class="card-body text-center">
            <h5 class="card-title font-weight-bold">Nous Contacter</h5>
            <p class="card-text">Pour toute question ou pour planifier une visite, veuillez nous contacter :</p>
            <p class="card-text font-weight-bold">Téléphone : +33 1 23 45 67 89</p>
            <p class="card-text font-weight-bold">Email : contact@ljde.com</p>
            <a href="{{ route('page.contact') }}" class="btn btn-primary">Contactez-nous</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Contact End -->
    
  </div>
</div>
<!-- Présentation End -->

@endsection

@section('css')
<style>
  .card-img-top {
    height: 200px;
    object-fit: cover;
  }
  .section-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: #333;
    border-bottom: 2px solid #ffc107; /* Couleur pour l'école maternelle */
    padding-bottom: 10px;
    margin-bottom: 20px;
  }
  .btn-primary {
    background-color: #ffc107; /* Jaune pour l'école maternelle */
    border-color: #ffc107;
  }
  .btn-primary:hover {
    background-color: #e0a800;
    border-color: #d39e00;
  }
  .card {
    transition: transform 0.3s ease-in-out;
  }
  .card:hover {
    transform: translateY(-5px);
  }
  .card-body h5, .card-body h6 {
    margin-bottom: 10px;
  }
  .card-body p {
    margin-bottom: 0;
  }
  .list-unstyled li {
    margin-bottom: 10px;
  }
</style>
@endsection
