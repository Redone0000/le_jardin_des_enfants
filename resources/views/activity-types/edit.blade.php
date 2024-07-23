@extends('adminlte::page')

@section('title', 'Éditer Activité')

@section('content_header')

<!-- Header Start -->
<div class="container-fluid bg-secondary mb-3 px-0">
    <div
    class="d-flex flex-column align-items-center justify-content-center"
    style="min-height: 100px"
    >
    <h3 class="display-5 font-weight-bold text-white">Éditer une Activité</h3>
    <div class="d-inline-flex text-white">
        <p class="m-0"><a class="text-white" href="">Accueil</a></p>
        <p class="m-0 ">/</p>
        <p class="m-0">Éditer Activité</p>
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
            <h1>Éditer une Activité</h1>

            <form action="{{ route('activity-types.update', $activityType->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="category">Catégorie</label>
                    <input type="text" id="category" name="category" class="form-control" value="{{ $activityType->category }}" required>
                </div>

                <div class="form-group">
                    <label for="name">Nom</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ $activityType->name }}" required>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" class="form-control">{{ $activityType->description }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Mettre à jour</button>
            </form>
        </div>
    </div>
@stop
