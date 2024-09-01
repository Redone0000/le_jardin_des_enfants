@extends('adminlte::page')

@section('title', 'Créer une Évaluation')

@section('content_header')
    <h1>Évaluer {{ $child->lastname }} {{ $child->firstname }} pour {{ $activity->title }}</h1>
@stop

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Formulaire de Création</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('evaluations.store') }}" method="POST">
                @csrf
                <input type="hidden" name="activity_id" value="{{ $activity->id }}">
                <input type="hidden" name="child_id" value="{{ $child->id }}">

                <div class="form-group">
                    <label for="grade">Note</label>
                    <input type="number" name="grade" id="grade" class="form-control @error('grade') is-invalid @enderror" required>
                    @error('grade')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="feedback">Feedback</label>
                    <textarea name="feedback" id="feedback" class="form-control @error('feedback') is-invalid @enderror" rows="4"></textarea>
                    @error('feedback')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Créer</button>
                    <a href="{{ route('evaluations.index', $activity->id) }}" class="btn btn-secondary">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('css')
<style>
    .card {
        border-radius: 8px;
        border: 1px solid #ddd;
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }
    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #ddd;
    }
    .card-body {
        padding: 2rem;
    }
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }
    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }
    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
    }
    .btn-secondary:hover {
        background-color: #5a6268;
        border-color: #545b62;
    }
    .form-control.is-invalid {
        border-color: #dc3545;
        padding-right: calc(1.5em + .75rem);
    }
    .invalid-feedback {
        display: block;
        font-size: 0.875em;
        color: #dc3545;
    }
</style>
@stop
