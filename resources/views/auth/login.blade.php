@extends('layouts.template')

@section('title', 'Titre de la Page') <!-- Définition du titre -->

@section('content')
<!-- Header Start -->
<div class="container-fluid bg-primary mb-5">
      <div
        class="d-flex flex-column align-items-center justify-content-center"
        style="min-height: 400px"
      >
        <h3 class="display-3 font-weight-bold text-white">Connectez-vous</h3>
        <div class="d-inline-flex text-white">
          <p class="m-0"><a class="text-white" href="{{ route('home') }}">Accueil</a></p>
          <p class="m-0 px-2">/</p>
          <p class="m-0">Accedez à votre espace personnel</p>
        </div>
      </div>
    </div>
    <!-- Header End -->

  <!-- contact section -->
  <div class="container-fluid pt-5 mt-5">
      <div class="container border col-6 p-2 shadow" style="height:400px">
        <div class="text-center pb-2">
          <p class="section-title px-5 mt-5 mb-5">
            <span class="px-2">Connexion</span>
          </p>
        </div>
        <div class="row flex justify-content-center mt-4">
          <div class="col-lg-8 mb-5">
            <div class="contact-form">
              <div id="success"></div>
              <form name="{{ route('login') }}" method="POST">
              @csrf
                <div class="control-group">
                  <input
                    type="email"
                    class="form-control"
                    id="email"
                    name="email"
                    placeholder="Votre Email"
                    required="required"
                    data-validation-required-message="Please enter your email"
                  />
                  <p class="help-block text-danger"></p>
                </div>
                <div class="control-group">
                  <input
                    type="password"
                    class="form-control"
                    id="password"
                    name="password"
                    placeholder="mot de passe"
                    required="required"
                    data-validation-required-message="Entrez votre mot de passe"
                  />
                  <p class="help-block text-danger"></p>
                </div>
                <div class="mt-5 mb-3">
                  <button
                    class="btn btn-primary py-2 px-4 "
                    type="submit"
                    id="sendMessageButton"
                  >
                    Envoyez
                  </button>
                </div>
                @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    mot de passe oublié ?
                </a>
            @endif
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>



  <!-- end contact section -->

@endsection



