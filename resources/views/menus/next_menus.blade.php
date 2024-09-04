@extends('adminlte::page')

@section('title', 'Menus des Trois Mois Prochains')

@section('content_header')
    <h1>Menus des Trois Mois Prochains</h1>
@stop

@section('content')
@php
    use Carbon\Carbon;
@endphp
    <div class="container">
        @foreach($menuDays->groupBy(function($day) {
            return Carbon::parse($day->date)->format('F Y');
        }) as $month => $daysInMonth)
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">{{ $month }}</h3>
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

                    <form action="" method="GET">
                        <button type="submit" class="btn btn-success mt-3">Réserver pour ce mois</button>
                    </form>
                </div>
            </div>
            <br>
        @endforeach
    </div>
@stop
