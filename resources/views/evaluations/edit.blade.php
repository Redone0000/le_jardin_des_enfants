<!-- resources/views/evaluations/edit.blade.php -->
@extends('adminlte::page')

@section('title', 'Éditer l\'Évaluation')

@section('content_header')
    <h1>{{ $evaluation->activity->title }}</h1>
    <h2>Éditer l'Évaluation pour {{ $evaluation->child->lastname }} {{ $evaluation->child->firstname }}</h2>
@stop

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Formulaire d'Édition</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('evaluations.update', $evaluation) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="grade">Grade</label>
                    <input type="number" name="grade" id="grade" class="form-control @error('grade') is-invalid @enderror" value="{{ old('grade', $evaluation->grade) }}" required>
                    @error('grade')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="feedback">Feedback</label>
                    <textarea name="feedback" id="feedback" class="form-control @error('feedback') is-invalid @enderror" rows="4">{{ old('feedback', $evaluation->feedback) }}</textarea>
                    @error('feedback')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    <a href="{{ route('evaluations.index', $evaluation->activity->id) }}" class="btn btn-secondary">Annuler</a>
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
</style>
@stop
