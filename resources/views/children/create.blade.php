@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<!-- Header Start -->
<div class="container-fluid bg-secondary mb-3 px-0">
    <div
    class="d-flex flex-column align-items-center justify-content-center"
    style="min-height: 100px"
    >
    <h3 class="display-5 font-weight-bold text-white">Inscription</h3>
    <div class="d-inline-flex text-white">
        <p class="m-0"><a class="text-white" href="">Accueil</a></p>
        <p class="m-0 ">/</p>
        <p class="m-0"></p>
    </div>
    </div>
</div>
<!-- Header End -->
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <form method="POST" action="{{ route('child.store') }}" enctype="multipart/form-data">
                @csrf

                <h5 class="mb-3">Informations de l'enfant</h5>
                <div class="border shadow p-4">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="classe">Classe</label>
                                <select name="classe" class="form-control">
                                    <option value="" disabled selected>Choisissez une classe</option>
                                    @foreach($classes as $classe)
                                        <option value="{{ $classe->id }}" {{ old('classe') == $classe->id ? 'selected' : '' }}>{{ $classe->name }} ({{ $classe->section->name }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lastname">Nom</label>
                                <input type="text" name="lastname" class="form-control" placeholder="Nom" value="{{ old('lastname') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="firstname">Prénom</label>
                                <input type="text" name="firstname" class="form-control" placeholder="Prénom" value="{{ old('firstname') }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sexe">Sexe</label>
                                <select name="sexe" class="form-control">
                                    <option value="Male" {{ old('sexe') == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ old('sexe') == 'Female' ? 'selected' : '' }}>Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="birth_date">Date de naissance</label>
                                <input type="date" name="birth_date" class="form-control" placeholder="Date de naissance" value="{{ old('birth_date') }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- picture -->
                        <div class="col-md-6">
                            <label for="picture">Photo</label>
                            <input id="picture" class="form-control" type="file" name="picture" accept="image/*" />
                        </div>
                    </div>
                </div>
                <h5 class="mb-3 mt-5">Informations tuteur</h5>
                <div class="border shadow p-4 mb-3">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="lastname_tutor">Nom</label>
                            <input type="text" name="lastname_tutor" class="form-control" placeholder="Nom" value="{{ old('lastname_tutor') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="firstname_tutor">Prénom</label>
                            <input type="text" name="firstname_tutor" class="form-control" placeholder="Prénom" value="{{ old('firstname_tutor') }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone">Numéro de téléphone</label>
                            <input type="text" name="phone" class="form-control" placeholder="Email" value="{{ old('phone') }}">
                        </div>
                    </div>
                </div>
                <!-- <div class="row"> -->
                    <div class="form-group">
                        <label for="address">Adresse</label>
                        <input type="text" name="address" class="form-control" placeholder="Adresse" value="{{ old('address') }}">
                    </div>
                <!-- </div> -->
                <h6 class="mb-4 mt-5">Contact d'urgence</h6>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="emergency_contact_name">Nom du contact d'urgence</label>
                            <input type="text" name="emergency_contact_name" class="form-control" placeholder="Nom contact urgence" value="{{ old('emergency_contact_name') }}">
                        </div>
                    </div>
                
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="emergency_contact_phone">Numéro de télépone du contact</label>
                            <input type="text" name="emergency_contact_phone" class="form-control" placeholder="Numéro de téléphone contact" value="{{ old('emergency_contact_phone') }}">
                        </div>
                    </div>
                


                <input type="hidden" name="role_id" value="3">
                <button type="submit" class="btn btn-primary mt-3 ml-auto">Envoyer</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
