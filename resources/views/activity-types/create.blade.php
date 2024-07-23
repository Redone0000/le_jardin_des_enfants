@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

<!-- Header Start -->
<div class="container-fluid bg-secondary mb-3 px-0">
    <div
    class="d-flex flex-column align-items-center justify-content-center"
    style="min-height: 100px"
    >
    <h3 class="display-5 font-weight-bold text-white">Types d'activités</h3>
    <div class="d-inline-flex text-white">
        <p class="m-0"><a class="text-white" href="">Accueil</a></p>
        <p class="m-0 ">/</p>
        <p class="m-0">Contact Us</p>
    </div>
    </div>
</div>
<!-- Header End -->
@stop

@section('content')
    @if(session('success')) 
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="container-fluid">
    <div class="container mt-5">
        <h1>Créer une Activité</h1>

        <form action="{{ route('activity-types.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="category">Catégorie</label>
                <input type="text" id="category" name="category" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Créer</button>
        </form>
    </div>
    </div>
@stop
