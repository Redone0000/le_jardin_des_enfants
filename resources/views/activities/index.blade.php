@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

<!-- Header Start -->
<div class="container-fluid bg-secondary mb-3 px-0">
    <div
    class="d-flex flex-column align-items-center justify-content-center"
    style="min-height: 100px"
    >
    <h3 class="display-5 font-weight-bold text-white">Activités</h3>
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

        <div class="row mb-3 mt-3">
            <div class="col-md-12 mb-3">
                <form action="{{ route('activity.index') }}" method="GET">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Rechercher par nom">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">Rechercher</button>
                                </div>
                            </div>
                        </div>
                        @can('access-admin')
                        <div class="col-md-2">
                            <select name="sort" class="form-control" onchange="this.form.submit()">
                                <option value="">Filtrer par classe</option>
                                @foreach($classes as $class)
                                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @endcan

                        <div class="col-md-2">
                            <select name="sortType" class="form-control" onchange="this.form.submit()">
                                <option value="">Filtrer par type</option>
                                @foreach($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>

                         <!-- Filter by category -->
                        <div class="col-md-2">
                            <select name="category" class="form-control" onchange="this.form.submit()">
                                <option value="">Filtrer par catégorie</option>
                                @foreach($categories as $category)
                                    @if($category->category) <!-- Assurez-vous que chaque catégorie est bien définie -->
                                        <option value="{{ $category->category }}">{{ $category->category }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <a href="{{ route('activity.index') }}" class="btn btn-success">Réinitialiser</a>
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
                                @can('access-admin')
                                    <th>Classe</th>
                                @endcan
                                <th>Catégorie</th>
                                <th>Type Activité</th>
                                <th>Nom de l'activité</th>
                                @can('access-admin-teacher')
                                <th>Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>

                        @foreach($activities as $activity)
                            <tr>
                                <td>{{ $activity->id }}</td>
                                @can('access-admin')
                                    <td>{{ $activity->class->name}}</td>
                                @endcan
                                <td>{{ $activity->activityType->category }}</td>
                                <td>{{ $activity->activityType->name }}</td>
                                <td>{{ $activity->title }}</td>
                                <td>
                                    <div class="row">
                                        <a href="{{ route('activity.show', $activity->id) }}" class="btn-sm btn-primary mr-3">show</a>
                                        @can('access-admin-teacher')
                                            <a href="{{ route('activity.edit', $activity->id) }}" class="btn-sm btn-info mr-3">edit</a>
                                            <form action="{{ route('activity.delete', $activity->id) }}" method="POST">
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
        <div class="row"></div>
        <div class="row"></div>
    </div>
@stop
