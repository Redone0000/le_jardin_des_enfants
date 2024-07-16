@extends('adminlte::page')

@section('title', 'Dashboard')
@section('content_header')
<!-- Header Start -->
<div class="container-fluid bg-success mb-3 px-0">
    <div
    class="d-flex flex-column align-items-center justify-content-center"
    style="min-height: 100px"
    >
    <h3 class="display-5 font-weight-bold text-white">Gestion des rendez-vous</h3>
    <div class="d-inline-flex text-white">
        <p class="m-0"><a class="text-white" href="">Accueil</a></p>
        <p class="m-0 ">/</p>
        <p class="m-0"></p>
    </div>
    </div>
</div>
<!-- Header End -->
@stop
@section('content')
<div class="container">
    <h5 class="mb-3"><strong>Ajouter des dates disponibles</strong></h5>
    <div class="row">
        <div class="border shadow p-5  mb-5 col-md-8">
            <small>
            <form action="{{ route('appointment.storeAvailableDates') }}" method="POST">
                @csrf
                <div class="form-group row">
                    <label for="start_date" class="col-sm-3 col-form-label">Date de début</label>
                    <div class="col-sm-5">
                        <input type="date" class="form-control" id="start_date" name="start_date" required>
                    </div>
                </div>
   
                    <div class="form-group row">
                        <label for="end_date" class="col-sm-3 col-form-label">Date de fin</label>
                        <div class="col-sm-5">
                            <input type="date" class="form-control" id="end_date" name="end_date" required>
                        </div>
                    </div>              
                <div class="row mt-4">
                    <button type="submit" class="btn-sm btn-primary">Ajouter les dates</button>
                </div>
            </form>
</small>
        </div>
    </div>
</div>
@endsection
