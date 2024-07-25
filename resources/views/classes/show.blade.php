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
 
 
    </div>
@stop

@section('css')
@stop

@section('js')
@stop