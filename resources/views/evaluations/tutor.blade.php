@extends('adminlte::page')

@section('title', 'Évaluations des Enfants')

@section('content_header')
    <h1>Évaluations des Enfants</h1>
@stop

@section('content')
<div class="container">
    @if(isset($formattedEvaluations) && count($formattedEvaluations) > 0)
        @foreach($formattedEvaluations as $childId => $data)
            <div class="card mb-3">
                <div class="card-header">
                    <h5>{{ $data['name'] }}</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Catégorie</th>
                                <th>Type</th>                               
                                <th>Activité</th>
                                <th>Note</th>
                                <th>Feedback</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data['evaluations'] as $evaluation)
                                <tr>
                                    <td>{{ $evaluation['category'] }}</td>
                                    <td>{{ $evaluation['type'] }}</td>
                                    <td>{{ $evaluation['activity'] }}</td>                                   
                                    <td>{{ $evaluation['grade'] }}</td>
                                    <td>{{ $evaluation['feedback'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    @else
        <p>Aucune évaluation trouvée.</p>
    @endif
</div>
@stop
