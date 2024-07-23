@extends('adminlte::page')

@section('title', 'Utilisateur')

@section('content_header')
    <h1><strong>Mise à jour</strong></h1>
@stop

@section('content')
    <div class="container">
        <form method="POST" action="{{ route('child.update', $child->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-4 p-1">
                    <div class="card shadow mt-5">
                        <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                        <img src="{{ asset('storage/' . $child->picture) }}" alt="Photo" class="rounded-circle" width="150">
                            <div class="mt-3">
                            <h4>{{ $child->lastname }} {{ $child->firstname }}</h4>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">               
                    <h5 class="mb-3 mt-2">Informations de l'enfant</h5>
                    <div class="border p-4 bg-white shadow">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="classe">Classe</label>
                                    <select name="classe" class="form-control">
                                        <option value="" disabled selected>Choisissez une classe</option>
                                        @foreach($classes as $classe)
                                            <option value="{{ $classe->id }}" {{ old('classe', $child->classe->id ?? '') == $classe->id ? 'selected' : '' }}>
                                                {{ $classe->name }} ({{ $classe->section->name }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lastname">Nom</label>
                                    <input type="text" name="lastname" class="form-control" placeholder="Nom" value="{{ old('lastname', $child->lastname ?? '') }}"">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="firstname">Prénom</label>
                                    <input type="text" name="firstname" class="form-control" placeholder="Prénom" value="{{ old('firstname', $child->firstname ?? '') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sexe">Sexe</label>
                                    <select name="sexe" class="form-control">
                                        <option value="Male" {{ old('sexe', $child->sexe) == 'Male' ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ old('sexe', $child->sexe) == 'Female' ? 'selected' : '' }}>Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="birth_date">Date de naissance</label>
                                    <input type="date" name="birth_date" class="form-control" placeholder="Date de naissance" value="{{ old('birth_date', $child->birth_date) ?? '' }}">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <!-- picture -->
                            <div class="col-md-6">
                                <label for="picture">Photo</label>
                                <input id="picture" class="form-control" type="file" name="picture" accept="image/*" />
                            </div>
                        </div>
                    </div>
                    <h5 class="mb-3 mt-3">Informations tuteur</h5>
                    <div class="border p-4 bg-white shadow mb-2">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lastname_tutor">Nom</label>
                                    <input type="text" name="lastname_tutor" class="form-control" placeholder="Nom" value="{{ old('lastname_tutor', $child->tutor->user->lastname ?? '') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="firstname_tutor">Prénom</label>
                                    <input type="text" name="firstname_tutor" class="form-control" placeholder="Prénom" value="{{ old('firstname_tutor', $child->tutor->user->firstname ?? '') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email', $child->tutor->user->email ?? '') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Numéro de téléphone</label>
                                    <input type="text" name="phone" class="form-control" placeholder="Email" value="{{ old('phone', $child->tutor->user->phone) }}">
                                </div>
                            </div>
                        </div>
                        <!-- <div class="row"> -->
                            <div class="form-group">
                                <label for="address">Adresse</label>
                                <input type="text" name="address" class="form-control" placeholder="Adresse" value="{{ old('address', $child->tutor->address) }}">
                            </div>
                        <!-- </div> -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="emergency_contact_name">Nom du contact d'urgence</label>
                                    <input type="text" name="emergency_contact_name" class="form-control" placeholder="Nom contact urgence" value="{{ old('emergency_contact_name', $child->tutor->emergency_contact_name) }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="emergency_contact_phone">Numéro de télépone du contact</label>
                                    <input type="text" name="emergency_contact_phone" class="form-control" placeholder="Numéro de téléphone contact" value="{{ old('emergency_contact_phone', $child->tutor->emergency_contact_phone) }}">
                            </div>
                        </div>
                        <input type="hidden" name="role_id" value="3">
                        <button type="submit" class="btn btn-primary mt-3 mb-2 float-right">Envoyer</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop