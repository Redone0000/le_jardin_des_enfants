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
<h1>Mes conversations</h1>
    <ul class="list-group">
        @foreach ($conversations as $conversation)
        <li class="list-group-item">
            <a href="{{ route('chat.show', $conversation->id) }}">
                {{ $conversation->getUsersFullName() }}
            </a>
        </li>
        @endforeach
    </ul>
    <h2>Démarrer une nouvelle conversation</h2>
    <form action="{{ route('chat.start') }}" method="POST">
        @csrf
        <label for="user_id">Sélectionnez l'admin :</label>
        <select id="user_id" name="user_id" required>
            @foreach($admins as $admin)
                <option value="{{ $admin->id }}">{{ $admin->firstname }} {{ $admin->lastname }}</option>
            @endforeach
        </select>
        <button type="submit">Contacter l'Admin</button>
    </form>

    
@stop
