@extends('adminlte::page')

@section('title', 'Dashboard')
@section('content_header')
<!-- Header Start -->
<div class="container-fluid bg-success mb-3 px-0">
    <div
    class="d-flex flex-column align-items-center justify-content-center"
    style="min-height: 100px"
    >
    <h3 class="display-5 font-weight-bold text-white">Liste des rendez-vous</h3>
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
<div class="container-fluid">
<div class="row">
            <a href="{{ route('appointment.addAvailableDates') }}" class="btn btn-primary ml-auto">Ajouter des dates</a>
        </div>
    <div class="row">
        <div class="col-md-12 mb-5">
            <h5 class="mb-3"><strong>Les prochains rendez-vous</strong></h5>
            <table class="table table-striped bg-white">
                <thead>
                    <tr>
                        <th>Jour</th>
                        <th>Heure</th>
                        <th>Nom</th>
                        <th>Téléphone</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->day }}</td>
                        <td>{{ $appointment->hour }}</td>
                        <td>{{ $appointment->parent_last_name }} {{ $appointment->parent_first_name }}</td>
                        <td>{{ $appointment->phone_number }}</td>
                        <td>{{ $appointment->email }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
