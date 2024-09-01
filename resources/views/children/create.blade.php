@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<!-- Header Start -->
<div class="container-fluid bg-secondary mb-3 px-0">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 100px;">
        <h3 class="display-5 font-weight-bold text-white">Inscription</h3>
        <div class="d-inline-flex text-white">
            <p class="m-0"><a class="text-white" href="">Accueil</a></p>
            <p class="m-0 mx-2">/</p>
            <p class="m-0"></p>
        </div>
    </div>
</div>
<!-- Header End -->
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4>Inscription d'un Enfant</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('child.store') }}" enctype="multipart/form-data">
                        @csrf

                        <h5 class="mb-4">Informations de l'enfant</h5>
                        <div class="form-group border p-3 rounded shadow-sm">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="classe">Classe</label>
                                    <select name="classe" id="classe" class="form-control">
                                        <option value="" disabled selected>Choisissez une classe</option>
                                        @foreach($classes as $classe)
                                            <option value="{{ $classe->id }}" {{ old('classe') == $classe->id ? 'selected' : '' }}>
                                                {{ $classe->name }} ({{ $classe->section->name }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="lastname">Nom</label>
                                    <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Nom" value="{{ old('lastname') }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="firstname">Prénom</label>
                                    <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Prénom" value="{{ old('firstname') }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="sexe">Sexe</label>
                                    <select name="sexe" id="sexe" class="form-control">
                                        <option value="Male" {{ old('sexe') == 'Male' ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ old('sexe') == 'Female' ? 'selected' : '' }}>Female</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="birth_date">Date de naissance</label>
                                    <input type="date" name="birth_date" id="birth_date" class="form-control" placeholder="Date de naissance" value="{{ old('birth_date') }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="picture">Photo</label>
                                    <input id="picture" class="form-control" type="file" name="picture" accept="image/*">
                                </div>
                            </div>
                        </div>

                        <h5 class="mt-4 mb-3">Informations tuteur</h5>
                        <div class="form-group border p-3 rounded shadow-sm mb-3">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="lastname_tutor">Nom</label>
                                    <input type="text" name="lastname_tutor" id="lastname_tutor" class="form-control" placeholder="Nom" value="{{ old('lastname_tutor') }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="firstname_tutor">Prénom</label>
                                    <input type="text" name="firstname_tutor" id="firstname_tutor" class="form-control" placeholder="Prénom" value="{{ old('firstname_tutor') }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="phone">Numéro de téléphone</label>
                                    <input type="text" name="phone" id="phone" class="form-control" placeholder="Numéro de téléphone" value="{{ old('phone') }}">
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="address">Adresse</label>
                                <input type="text" name="address" id="address" class="form-control" placeholder="Adresse" value="{{ old('address') }}">
                            </div>
                        </div>

                        <h6 class="mt-4 mb-3">Contact d'urgence</h6>
                        <div class="form-group border p-3 rounded shadow-sm mb-3">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="emergency_contact_name">Nom du contact d'urgence</label>
                                    <input type="text" name="emergency_contact_name" id="emergency_contact_name" class="form-control" placeholder="Nom contact urgence" value="{{ old('emergency_contact_name') }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="emergency_contact_phone">Numéro de téléphone du contact</label>
                                    <input type="text" name="emergency_contact_phone" id="emergency_contact_phone" class="form-control" placeholder="Numéro de téléphone contact" value="{{ old('emergency_contact_phone') }}">
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="role_id" value="3">
                        <button type="submit" class="btn btn-primary mt-3 float-right">Envoyer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<style>
    .card {
        border-radius: 8px;
    }
    .card-header {
        border-bottom: 2px solid #007bff;
    }
    .form-group {
        margin-bottom: 1.5rem;
    }
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }
    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }
    .bg-secondary {
        background-color: #6c757d !important;
    }
</style>
@stop
