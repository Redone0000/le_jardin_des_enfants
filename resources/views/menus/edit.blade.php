@extends('adminlte::page')

@section('title', 'Modifier un Menu')

@section('content_header')
<div class="container-fluid bg-primary mb-3 px-0">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 100px">
        <h3 class="display-5 font-weight-bold text-white">Modifier le Menu</h3>
        <div class="d-inline-flex text-white">
            <p class="m-0"><a class="text-white" href="{{ route('menus.index') }}">Accueil</a></p>
            <p class="m-0 ">/</p>
            <p class="m-0">Modifier</p>
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
                <div class="card-header">Modifier le Menu</div>
                <div class="card-body">
                    <form action="{{ route('menus.update', $menu->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="year">Année</label>
                            <select name="year" id="year" class="form-control" required>
                                @foreach($years as $year)
                                    <option value="{{ $year }}" {{ $year == $menu->year ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="month">Mois</label>
                            <select name="month" id="month" class="form-control" required>
                                @foreach($months as $month)
                                    <option value="{{ $month->format('m') }}" {{ $month->format('m') == $menu->month ? 'selected' : '' }}>
                                        {{ $month->format('F') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="price">Prix Total du Mois</label>
                            <input type="number" name="price" id="price" class="form-control" step="0.01" value="{{ $menu->price }}" required>
                        </div>

                        <div id="menu-days-container">
                            @foreach($menuDays as $date => $meal)
                                <div class="form-group">
                                    <label for="date_{{ $date }}">Date ({{ \Carbon\Carbon::parse($date)->format('d M Y') }})</label>
                                    <input type="date" name="dates[]" id="date_{{ $date }}" class="form-control" value="{{ $date }}" required>

                                    <label for="meal_{{ $date }}">Repas</label>
                                    <input type="text" name="meals[]" id="meal_{{ $date }}" class="form-control" value="{{ $meal }}" required>
                                </div>
                            @endforeach
                        </div>

                        <button type="submit" class="btn btn-primary">Sauvegarder</button>
                        <a href="{{ route('menus.index') }}" class="btn btn-secondary">Annuler</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
