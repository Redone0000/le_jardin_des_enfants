@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

<!-- Header Start -->
<div class="container-fluid bg-secondary mb-3 px-0">
    <div
    class="d-flex flex-column align-items-center justify-content-center"
    style="min-height: 100px"
    >
    <h3 class="display-5 font-weight-bold text-white">Types d'activités</h3>
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
    <div class="container-fluid">
        <div class="row">
            <a href="{{ route('activity-types.create') }}" class="btn btn-primary ml-auto">Nouveau type d'activité</a>
        </div>
        <div class="row mb-3 mt-3">
            <div class="col-md-12 mb-3">
                <form action="{{ route('activity-types.index') }}" method="GET">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Rechercher par nom" value="{{ request()->search }}">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">Rechercher</button>
                                </div>
                            </div>
                        </div>
                        @can('access-admin')
                        <div class="col-md-2">
                            <select name="sort" class="form-control" onchange="this.form.submit()">
                                <option value="">Filtrer par catégories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->category }}" {{ request()->sort == $category->category ? 'selected' : '' }}>{{ $category->category }}</option>
                                @endforeach
                            </select>
                        </div>
                        @endcan
                        <div class="col-md-3">
                            <a href="{{ route('activity-types.index') }}" class="btn btn-success">Réinitialiser</a>
                        </div>
                    </div>
                </form>
            </div>       
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Catégorie</th>
                                <th>nom</th>
                                <th>Description</th>
                                @can('access-admin')
                                <th>Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>

                        @foreach($activityTypes as $activityType)
                            <tr>
                                <td>{{ $activityType->id }}</td>
                                <td>{{ $activityType->category }}</td>
                                <td>{{ $activityType->name }}</td>
                                <td>{{ $activityType->description }}</td>
                                <td>
                                    <div class="row">
                                        <a href="{{ route('activity-types.show', $activityType->id) }}" class="btn-sm btn-primary mr-1">show</a>
                                        @can('access-admin')
                                            <a href="{{ route('activity-types.edit', $activityType->id) }}" class="btn-sm btn-info mr-1">edit</a>
                                            <form action="{{ route('activity-types.destroy', $activityType->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ?')" class="btn btn-danger">supprimer</button>
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
        <div class="d-flex justify-content-center mt-5 mb-5">
                    {{ $activityTypes->links('pagination::bootstrap-4') }}
                </div>
        <div class="row"></div>
    </div>
@stop
