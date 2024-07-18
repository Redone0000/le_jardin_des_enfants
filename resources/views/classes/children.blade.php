@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<!-- Header Start -->
<div class="container-fluid px-0 bg-info">
    <div
    class="d-flex flex-column align-items-center justify-content-center"
    style="min-height: 100px"
    >
        <h3 class="display-5 font-weight-bold text-white">{{ $class->section->name }} - {{ $class->name }}</h3>
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
    <div class="row">
        <h4>{{ $class->teacher->user->lastname }} {{ $class->teacher->user->firstname }}</h4>
    </div>
    <div class="row">   
            <div class="col-md-12 col-sm-12">
                <h5 class="mt-3 mb-2 p-1"></h5>

                <table class="table table-striped shadow">
                    <thead>
                        <tr>
                            <th>Numéro</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Sexe</th>
                            <th>Date de naissance</th>
                            <th>Parent</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($children as $child)

                            <tr>
                                <td>{{ $child->id }}</td>
                                <td>{{ $child->lastname }}</td>
                                <td>{{ $child->firstname }}</td>
                                <td>{{ $child->sexe }}</td>
                                <td>{{ $child->birth_date }}</td>
                                <td><button class="btn-sm btn-light">{{ $child->tutor->user->lastname }} {{ $child->tutor->user->firstname }}</button></td>
     
                                <td>
                                    <div class="row">
                                        <a href="" class="btn-sm btn-primary mr-1">Profil</a>
                                        <a href="" class="btn-sm btn-info mr-1">edit</a>
                                        <form action="" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ?')">supprimer</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        
    </div>
</div>
@stop
