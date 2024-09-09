@extends('adminlte::page')

@section('title', 'Utilisateur')

@section('content_header')
    <h1><strong>Profil</strong></h1>
@stop

@section('content')
<div class="container">
    <div class="main-body">
    

          <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html">Home</a></li>
              <li class="breadcrumb-item"><a href="javascript:void(0)">User</a></li>
              <li class="breadcrumb-item active" aria-current="page">User Profile</li>
            </ol>
          </nav>

          <!-- Teacher -->
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="{{ asset('storage/' . $teacher->picture) }}" alt="Photo" class="rounded-circle" width="100%">
                    <div class="mt-3">
                      <h4>{{ $teacher->user->lastname }} {{ $teacher->user->firstname }}</h4>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Nom</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        {{ $teacher->user->lastname }} {{ $teacher->user->firstname }}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{ $teacher->user->email }}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Téléphone</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{ $teacher->user->phone }}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Description</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{ $teacher->description }}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Classe</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        @if($teacher->classSection)
                            {{ $teacher->classSection->name }}
                        @else
                            <span class="text-muted">Aucune classe assignée</span>
                        @endif
                    </div>
                  </div>
                  <hr>
                  @can('access-admin')
                  <div class="row">
                    <div class="col-sm-12">
                      <a class="btn btn-info float-right" target="__blank" href="{{ route('teacher.edit', $teacher->user->id) }}">Mettre à jour</a>
                    </div>
                  </div>
                  @endcan
                </div>
              </div>
            </div>
          </div>
          </div>
    </div>
@stop