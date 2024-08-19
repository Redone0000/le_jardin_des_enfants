@extends('adminlte::page')

@section('title', 'Créer une Évaluation')

@section('content_header')
    <h1>Créer une Évaluation</h1>
@stop

@section('content')
<div class="container">
    <h1>{{ $activity->title }}</h1>
    <h1>{{ $activity->activityType->name }}</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <form method="POST" action="{{ route('evaluations.store', $activity->id) }}">
                    @csrf
                    <input type="hidden" name="activity_id" value="{{ $activity->id }}">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Grade</th>
                                <th>Feedback</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($children as $child)
                                <tr>
                                    <td>{{ $child->lastname }} {{ $child->firstname }}</td>
                                    <td>
                                        <div>
                                            <input type="radio" id="grade1-{{ $child->id }}" name="grades[{{ $child->id }}]" value="1">
                                            <label for="grade1-{{ $child->id }}">Insuffisant</label>
                                            
                                            <input type="radio" id="grade2-{{ $child->id }}" name="grades[{{ $child->id }}]" value="2" style="margin-left: 20px;">
                                            <label for="grade2-{{ $child->id }}">Passable</label>
                                            
                                            <input type="radio" id="grade3-{{ $child->id }}" name="grades[{{ $child->id }}]" value="3" style="margin-left: 20px;">
                                            <label for="grade3-{{ $child->id }}">Bien</label>
                                            
                                            <input type="radio" id="grade4-{{ $child->id }}" name="grades[{{ $child->id }}]" value="4" style="margin-left: 20px;">
                                            <label for="grade4-{{ $child->id }}">Très Bien</label>                      
                                        </div>
                                    </td>
                                    <td>
                                        <textarea name="feedback[{{ $child->id }}]" class="form-control" rows="2"></textarea>
                                    </td>
                                    <td>
                                        <input type="hidden" name="child_ids[]" value="{{ $child->id }}">
                                        
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-info btn-sm">Soumettre</button>
                </form>
            </div>
        </div>
    </div>
</div>

@section('css')
<style>
</style>
@stop
@stop
