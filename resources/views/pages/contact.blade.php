@extends('layouts.template') 


@section('content')

<!-- Header Start -->
<div class="container-fluid bg-primary mb-5">
  <div
    class="d-flex flex-column align-items-center justify-content-center"
    style="min-height: 400px"
  >
    <h3 class="display-3 font-weight-bold text-white">Contactez-nous</h3>
    <div class="d-inline-flex text-white">
      <p class="m-0"><a class="text-white" href="">Accueil</a></p>
      <p class="m-0 px-2">/</p>
      <p class="m-0">Contact Us</p>
    </div>
  </div>
</div>
<!-- Header End -->

<!-- Contact Start -->
<div class="container-fluid pt-5">
  @if (session('success'))
      <div class="alert alert-success">
          {{ session('success') }}
      </div>
  @endif
  <div class="container">
    <div class="text-center pb-2">
      <h1 class="mb-4">Contactez-nous pour toute question</h1>
    </div>
    <div class="row justify-content-center">
      <div class="col-lg-5 mb-5">
        <div class="contact-form">
          <div id="success"></div>
          <form name="sentMessage" id="contactForm" novalidate="novalidate" method="post" action="{{ route('sendMailToAdmins') }}">
          @csrf
            <div class="control-group">
              <input
                type="text"
                class="form-control"
                id="nameSender"
                name="nameSender"
                placeholder="Votre nom"
                required="required"
                data-validation-required-message="Entrez votre nom"
              />
              <p class="help-block text-danger"></p>
            </div>
            <div class="control-group">
              <input
                type="email"
                class="form-control"
                id="emailSender"
                name="emailSender"
                placeholder="Votre Email"
                required="required"
                data-validation-required-message="Entrez votre email"
              />
              <p class="help-block text-danger"></p>
            </div>
            <div class="control-group">
              <input
                type="text"
                class="form-control"
                id="subject"
                name="subject"
                placeholder="Sujet"
                required="required"
                data-validation-required-message="Entrez un sujet"
              />
              <p class="help-block text-danger"></p>
            </div>
            <div class="control-group">
              <textarea
                class="form-control"
                rows="6"
                id="content"
                name="content"
                placeholder="Message"
                required="required"
                data-validation-required-message="Entrez un message"
              ></textarea>
              <p class="help-block text-danger"></p>
            </div>
            <div>
              <button
                class="btn btn-primary py-2 px-4"
                type="submit"
                id="sendMessageButton"
              >
                Envoyer
              </button>
            </div>
          </form>
        </div>
      </div>
      <div class="col-lg-5 mb-5 ml-3">
        <div class="d-flex">
          <i
            class="fa fa-map-marker-alt d-inline-flex align-items-center justify-content-center bg-primary text-secondary rounded-circle"
            style="width: 45px; height: 45px"
          ></i>
          <div class="pl-3">
            <h5>Adresse</h5>
            <p>Rue exemple 33, Bruxelles</p>
          </div>
        </div>
        <div class="d-flex">
          <i
            class="fa fa-envelope d-inline-flex align-items-center justify-content-center bg-primary text-secondary rounded-circle"
            style="width: 45px; height: 45px"
          ></i>
          <div class="pl-3">
            <h5>Email</h5>
            <p>info@example.com</p>
          </div>
        </div>
        <div class="d-flex">
          <i
            class="fa fa-phone-alt d-inline-flex align-items-center justify-content-center bg-primary text-secondary rounded-circle"
            style="width: 45px; height: 45px"
          ></i>
          <div class="pl-3">
            <h5>Téléphone</h5>
            <p>00 000 00 0</p>
          </div>
        </div>
        <div class="d-flex">
          <i
            class="far fa-clock d-inline-flex align-items-center justify-content-center bg-primary text-secondary rounded-circle"
            style="width: 45px; height: 45px"
          ></i>
          <div class="pl-3">
            <h5>Heures d'ouverture</h5>
            <strong>Lundi - Vendredi:</strong>
            <p class="m-0">08:00 - 17:00</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Contact End -->
@endsection