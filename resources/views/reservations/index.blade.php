@extends('adminlte::page')

@section('title', 'Reservations')

@section('content_header')
    <h1>Réservations</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-end mb-5 mt-5">
            <!-- Bouton pour ajouter une réservation -->
            @can('create-reservation')
                <a href="{{ route('reservations.create') }}" class="btn btn-success">Nouvelle Réservation</a>
            @endcan
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
            <form method="GET" action="{{ route('reservations.index') }}" class="form-inline">
                <input type="text" name="search" placeholder="Rechercher une réservation..." class="form-control mr-2" value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">Rechercher</button>
                <a href="{{ route('reservations.index') }}" class="btn btn-primary ml-3">Réinitialiser</a>
            </form>
        </div>

        <div class="row">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Enfant</th>
                            <th>Prix</th>
                            <th>Status</th>
                            <th>Mois</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reservations as $reservation)
                            <tr>
                                <td>{{ $reservation->id }}</td>
                                <td>{{ $reservation->child->lastname }} {{ $reservation->child->firstname }}</td>
                                <td>{{ $reservation->price }} €</td>
                                <td>{{ $reservation->status }}</td>
                                <td>{{ $reservation->month }}</td>
                                <td>
                                    <div class="row">
                                        <a href="" class="btn btn-primary mr-3">Voir</a>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">

            </div>
        </div>
    </div>
@stop
