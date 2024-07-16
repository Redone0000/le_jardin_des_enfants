@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<!-- Header Start -->
<div class="container-fluid bg-primary mb-3 px-0">
    <div
    class="d-flex flex-column align-items-center justify-content-center"
    style="min-height: 100px"
    >
    <h3 class="display-5 font-weight-bold text-white">Enseignants</h3>
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
    <div class="container">
        <div class="row justify-content-end mb-5 mt-5">
            <a href="{{ route('teacher.create') }}" class="btn btn-success">Nouvel enseignant</a>
        </div>

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="row mb-3 mt-5 col-md-12">

                <!-- Formulaire de recherche -->
                <form method="GET" action="{{ route('teacher.index') }}" class="form-inline">
                    <input type="text" name="search" placeholder="Rechercher un enseignant..." class="form-control mr-2" value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">Rechercher</button>
                </form>

                <a href="{{ route('teacher.index') }}" class="btn btn-primary ml-3 ml-auto">réinitialiser</a>
        </div>

        <div class="row">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>UserId</th>
                            <th>TeacherId</th>
                            <th>Login</th>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($teachers as $teacher)
                        <tr>
                            <td>{{ $teacher->user->id }}</td>
                            <td>{{ $teacher->id }}</td>
                            <td>{{ $teacher->user->login }}</td>
                            <td>{{ $teacher->user->firstname }}</td>
                            <td>{{ $teacher->user->lastname }}</td>
                            <td>{{ $teacher->user->email }}</td>
                            <td>{{ $teacher->user->phone }}</td>
                            <td>
                                <div class="row">
                                    <a href="{{ route('teacher.show', $teacher->id) }}" class="btn btn-primary mr-3">show</a>
                                    @can('access-admin')
                                        <a href="{{ route('teacher.edit', $teacher->user->id) }}" class="btn btn-info mr-3">edit</a>
                                        <form action="{{ route('teacher.delete', $teacher->user_id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ?')" class="btn btn-danger">supprimer</button>
                                        </form>
                                    @endcan
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
