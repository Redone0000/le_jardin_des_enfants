@extends('layouts.template') <!-- Utilisation de votre layout principal -->

@section('content')
<div class="container">
  <div class="row mt-5">
    <h3>Formulaire</h3>
  </div>
  @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
  @endif
  @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif
  <div class="col-md-8 p-5 border bg-light">
    <form action="{{ route('appointment') }}" method="post">
      @csrf 
      <div class="row ml-1 mt-2 mb-3">
        <h4><strong>Rendez-vous pour le {{ $day }} à {{ $hour }} h</strong></h4>
      </div>

      @if(isset($day) && isset($hour))
        <input type="hidden" name="day" value="{{ $day }}">
        <input type="hidden" name="hour" value="{{ $hour }}">
      @endif
      <!-- informations enfant -->
      <i class="">Informations de l'enfant</i>
      <div class="row mt-3">
        <div class="col-md-6">
          <div class="form-group">
            <label for="child"><strong>Nom de l'enfant</strong></label>
            <input type="text" id="child_last_name" name="child_last_name" class="form-control" required>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="child_first_name"><strong>Prénom de l'enfant</strong></label>
            <input type="text" id="child_first_name" name="child_first_name" class="form-control" required>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="child_birth_date"><strong>Date de Naissance de l'Enfant</strong></label>
            <input type="date" id="child_birth_date" name="child_birth_date" class="form-control" required>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label><strong>Sexe de l'enfant</strong></label>  
            <!-- Boutons radio pour les options -->
            <div class="form-check">
              <input type="radio" id="female" name="child_sex" value="female" class="form-check-input" required> <!-- Option 'Fille' -->
              <label for="female" class="form-check-label mr-4">Fille</label>
              <input type="radio" id="male" name="child_sex" value="male" class="form-check-input" required> <!-- Option 'Garçon' -->
              <label for="male" class="form-check-label">Garçon</label>
            </div>
          </div>
        </div>
      </div>

      <i>Informations du parent</i>
      <!-- informations parents -->
      <div class="row mt-3">

        <div class="col-md-6">
          <div class="form-group">
            <label for="parent_last_name"><strong>Nom du parent</strong></label>
            <input type="text" id="parent_last_name" name="parent_last_name" class="form-control" required>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="parent_first_name"><strong>Prénom du parent</strong></label>
            <input type="text" id="parent_first_name" name="parent_first_name" class="form-control" required>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="phone_number"><strong>Numéro de Téléphone</strong></label>
            <input type="tel" id="phone_number" name="phone_number" class="form-control" pattern="\d{10}" required>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="email"><strong>Adresse E-mail</strong></label>
            <input type="email" id="email" name="email" class="form-control" required>
          </div>
        </div>
      </div>
      <!-- Bouton de Soumission -->
      <div class="form-group mt-3">
        <a href="{{ route('availableappointments') }}" class="btn btn-secondary">Choisir une autre date</a>
        <button type="submit" class="btn btn-primary float-right">Soumettre</button>
      </div>
    </form>
  </div>
</div>
@endsection


