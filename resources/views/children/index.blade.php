@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

<!-- Header Start -->
<div class="container-fluid bg-secondary mb-3 px-0">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 100px">
        <h3 class="display-5 font-weight-bold text-white">Enfants</h3>
        <div class="d-inline-flex text-white">
            <p class="m-0"><a class="text-white" href="">Accueil</a></p>
            <p class="m-0">/</p>
            <p class="m-0">Enfants</p>
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
        @can('access-admin')
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
        </div>
        @endcan

        <div class="row">
            <!-- Display for Admins and Teachers together -->
            <div class="col-md-12">
                <div class="row">
                @canany(['access-admin', 'access-teacher'])
                    <div class="col-md-12">
                        <h4 class="mb-3">Détails pour Administrateurs et Enseignants</h4>
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
                                                <a href="{{ route('child.show', $child->id) }}" class="btn-sm btn-primary mr-3">Afficher</a>
                                                @can('access-admin')
                                                <a href="{{ route('child.edit', $child->id) }}" class="btn-sm btn-info mr-3">Modifier</a>
                                                @endcan
                                                <form action="{{ route('child.delete', $child->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-sm btn-danger mr-3" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ?')">Supprimer</button>
                                                </form>
                                                <form action="{{ route('chat.start') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" id="user_id" name="user_id" value="{{ $child->tutor->user->id }}">
                                                    <button type="submit" class="btn-sm btn-warning">contacter parent</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endcanany
                </div>
            </div>
        </div>

        <!-- Display for Parents -->
        @can('access-parent')
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Enfant</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                        @foreach($children as $child)
                        <div class="card mb-3">
                                <div class="card-body d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <h4><strong>{{ $child->lastname }} {{ $child->firstname }}</strong></h4>
                                        <p><i class="fas fa-venus-mars"></i> Sexe : {{ $child->sexe }}</p>
                                        <p><i class="fas fa-birthday-cake"></i> Date de naissance : {{ $child->birth_date }}</p>
                                        <a href="{{ route('child.show', $child->id) }}" class="btn-sm btn-primary">Voir</a>
                                    </div>
                                    <div class="ml-3">
                                        <img src="{{ asset('storage/' . $child->picture) }}" alt="Photo" class="" width="100">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @endcan
    </div>
@stop
