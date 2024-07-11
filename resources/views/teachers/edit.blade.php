@extends('adminlte::page')

@section('title', 'Utilisateur')

@section('content_header')
    <h1><strong>Mise à jour</strong></h1>
@stop

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-6">
                <form method="POST" action="{{ route('teacher.update', $teacher->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <!-- Login -->
                    <div class="mb-3">
                        <label for="login" class="form-label">{{ __('Nom d\'utilisateur') }}</label>
                        <input id="login" class="form-control" type="text" name="login" value="{{ old('login', $teacher->login) }}" required autofocus autocomplete="login" />
                        <x-input-error :messages="$errors->get('login')" class="mt-2" />
                    </div>

                    <!-- FirstName -->
                    <div class="mb-3">
                        <label for="firstname" class="form-label">{{ __('Prénom') }}</label>
                        <input id="firstname" class="form-control" type="text" name="firstname" value="{{ old('firstname', $teacher->firstname) }}" required autofocus autocomplete="firstname" readonly />
                        <x-input-error :messages="$errors->get('firstname')" class="mt-2" />
                    </div>

                    <!-- LastName -->
                    <div class="mb-3">
                        <label for="lastname" class="form-label">{{ __('Nom') }}</label>
                        <input id="lastname" class="form-control" type="text" name="lastname" value="{{ old('lastname', $teacher->lastname) }}" required autofocus autocomplete="lastname" readonly />
                        <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Email') }}</label>
                        <input id="email" class="form-control" type="email" name="email" value="{{ old('email', $teacher->email) }}" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Phone -->
                    <div class="mb-3">
                        <label for="phone" class="form-label">{{ __('Téléphone ') }}</label>
                        <input id="phone" class="form-control" type="text" name="phone" value="{{ old('phone', $teacher->phone) }}" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                        <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label for="description" class="form-label">{{ __('Description') }}</label>
                        <input id="description" class="form-control" type="text" name="description" value="{{ old('description', $teacher->teacher->description) }}" required autofocus autocomplete="description"  />
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <!-- Image existante -->
                    @if ($teacher->teacher->picture)
                        <div class="mb-3">
                            <label>{{ __('Ancienne Photo') }}</label><br>
                            <img src="{{ asset('storage/' . $teacher->teacher->picture) }}" alt="Photo" width="10%">
                        </div>
                    @endif

                    <!-- picture -->
                    <div class="mb-3">
                        <label for="picture" class="form-label">{{ __('Photo') }}</label>
                        <input id="picture" class="form-control" type="file" name="picture" accept="image/*"/>
                        <x-input-error :messages="$errors->get('picture')" class="mt-2" />
                    </div>


                    <div class="d-flex justify-content-between align-items-center">
                        <button type="submit" class="btn btn-primary">{{ __('Register') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop