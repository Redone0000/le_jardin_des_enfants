@extends('adminlte::page')

@section('title', 'Évaluer les Enfants')

@section('content_header')
    <h1>Évaluer les Enfants pour {{ $activity->title }}</h1>
@stop

@section('content')
<div class="container">
    <form action="{{ route('evaluations.store') }}" method="POST">
        @csrf
        <input type="hidden" name="activity_id" value="{{ $activity->id }}">

        <h2>Sélectionner un enfant pour l'évaluation</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nom de l'Enfant</th>
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
                                <!-- Bouton pour modifier l'évaluation si elle existe déjà -->
                                <a href="{{ route('evaluations.edit', $evaluation->id) }}" class="btn btn-info btn-sm">
                                    Modifier
                                </a>
                            @else
                                <!-- Bouton pour ajouter une nouvelle évaluation -->
                                <a href="{{ route('evaluations.create', ['activity_id' => $activity->id, 'child_id' => $child->id]) }}" class="btn btn-success btn-sm">
                                    Évaluer
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </form>
</div>
@stop
