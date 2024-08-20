@extends('adminlte::page')

@section('title', 'Créer une évaluation')

@section('content_header')
    <h1>Évaluer {{ $child->lastname }} {{ $child->firstname }} pour {{ $activity->title }}</h1>
@stop

@section('content')
    <form action="{{ route('evaluations.store') }}" method="POST">
        @csrf
        <input type="hidden" name="activity_id" value="{{ $activity->id }}">
        <input type="hidden" name="child_id" value="{{ $child->id }}">

        <div class="form-group">
            <label for="grade">Note</label>
            <input type="number" name="grade" id="grade" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="feedback">Feedback</label>
            <textarea name="feedback" id="feedback" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Créer</button>
    </form>
@stop
