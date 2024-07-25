@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

<!-- Header Start -->
<div class="container-fluid bg-secondary mb-3 px-0">
    <div
    class="d-flex flex-column align-items-center justify-content-center"
    style="min-height: 100px"
    >
    <h3 class="display-5 font-weight-bold text-white">Enfants</h3>
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
            <div class="col-md-4">
                <!-- Search Form -->
                <form action="{{ route('children.index') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Rechercher par nom">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">Rechercher</button>
                        </div>
                    </div>
                </form>
            </div>
            @can('access-admin')
            <div class="col-md-4 text-right">
                <!-- Sort Dropdown -->
                <form action="{{ route('children.index') }}" method="GET" class="form-inline">
                    <div class="form-group mr-3">
                        <select name="sort" class="form-control" onchange="this.form.submit()">
                            <option value="">Trier par classe</option>
                            @foreach($classes as $classe)
                                <option value="{{ $classe->id }}" {{ request()->get('sort') == $classe->id ? 'selected' : '' }}>{{ $classe->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" name="search" value="{{ request()->get('search') }}">
                </form>
            </div>
            @endcan
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Section</th>
                                <th>Classe</th>
                                <th>Enseignant</th>
                                <th>Parents</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        @foreach($children as $child)
                            <tr>
                                <td>{{ $child->id }}</td>
                                <td>{{ $child->lastname }}</td>
                                <td>{{ $child->firstname }}</td>
                                <td>{{ $child->classe->section->name }}</td>
                                <td>{{ $child->classe->name }}</td>
                                <td>{{ $child->classe->teacher->user->lastname }} {{ $child->classe->teacher->user->firstname }}</td>
                                <td>{{ $child->tutor->user->lastname }} {{ $child->tutor->user->firstname }}</td>                            

                                <td>
                                    <div class="row">
                                        <a href="{{ route('child.show', $child->id) }}" class="btn-sm btn-primary mr-3">show</a>
                                        @can('access-admin-teacher')
                                        <a href="{{ route('child.edit', $child->id) }}" class="btn-sm btn-info mr-3">edit</a>
                                        <form action="{{ route('child.delete', $child->id) }}" method="POST">
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
