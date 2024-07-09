@extends('adminlte::page')

@section('title', 'Enseignant')

@section('content_header')
    <h1><strong>Gestion des enseignants</strong></h1>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
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


                    <!-- picture -->
                    <div class="mb-3">
                        <label for="picture" class="form-label">{{ __('Photo') }}</label>
                        <input id="picture" class="form-control" type="file" name="picture" accept="image/*" />
                        <x-input-error :messages="$errors->get('picture')" class="mt-2" />
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label for="description" class="form-label">{{ __('Description') }}</label>
                        <input id="description" class="form-control" type="text" name="description" :value="old('description')" required autofocus autocomplete="description" />
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <input type="hidden" name="role_id" value="2">

                    <div class="d-flex justify-content-between align-items-center">
                        <a class="text-decoration-none text-secondary" href="{{ route('login') }}">{{ __('Déja enregistré ?') }}</a>
                        <button type="submit" class="btn btn-primary">{{ __('Register') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop