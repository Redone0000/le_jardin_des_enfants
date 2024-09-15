@extends('layouts.template')

@section('title', 'accueil')

@section('content')
<!-- Header Start -->
<div class="container-fluid bg-info p-5 px-0 px-md-5 mb-5 shadow">
    <div class="row align-items-center px-3">
    <div class="col-lg-6 text-center text-lg-left p-3">
        <h4 class="text-white mb-4 mt-5 mt-lg-0">Le Jardin Des Enfants</h4>
        <!-- <h3 class="display-4 font-weight-bold text-white"> -->
        <h1 class="font-weight-bold text-secondary">
        Nouvelle approche de l'éducation de l'<span class="text-secondary">enfant</span>
        </h1>
        <p class="text-white mb-4">
            Bienvenue au Jardin Des Enfants, un lieu où l'apprentissage et le jeu se rencontrent 
            pour créer une expérience éducative engageante pour les jeunes enfants. Notre école 
            maternelle est conçue pour inspirer la créativité, favoriser la curiosité et encourager 
            l'amour de l'apprentissage dès le plus jeune âge.
        </p>
        <a href="{{ route('page.about') }}" class="btn btn-secondary mt-1 py-3 px-5">Lire plus</a>
    </div>
    <div class="col-lg-6 text-center text-lg-right">
        <img class="img-fluid mt-5" src="{{ asset('pictures/hero.png') }}" alt="" />
    </div>
    </div>
</div>
<!-- Header End -->

<!-- Facilities Start -->
<div class="container-fluid pt-5">
    <div class="container pb-3">
    <div class="row">
        <div class="col-lg-4 col-md-6 pb-1">
        <div
            class="d-flex bg-light shadow-sm border-top rounded mb-4"
            style="padding: 30px; height: 200px;"
        >
            <i
            class="flaticon-050-fence h1 font-weight-normal text-primary mb-3"
            ></i>
            <div class="pl-4">
            <h4>Cour de récréation</h4>
            <p class="m-0">
            Notre cour de récréation est un lieu où les enfants s'épanouissent, 
            explorent et créent des souvenirs inoubliables.
            </p>
            </div>
        </div>
        </div>
        <div class="col-lg-4 col-md-6 pb-1">
        <div
            class="d-flex bg-light shadow-sm border-top rounded mb-4"
            style="padding: 30px; height: 200px;"
        >
            <i
            class="flaticon-022-drum h1 font-weight-normal text-primary mb-3"
            ></i>
            <div class="pl-4">
            <h4>Musique et Danse</h4>
            <p class="m-0">
            Les enfants découvrent leurs talents artistiques à travers des ateliers 
            de musique et de danse, renforçant confiance en soi et créativité.
            </p>
            </div>
        </div>
        </div>
        <div class="col-lg-4 col-md-6 pb-1">
        <div
            class="d-flex bg-light shadow-sm border-top rounded mb-4"
            style="padding: 30px; height: 200px;"
        >
            <i
            class="flaticon-030-crayons h1 font-weight-normal text-primary mb-3"
            ></i>
            <div class="pl-4">
            <h4>Activités artistiques</h4>
            <p class="m-0">
            Nous encourageons les enfants à explorer leur créativité à travers une variété d'activités artistiques.
            </p>
            </div>
        </div>
        </div>
        <div class="col-lg-4 col-md-6 pb-1">
        <div
            class="d-flex bg-light shadow-sm border-top rounded mb-4"
            style="padding: 30px; height: 200px;"
        >
            <i
            class="flaticon-017-toy-car h1 font-weight-normal text-primary mb-3"
            
            ></i>


            <div class="pl-4">
            <h4>Arrivée des Enfants</h4>
            <p class="m-0">
            Nous disposons d'une zone dédiée pour que les parents déposent 
            leurs enfants en toute sécurité, assurant une arrivée fluide.
            </p>
            </div>
        </div>
        </div>
        <div class="col-lg-4 col-md-6 pb-1">
        <div
            class="d-flex bg-light shadow-sm border-top rounded mb-4"
            style="padding: 30px; height: 200px;"
        >
            <i
            class="flaticon-025-sandwich h1 font-weight-normal text-primary mb-3"
            ></i>
            <div class="pl-4">
            <h4>Nourriture saine </h4>
            <p class="m-0">
            Nous privilégions une alimentation équilibrée et nutritive pour soutenir 
            la santé et le bien-être de nos élèves.
            </p>
            </div>
        </div>
        </div>
        <div class="col-lg-4 col-md-6 pb-1">
        <div
            class="d-flex bg-light shadow-sm border-top rounded mb-4"
            style="padding: 30px; height: 200px;"
        >
            <i
            class="flaticon-047-backpack h1 font-weight-normal text-primary mb-3"
            ></i>
            <div class="pl-4">
            <h4>Visites éducatives</h4>
            <p class="m-0">
            Nos visites éducatives offrent aux enfants une expérience immersive 
            où ils découvrent le monde qui les entoure.
            </p>
            </div>
        </div>
        </div>
    </div>
    </div>
</div>
<!-- Facilities End -->


<!-- About Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <p class="section-title pr-5">
                    <span class="pr-2">L'école Titre</span>
                </p>
                <h3 class="mb-4">Cultiver une Éducation Inclusive et Engagée</h3>
                <p>
                Nous accueillons, à Nom ecole, des enfants dès 2½ ans accomplis, 
                de toute origine culturelle, sociale, philosophique,… Nos enseignants ont pour différentes missions 
                d’amener votre enfant le plus loin possible dans ses connaissances, dans son autonomie, sa créativité, 
                la connaissance de soi, le respect des autres, de l’environnement, à être dans la société dans laquelle 
                il vit.
                </p>
                <div class="row pt-2 pb-4">
                    <div class="col-6 col-md-4">
                        <img class="img-fluid rounded" src="pictures/about-2.jpg" alt="" />
                    </div>
                    <div class="col-6 col-md-8">
                        <ul class="list-inline m-0">
                            <li class="py-2 border-top border-bottom">
                            <i class="fa fa-check text-primary mr-3"></i>Encadrement de qualité.
                            </li>
                            <li class="py-2 border-bottom">
                            <i class="fa fa-check text-primary mr-3"></i>Programmes éducatifs variés.
                            </li>
                            <li class="py-2 border-bottom">
                            <i class="fa fa-check text-primary mr-3"></i>Environnement d'apprentissage stimulant.
                            </li>
                        </ul>
                    </div>
                </div>
                <a href="" class="btn btn-primary mt-2 py-2 px-4">Voir plus</a>
            </div>
            <div class="col-lg-5">
            <img
                class="img-fluid rounded mb-3 mb-lg-0" width="100%"
                src="pictures/classe.jpg"
                alt=""
            />
            </div>
        </div>
    </div>
</div>
<!-- About End -->

<!-- Class Start -->
<div class="container-fluid pt-5">
    <div class="container">
    <div class="text-center pb-2">
        <p class="section-title px-5">
        <span class="px-2">Niveau maternel</span>
        </p>
        <h1 class="mb-4">Nos classes</h1>
    </div>
    <div class="row">
        <div class="col-lg-3 mb-5" style="height: 500px;">
        <div class="card border-0 bg-light shadow-sm pb-2">
            <img class="card-img-top mb-2" src="pictures/class-1.jpg" alt="" />
            <div class="card-body text-center">
                <h5 class="card-title">Classe d'Accueil</h5>
                <p class="card-text">
                Conçue pour les tout-petits âgés de 2 ans. 
                C'est un environnement chaleureux et stimulant où les enfants peuvent commencer leur parcours éducatif.
                </p>
            </div>
            <div class="card-footer bg-transparent py-4 px-5">
                <div class="row border-bottom">
                    <div class="col-6 py-1 text-left border-right">
                    <strong>Age</strong>
                    </div>
                    <div class="col-6 py-1">2 - 3 ans</div>
                </div>
                <div class="row border-bottom">
                    <div class="col-6 py-1 text-left border-right">
                    <strong>Places</strong>
                    </div>
                    <div class="col-6 py-1">15</div>
                </div>
                <div class="row border-bottom">
                    <div class="col-6 py-1 text-left border-right">
                    <strong>Horraires</strong>
                    </div>
                    <div class="col-6 py-1">08:00 - 15:00</div>
                </div>          
            </div>
        </div>
        </div>
        <div class="col-lg-3 mb-5" style="height: 500px;">
        <div class="card border-0 bg-light shadow-sm pb-2">
            <img class="card-img-top mb-2" src="pictures/class-2.jpg" alt="" />
            <div class="card-body text-center">
            <h5 class="card-title">Première Maternelle</h5>
            <p class="card-text">
            Dédiée aux enfants de 3 ans, elle offre un environnement enrichissant où ils peuvent explorer, jouer et apprendre sous la guidance de nos enseignants dévoués.
            </p>
            </div>
            <div class="card-footer bg-transparent py-4 px-5">
            <div class="row border-bottom">
                <div class="col-6 py-1 text-left border-right">
                <strong>Age</strong>
                </div>
                <div class="col-6 py-1">3 - 4 ans</div>
            </div>
            <div class="row border-bottom">
                <div class="col-6 py-1 text-left border-right">
                <strong>Places</strong>
                </div>
                <div class="col-6 py-1">15</div>
            </div>
            <div class="row border-bottom">
                <div class="col-6 py-1 text-left border-right">
                <strong>Class Time</strong>
                </div>
                <div class="col-6 py-1">08:00 - 15:00</div>
            </div>
            </div>
        </div>
        </div>
        <div class="col-lg-3 mb-5" style="height: 500px;">
        <div class="card border-0 bg-light shadow-sm pb-2">
            <img class="card-img-top mb-2" src="pictures/class-3.jpg" alt="" />
            <div class="card-body text-center">
            <h5 class="card-title">Deuxième Maternelle</h5>
            <p class="card-text">
            La Deuxième Maternelle accueille les enfants âgés de 4 ans. Dans cet environnement 
            stimulant, ils sont encouragés à explorer, à interagir et à apprendre.
            </p>
            </div>
            <div class="card-footer bg-transparent py-4 px-5">
                <div class="row border-bottom">
                    <div class="col-6 py-1 text-left border-right">
                    <strong>Age</strong>
                    </div>
                    <div class="col-6 py-1">4 - 5 ans</div>
                </div>
                <div class="row border-bottom">
                    <div class="col-6 py-1 text-left border-right">
                    <strong>Places</strong>
                    </div>
                    <div class="col-6 py-1">15</div>
                </div>
                <div class="row border-bottom">
                    <div class="col-6 py-1 text-left border-right">
                    <strong>Horraires</strong>
                    </div>
                    <div class="col-6 py-1">08:00 - 15:00</div>
                </div>
            </div>
        </div>
        </div>
        <div class="col-lg-3 mb-5" style="height: 550px;">
        <div class="card border-0 bg-light shadow-sm pb-2">
            <img class="card-img-top mb-2" src="pictures/class-3.jpg" alt="" />
            <div class="card-body text-center">
            <h5 class="card-title">Troisième Maternelle</h5>
            <p class="card-text">
            Pour les enfants de 5 à 6 ans, cette classe offre un cadre stimulant et interactif pour explorer, apprendre et se préparer pour l'école élémentaire.
            </p>
            </div>
            <div class="card-footer bg-transparent py-4 px-5">
                <div class="row border-bottom">
                    <div class="col-6 py-1 text-left border-right">
                    <strong>Age</strong>
                    </div>
                    <div class="col-6 py-1">5 - 6 ans</div>
                </div>
                <div class="row border-bottom">
                    <div class="col-6 py-1 text-left border-right">
                    <strong>Places</strong>
                    </div>
                    <div class="col-6 py-1">15</div>
                </div>
                <div class="row border-bottom">
                    <div class="col-6 py-1 text-left border-right">
                    <strong>Class Time</strong>
                    </div>
                    <div class="col-6 py-1">08:00 - 15:00</div>
                </div>
            </div>
        </div>
        </div>
    </div>
    </div>
</div>
<!-- Class End -->

<!-- Registration Start -->
<div class="container-fluid py-5">
    <div class="container">
    <div class="row align-items-start">
        <div class="col-lg-7 mb-5 mb-lg-0">
        <p class="section-title pr-5">
            <span class="pr-2">Inscription</span>
        </p>
        <h1 class="mb-4">Inscrivez votre enfant</h1>
        <p>
        Cliquez ci-dessous pour accéder à notre formulaire de prise de rendez-vous et inscrire 
        votre enfant à notre école maternelle. Nous sommes impatients de vous accueillir dans 
        notre communauté éducative et de vous accompagner dans ce merveilleux voyage d'apprentissage 
        et de croissance.
        </p>
        <ul class="list-inline m-0">
            <li class="py-2">
            <i class="fa fa-check text-success mr-3"></i>Un encadrement de qualité pour un apprentissage enrichissant.
            </li>
            <li class="py-2">
            <i class="fa fa-check text-success mr-3"></i>Des activités variées pour stimuler la curiosité et la créativité.
            </li>
            <li class="py-2">
            <i class="fa fa-check text-success mr-3"></i>Un environnement bienveillant favorisant le développement de chaque enfant.
            </li>
        </ul>
        <!-- <a href="" class="btn btn-primary mt-4 py-2 px-4">Book Now</a> -->
        <a href="" class="btn btn-primary mt-4 py-2 px-4">Prenez rendez-vous</a>
        </div>
        <div class="col-lg-5 mb-5 mb-lg-0">

        </div>
    </div>
    </div>
</div>
@endsection