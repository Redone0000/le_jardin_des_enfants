@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<!-- Header Start -->
<div class="container-fluid bg-secondary mb-3 px-0">
    <div
    class="d-flex flex-column align-items-center justify-content-center"
    style="min-height: 100px"
    >
    <h3 class="display-5 font-weight-bold text-white">Édition de la classe: {{ $class->name }}</h3>
    <div class="d-inline-flex text-white">
        <p class="m-0"><a class="text-white" href="">Accueil</a></p>
        <p class="m-0 ">/</p>
        <p class="m-0">Édition</p>
    </div>
    </div>
</div>
<!-- Header End -->
@stop

@section('content')
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            <div class="col-md-6">
                <form method="POST" action="{{ route('class.update', $class->id) }}">
                    @csrf
                    @method('PUT')
                    <!-- Section -->
                    <div class="mb-3">
                        <label for="section_id" class="form-label">{{ __('Section') }}</label>
                        <select id="section_id" class="form-select" name="section_id" required autofocus>
                            <option value="">Sélectionner une section</option>
                            @foreach($sections as $section)
                                <option value="{{ $section->id }}" {{ old('section_id', $class->section_id) == $section->id ? 'selected' : '' }}>
                                    {{ $section->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('section_id')" class="mt-2" />
                    </div>

                    <!-- Enseignant -->
                    <div class="mb-3">
                        <label for="teacher_id" class="form-label">{{ __('Enseignant') }}</label>
                        <select id="teacher_id" class="form-select" name="teacher_id" required autofocus>
                            <option value="">Sélectionner un enseignant</option>
                            @foreach($teachers as $teacher)
                                @if($teacher->classSection === null || $teacher->classSection->id === $class->id)
                                    <option value="{{ $teacher->id }}" {{ old('teacher_id', $class->teacher_id) == $teacher->id ? 'selected' : '' }}>
                                        {{ $teacher->user->firstname }} {{ $teacher->user->lastname }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('teacher_id')" class="mt-2" />
                    </div>

                    <!-- Année scolaire -->
                    <div class="mb-3">
                        <label for="school_year" class="form-label">{{ __('Année') }}</label>
                        <select id="school_year" class="form-select" name="school_year" required autofocus>
                            <option value="">Sélectionner une année scolaire</option>
                            <option value="2024-2025" {{ old('school_year', $class->school_year) == '2024-2025' ? 'selected' : '' }}>
                                2024-2025
                            </option>
                            <option value="2025-2026" {{ old('school_year', $class->school_year) == '2025-2026' ? 'selected' : '' }}>
                                2025-2026
                            </option>
                            <option value="2026-2027" {{ old('school_year', $class->school_year) == '2026-2027' ? 'selected' : '' }}>
                                2026-2027
                            </option>
                        </select>
                        <x-input-error :messages="$errors->get('school_year')" class="mt-2" />
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <button type="submit" class="btn btn-primary">{{ __('Register') }}</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row"></div>
        <div class="row"></div>
    </div>
@stop
