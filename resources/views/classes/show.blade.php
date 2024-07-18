@extends('adminlte::page')

@section('title', 'Enseignant')

@section('content_header')
    <h1></h1>
@stop

@section('content')
    <div class="container">
    @if(isset($classSections))
        @foreach($classSections as $class)
        <div class="row mt-5">
            <div class="col-md-7 ml-5">
                <h1 class=""><strong>{{ $class->name }} <span class="float-right">#{{ $class->id }}</span></strong></h1>
                <div class="table-responsive table-striped mt-5">
                    <table class="table table-horizontal">
                        <tbody>
                            <tr>
                                <th scope="row">Enseignant</th>
                                <td>{{ $class->teacher->user->firstname }} {{ $class->teacher->user->lastname }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Section</th>
                                <td>{{ $class->section->name }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Classe</th>
                                <td>{{ $class->name }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endforeach
     @else
        <div class="row mt-5">
            <div class="col-md-7 ml-5">
                <h1 class=""><strong>{{ $class->name }} <span class="float-right">#{{ $class->id }}</span></strong></h1>
                <div class="table-responsive table-striped mt-5">
                    <table class="table table-horizontal">
                        <tbody>
                            <tr>
                                <th scope="row">Enseignant</th>
                                <td>{{ $class->teacher->user->firstname }} {{ $class->teacher->user->lastname }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Section</th>
                                <td>{{ $class->section->name }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Classe</th>
                                <td>{{ $class->name }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
     @endif
 
 
        <!-- <div class="row mt-5">
        <h5><strong>Nos activités</strong></h5>
            <table class="table table-horizontal">
                <thead>
                    <tr>
                        <td>Id</td>
                        <td>Date</td>
                        <td>Nom</td>
                        <td>Type</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($class->activities as $activity)
                        <tr>
                            <td>{{ $activity->id }}</td>
                            <td>{{ $activity->created_at }}</td>
                            <td>{{ $activity->name }}</td>
                            <td>{{ $activity->typeActivity->name }}</td>
                            <td>
                                <div class="row">
                                    <a href="{{ route('activity.show', $activity->id) }}" class="btn-sm btn-primary mr-2">Plus de détails</a>
                                    <a href="{{ route('activity.edit', $activity->id) }}" class="btn-sm btn-success mr-2">Modifier</a>
                                    <form method="" action="">
                                        <button type="submit" class="btn-sm btn-danger">Supprimer</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div> -->
    </div>
@stop

@section('css')
@stop

@section('js')
@stop