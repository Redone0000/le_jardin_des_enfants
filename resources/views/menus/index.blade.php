@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<!-- Header Start -->
<div class="container-fluid bg-primary mb-3 px-0">
    <div
    class="d-flex flex-column align-items-center justify-content-center"
    style="min-height: 100px"
    >
    <h3 class="display-5 font-weight-bold text-white">Menus</h3>
    <div class="d-inline-flex text-white">
        <p class="m-0"><a class="text-white" href="">Accueil</a></p>
        <p class="m-0 ">/</p>
        <p class="m-0">Menus</p>
    </div>
    </div>
</div>
<!-- Header End -->
@stop

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-end mb-5 mt-5">
            <a href="{{ route('menus.create') }}" class="btn btn-success">Nouveau Menu</a>
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

        <div class="row">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Mois</th>
                            <th>Prix</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($menus as $menu)
                        <tr>
                            <td>{{ $menu->id }}</td>
                            <td>{{ $menu->month }}</td>
                            <td>{{ $menu->price }} €</td>
                            <td>
                                <div class="row">
                                    <a href="{{ route('menus.show', $menu->id) }}" class="btn btn-primary mr-3">Afficher</a>
                                    <a href="{{ route('menus.edit', $menu->id) }}" class="btn btn-info mr-3">Modifier</a>
                                    <form action="{{ route('menus.destroy', $menu->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce menu ?')">Supprimer</button>
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
