@extends('adminlte::page')

@section('title', 'Enseignant')

@section('content_header')
    <h1 class="display-4"><strong>Gestion des enseignants</strong></h1>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Ajouter un Enseignant</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('teacher.store') }}" enctype="multipart/form-data">
                            @csrf
                            
                            <!-- FirstName -->
                            <div class="mb-3">
                                <label for="firstname" class="form-label">{{ __('Prénom') }}</label>
                                <input id="firstname" class="form-control" type="text" name="firstname" :value="old('firstname')" required autofocus autocomplete="firstname" />
                                <x-input-error :messages="$errors->get('firstname')" class="mt-2" />
                            </div>

                            <!-- LastName -->
                            <div class="mb-3">
                                <label for="lastname" class="form-label">{{ __('Nom') }}</label>
                                <input id="lastname" class="form-control" type="text" name="lastname" :value="old('lastname')" required autofocus autocomplete="lastname" />
                                <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
                            </div>

                            <!-- Email Address -->
                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('Email') }}</label>
                                <input id="email" class="form-control" type="email" name="email" :value="old('email')" required autocomplete="username" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <!-- Phone -->
                            <div class="mb-3">
                                <label for="phone" class="form-label">{{ __('Téléphone') }}</label>
                                <input id="phone" class="form-control" type="text" name="phone" :value="old('phone')" required autofocus autocomplete="phone" />
                                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                            </div>

                            <!-- Picture -->
                            <div class="mb-3">
                                <label for="picture" class="form-label">{{ __('Photo') }}</label>
                                <input id="picture" class="form-control" type="file" name="picture" accept="image/*" />
                                <x-input-error :messages="$errors->get('picture')" class="mt-2" />
                            </div>

                            <!-- Description -->
                            <div class="mb-3">
                                <label for="description" class="form-label">{{ __('Description') }}</label>
                                <textarea id="description" class="form-control" name="description" rows="4" required autofocus autocomplete="description">{{ old('description') }}</textarea>
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>

                            <input type="hidden" name="role_id" value="2">

                            <div class="d-flex justify-content-between align-items-center">
                                <button type="submit" class="btn btn-primary">{{ __('Enregistrer') }}</button>
                            </div>
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
    .form-label {
        font-weight: 600;
    }
    .form-control {
        border-radius: 4px;
    }
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }
    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }
</style>
@stop

@section('js')
@stop
