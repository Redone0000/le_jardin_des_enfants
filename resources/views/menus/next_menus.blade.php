@extends('adminlte::page')

@section('title', 'Menus des Trois Mois Prochains')

@section('content_header')
    <h1>Cantine</h1>
@stop

@section('content')
@php
    use Carbon\Carbon;
@endphp
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="row mb-4">
            <a href="{{ route('reservations.index') }}" class="btn btn-primary ml-auto">Mes reservations</a>
        </div>
        <div class="row mb-2">
            <h3>Nos Prochains Menu</h3>
        </div>
        @foreach($menuDays->groupBy(function($day) {
            return Carbon::parse($day->date)->format('F Y');
        }) as $month => $daysInMonth)
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">{{ $month }}</h3><br>
                    <h4 class="card-title">{{ $daysInMonth->first()->menu->price }} €</h4>
                </div>
                <div class="card-body">
                    @php
                        $weeks = $daysInMonth->groupBy(function($day) {
                            return Carbon::parse($day->date)->weekOfMonth;
                        })->sortKeys();
                    @endphp

                    @foreach($weeks as $weekNumber => $daysInWeek)
                        @php
                            $dates = $daysInWeek->sortBy(function($day) {
                                return Carbon::parse($day->date)->dayOfWeek;
                            })->pluck('date')->unique();
                        @endphp

                        <h4>Semaine {{ $weekNumber }}</h4>
                        <table class="table table-bordered">
                            <thead class="bg-secondary text-white">
                                <tr>
                                    @foreach($dates as $date)
                                        <th>{{ Carbon::parse($date)->format('d/m/Y') }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @foreach($dates as $date)
                                        <td>
                                            @php
                                                $meal = $daysInWeek->where('date', $date)->first()->meal ?? 'Aucun repas';
                                            @endphp
                                            {{ $meal }}
                                        </td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    @endforeach
                    <form action="{{ route('reservations.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="menu_id" value="{{ $daysInMonth->first()->menu_id }}">
                        <input type="hidden" name="month" value="{{ $month }}">
                        <input type="hidden" name="price" value="{{ $daysInMonth->first()->menu->price }}">

                        <div class="form-group">
                            <label for="child_id">Sélectionnez un enfant :</label>
                            <select name="child_id" id="child_id" class="form-control">
                                @if($children->count() > 1)
                                    @foreach($children as $child)
                                        <option value="{{ $child->id }}">{{ $child->lastname }}</option>
                                    @endforeach
                                @elseif($children->count() == 1)
                                    <!-- Sélectionner automatiquement le seul enfant disponible -->
                                    <option value="{{ $children->first()->id }}" selected>{{ $children->first()->lastname }}</option>
                                @else
                                    <option value="" disabled>Aucun enfant disponible</option>
                                @endif
                            </select>
                        </div>

                        <!-- <button type="submit" class="btn btn-success mt-3">Réserver pour ce mois</button> -->
                        <button type="submit" name="action" value="pay_now" class="btn btn-success mt-3">Réserver et Payer</button>
                        <button type="submit" name="action" value="pay_later" class="btn btn-warning mt-3">Réserver et Payer plus tard</button>
                    </form>
                </div>
            </div>
            <br>
        @endforeach
    </div>
@stop
