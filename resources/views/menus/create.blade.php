@extends('adminlte::page')

@section('title', 'Créer un Menu')

@section('content_header')
<div class="container-fluid bg-primary mb-3 px-0">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 100px">
        <h3 class="display-5 font-weight-bold text-white">Créer un Nouveau Menu</h3>
        <div class="d-inline-flex text-white">
            <p class="m-0"><a class="text-white" href="{{ route('menus.index') }}">Accueil</a></p>
            <p class="m-0 ">/</p>
            <p class="m-0">Créer</p>
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
                <div class="card-header">Créer un Nouveau Menu</div>
                <div class="card-body">
                    <form action="{{ route('menus.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="year">Année</label>
                            <select name="year" id="year" class="form-control" required>
                            @foreach($years as $year)
                                    <option value="{{ $year }}" {{ $year == $currentYear ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="month">Mois</label>
                            <select name="month" id="month" class="form-control" required>
                                @foreach($months as $month)
                                    <option value="{{ $month->format('m') }}">{{ $month->format('F') }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="price">Prix Total du Mois</label>
                            <input type="number" name="price" id="price" class="form-control" step="0.01" value="{{ old('price') }}" required>
                        </div>
                        <br>
                        <br>
                        <div id="menu-days-container">
                            <!-- Champs des jours seront ajoutés ici dynamiquement -->
                        </div>

                        <button type="submit" class="btn btn-primary">Créer</button>
                        <a href="{{ route('menus.index') }}" class="btn btn-secondary">Annuler</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const monthSelect = document.getElementById('month');
    const yearSelect = document.getElementById('year');
    const container = document.getElementById('menu-days-container');

    function updateDays() {
        container.innerHTML = '';
        const month = monthSelect.value;
        const year = yearSelect.value;

        if (month && year) {
            const startDate = new Date(`${year}-${month}-01`);
            const endDate = new Date(year, month, 0);

            for (let date = startDate; date <= endDate; date.setDate(date.getDate() + 1)) {
                if (date.getDay() !== 0 && date.getDay() !== 6) { // Exclure les week-ends
                    const formattedDate = date.toISOString().split('T')[0];
                    const dayLabel = date.toLocaleDateString('fr-FR', { day: '2-digit', month: 'short', year: 'numeric' });

                    const dayHtml = `
                        <div class="form-group">
                            <label for="date_${formattedDate}">Date (${dayLabel})</label>
                            <input type="date" name="dates[]" id="date_${formattedDate}" class="form-control" value="${formattedDate}" required>

                            <label for="meal_${formattedDate}">Repas</label>
                            <input type="text" name="meals[]" id="meal_${formattedDate}" class="form-control" required>
                        </div>
                    `;
                    container.insertAdjacentHTML('beforeend', dayHtml);
                }
            }
        }
    }

    monthSelect.addEventListener('change', updateDays);
    yearSelect.addEventListener('change', updateDays);
    updateDays(); // Initial call to populate fields
});
</script>
@stop
