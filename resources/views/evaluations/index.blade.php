@extends('adminlte::page')

@section('title', 'Évaluations pour l\'activité')

@section('content_header')
    <h1>Évaluations pour {{ $activity->title }}</h1>
@stop

@section('content')
<div class="container">
    <h1>{{ $activity->title }}</h1>
    <h1>{{ $activity->activityType->name }}</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nom de l'Enfant</th>
                            <th>Grade</th>
                            <th>Feedback</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($evaluations as $evaluation)
                            <tr>
                                <td>{{ $evaluation->child->lastname }} {{ $evaluation->child->firstname }}</td>
                                <td>{{ $evaluation->grade }}</td>
                                <td>{{ $evaluation->feedback }}</td>
                                <td>
                                    <a href="{{ route('evaluations.edit', $evaluation) }}" class="btn btn-success btn-sm">Editer</a>
                                    <form action="{{ route('evaluations.destroy', $evaluation->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette évaluation ?')">
                                            Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@section('css')
<style>
</style>
@stop
@stop
