@extends('adminlte::page')

@section('title', 'Détails du Menu')

@section('content_header')
<div class="container-fluid bg-primary mb-3 px-0">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 100px">
        <h3 class="display-5 font-weight-bold text-white">Détails du Menu</h3>
        <div class="d-inline-flex text-white">
            <p class="m-0"><a class="text-white" href="{{ route('menus.index') }}">Accueil</a></p>
            <p class="m-0 ">/</p>
            <p class="m-0">Détails</p>
        </div>
    </div>
</div>
@stop

@section('content')
<div class="container">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    Menu: {{ $menu->month }} ({{ $menu->price }} €)
                </div>
                <div class="card-body">
                    <h5>Jours du Menu</h5>
                    @if ($menuDays->isEmpty())
                        <p>Aucun jour disponible pour ce menu.</p>
                    @else
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Repas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($menuDays as $menuDay)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($menuDay->date)->format('d M Y') }}</td>
                                        <td>{{ $menuDay->meal }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                    <a href="{{ route('menus.index') }}" class="btn btn-secondary">Retour à la liste des menus</a>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
