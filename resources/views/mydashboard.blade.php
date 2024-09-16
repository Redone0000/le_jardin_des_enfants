@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h3>Bienvenue, {{ auth()->user()->firstname }} {{ auth()->user()->lastname }}</h3>
@stop

@section('content')
<div class="row mt-5">
    <div class="col-md-6">
        <div class="info-box bg-success">
            <span class="info-box-icon"><i class="fas fa-child"></i></span>
            <div class="info-box-content">
                <span class="info-box-text"><strong>Enfants</strong></span>
                <span class="info-box-number">{{ $children->count() }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="info-box bg-gradient-teal">
            <span class="info-box-icon"><i class="fas fa-puzzle-piece"></i></span>
            <div class="info-box-content">
                <span class="info-box-text"><strong>Activité</strong></span>
                <span class="info-box-number">{{ $activities->count() }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="info-box bg-gradient-warning">
            <span class="info-box-icon"><i class="far fa-calendar-alt"></i></span>
            <div class="info-box-content">
                <span class="info-box-text"><strong>Evenements</strong></span>
                <span class="info-box-number">{{ $events->count() }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="info-box bg-gradient-secondary">
            <span class="info-box-icon"><i class="far fa-calendar-alt"></i></span>
            <div class="info-box-content">
                <span class="info-box-text"><strong>Rendez-vous</strong></span>
                <span class="info-box-number">{{ $appointments->count() }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="info-box bg-gradient-lime">
            <span class="info-box-icon"><i class="far fa-calendar-alt"></i></span>
            <div class="info-box-content">
                <span class="info-box-text"><strong>Classes</strong></span>
                <span class="info-box-number">{{ $classes->count() }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="info-box bg-gradient-navy">
            <span class="info-box-icon"><i class="far fa-calendar-alt"></i></span>
            <div class="info-box-content">
                <span class="info-box-text"><strong>Reservations</strong></span>
                <span class="info-box-number">{{ $reservations->count() }}</span>
            </div>
        </div>
    </div>
</div>



@stop

@section('css')
    
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
@stop