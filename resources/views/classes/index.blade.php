@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<!-- Header Start -->
<div class="container-fluid px-0 bg-info">
    <div
    class="d-flex flex-column align-items-center justify-content-center"
    style="min-height: 100px"
    >
        <h3 class="display-5 font-weight-bold text-white">Gestion des classes</h3>
        <div class="d-inline-flex text-white">
            <p class="m-0"><a class="text-white" href="">Accueil</a></p>
            <p class="m-0 ">/</p>
            <p class="m-0">Contact Us</p>
        </div>
    </div>
</div>
<!-- Header End -->
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

<div class="container">

    <div class="row justify-content-end mb-3 mt-5">
        <a href="{{ route('class.create') }}" class="btn btn-success">Créer une nouvelle classe</a>
    </div>

    <div class="row">
        @foreach($sections as $section)
            <div class="col-md-12 col-sm-12 mb-3">
                <!-- <h5 class="mt-5 mb-2 p-1">{{ $section->name }}</h5> -->
                <table class="table table-striped shadow">
                    <thead  class="col-md-12">
                        <tr>
                            <th>
                                <h5>{{ $section->name }}</h5>
                            </th>
                        </tr>
                    </thead>
                    <thead>
                        <tr>
                            <th>Numéro de classe</th>
                            <th>Nom de la classe</th>
                            <th>Enseignant</th>
                            <th>Nombre d'enfants</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($section->classes as $class)
                           <tr>
                                <td>{{ $class->id }}</td>
                                <td>{{ $class->name }}</td>
                                <td>
                                    <a href="{{ route('teacher.show',  $class->teacher->id) }}">
                                        {{ $class->teacher->user->firstname }} {{ $class->teacher->user->lastname }}
                                    </a>
                                </td>
                                <td>
                                    <div class="">
                                        @php
                                            $totalChildren = 0;
                                            foreach($class->children as $child) {
                                                $totalChildren += 1;
                                            }
                                        @endphp
                                        {{ $totalChildren }}
                                    </div>
                                </td>
                                <td>
                                    <div class="row">
                                        <a href="{{ route('class.show', $class->id) }}" class="btn-sm btn-primary mr-1">show</a>
                                        @can('access-admin')
                                        <a href="{{ route('class.children', $class->id) }}" class="btn btn-sm btn-info mr-1">enfants</a>
                                        <a href="{{ route('class.edit', $class->id) }}" class="btn-sm btn-info mr-1">edit</a>
                                        <form action="{{ route('class.delete', $class->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ?')">supprimer</button>
                                        </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endforeach
    </div>
</div>
@stop
