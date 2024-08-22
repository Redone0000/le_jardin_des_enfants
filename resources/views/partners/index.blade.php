@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<!-- Header Start -->
<div class="container-fluid bg-primary mb-3 px-0">
    <div
    class="d-flex flex-column align-items-center justify-content-center"
    style="min-height: 100px"
    >
    <h3 class="display-5 font-weight-bold text-white">Partenaires</h3>
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
    <div class="container-fluid">
        <div class="row justify-content-end mb-5 mt-5">
            <a href="{{ route('partners.create') }}" class="btn btn-success">Nouveau partenaire</a>
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
                            <th>Id</th>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Adresse</th>
                            <th>Site web</th>
                            <th>Téléphone</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($partners as $partner)
                        <tr>
                            <td>{{ $partner->id }}</td>
                            <td>{{ $partner->name }}</td>
                            <td>{{ $partner->description }}</td>
                            <td>{{ $partner->phone }}</td>
                            <td>{{ $partner->address }}</td>
                            <td>{{ $partner->website }}</td>
                            <td>
                                @if($partner->picture)
                                    <img src="{{ asset('storage/' . $partner->picture) }}" alt="{{ $partner->name }}" class="img-fluid" style="max-width: 50px;">
                                @else
                                    Pas d'image disponible
                                @endif
                            </td>
                            <td>
                                <div class="row">
                                    <a href="{{ route('partners.show', $partner->id) }}" class="btn btn-primary mr-3">show</a>
                                        <a href="{{ route('partners.edit', $partner->id) }}" class="btn btn-info mr-3">edit</a>
                                        <form action="{{ route('partners.destroy', $partner->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ?')" class="btn btn-danger">supprimer</button>
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
