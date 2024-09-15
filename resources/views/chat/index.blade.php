@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

<!-- Header Start -->
<div class="container-fluid bg-secondary mb-3 px-0">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 100px">
        <h3 class="display-5 font-weight-bold text-white">Mes Conversations</h3>
        <div class="d-inline-flex text-white">
            <p class="m-0"><a class="text-white" href="">Accueil</a></p>
            <p class="m-0 ">/</p>
            <p class="m-0">Contactez-nous</p>
        </div>
    </div>
</div>
<!-- Header End -->
@stop

@section('content')

<div class="container">
    <!-- Section des conversations -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Mes Conversations</h5>
        </div>
        <div class="card-body">
            <ul class="list-group">
                @foreach ($conversations as $conversation)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <a href="{{ route('chat.show', $conversation->id) }}" class="text-dark font-weight-bold">
                            {{ $conversation->getUsersFullName() }}
                        </a>
                        <span class="badge badge-primary badge-pill">Messages</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <!-- Formulaire de démarrage d'une nouvelle conversation -->
    <div class="card shadow">
        <div class="card-header py-3 bg-primary text-white">
            <h5 class="m-0 font-weight-bold">Démarrer une Nouvelle Conversation</h5>
        </div>
            <div class="card-body">
                @if(auth()->user()->can('access-teacher') || auth()->user()->can('access-parent'))                        
                    <form action="{{ route('chat.start') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="user_id" class="font-weight-bold">Sélectionnez un administrateur :</label>
                            <select id="user_id" name="user_id" class="form-control" required>
                                <option value="" disabled selected>Choisissez un admin</option>
                                @foreach($admins as $admin)
                                    <option value="{{ $admin->id }}">{{ $admin->firstname }} {{ $admin->lastname }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Contacter l'Admin</button>
                    </form>
                    <ul class="list-group">
                            @foreach ($admins as $admin)
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-11">
                                            {{ $admin->lastname }} {{ $admin->firstname }}                                         </div>
                                        <div class="col-md-1">
                                        <!-- Formulaire pour contacter l'enseignant -->
                                        <form action="{{ route('chat.start') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{ $admin->id }}">
                                            <button type="submit" class="btn-sm btn-primary">Contacter</button>
                                        </form></div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                @endcan
                @can('access-admin')
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <a href="{{ route('teacher.index') }}" class="btn btn-warning">Contacter un enseignant</a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('children.index') }}" class="btn btn-success">Contacter un parent d'enfant</a>
                        </div>
                    </div>
                @endcan
                @can('access-teacher')
                    <div class="row mt-3">
                        <a href="{{ route('children.index') }}" class="btn btn-success">Contacter un parent d'enfant</a>
                    </div>
                @endcan 
                @can('access-parent')
                    <h5 class="mt-3 mb-3"><b>Enseignants de vos enfants</b></h5>
                    <ul>
                    @if (!empty($teachers))
                        <ul class="list-group">
                            @foreach ($teachers as $teacherId => $data)
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-11">
                                            {{ $data['teacher']->lastname }} {{ $data['teacher']->firstname }} - 
                                            Enfants : {{ implode(', ', $data['children']) }} - 
                                        </div>
                                        <div class="col-md-1">
                                        <!-- Formulaire pour contacter l'enseignant -->
                                        <form action="{{ route('chat.start') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{ $teacherId }}">
                                            <button type="submit" class="btn-sm btn-primary">Contacter</button>
                                        </form></div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>Aucun enseignant trouvé pour vos enfants.</p>
                    @endif
                    </ul>
                @endcan
            </div>
    </div>
</div>

@stop
