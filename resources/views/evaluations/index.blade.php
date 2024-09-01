@extends('adminlte::page')

@section('title', 'Évaluations pour l\'activité')

@section('content_header')
<h1>{{ $activity->title }}</h1>
<h2>{{ $activity->activityType->name }}</h2>
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nom de l'Enfant</th>
                            <th>Évaluation</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($children as $child)
                            @php
                            $evaluation = $evaluations->get($child->id);
                            @endphp
                            <tr>
                                <td>{{ $child->lastname }} {{ $child->firstname }}</td>
                                <td>
                                    @if($evaluation)
                                        Note: {{ $evaluation->grade }}<br>
                                        Feedback: {{ $evaluation->feedback }}
                                    @else
                                        Non évalué
                                    @endif
                                </td>
                                <td>
                                    @if($evaluation)
                                        <a href="{{ route('evaluations.edit', $evaluation->id) }}" class="btn btn-info btn-sm">
                                            Modifier
                                        </a>
                                    @else
                                        @if($user->role_id === 1 || ($user->role_id !== 1 && $child->class_id == $user->teacher->classSection->id))
                                            <a href="{{ route('evaluations.create', ['activity_id' => $activity->id, 'child_id' => $child->id]) }}" class="btn btn-success btn-sm">
                                                Évaluer
                                            </a>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop
@section('css')
<style>
    /* Style pour le titre de l'activité */
    h1 {
        font-size: 2rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 0.5rem;
    }

    /* Style pour le sous-titre du type d'activité */
    h2 {
        font-size: 1.5rem;
        font-weight: 400;
        color: #666;
        margin-bottom: 1rem;
    }
</style>
@stop
