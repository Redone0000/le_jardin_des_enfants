@extends('layouts.template')

@section('content')

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<!-- Header Start -->
<div class="container-fluid bg-primary mb-5">
      <div
        class="d-flex flex-column align-items-center justify-content-center"
        style="min-height: 400px"
      >
        <h3 class="display-3 font-weight-bold text-white">Rendez-vous</h3>
        <div class="d-inline-flex text-white">
          <p class="m-0"><a class="text-white" href="{{ route('page.home') }}">Accueil</a></p>
          <p class="m-0 px-2">/</p>
          <p class="m-0">Prenez rendez-vous pour inscrire votre enfant</p>
        </div>
      </div>
    </div>
    <!-- Header End -->
<div class="container">
    <div class="row mt-3">
        <div class="col-md-12">
            <h3 class="text-center mt-3">Disponibilité</h3>
            <p class="text-center">Sélectionnez le jour et l'heure de votre rendez-vous</p>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-1 my-auto">
            <a href="?page={{ $currentPage - 1 }}" class="btn btn-primary {{ $hasPreviousPage ? '' : 'disabled' }} ml-4" style="{{ $hasPreviousPage ? '' : 'pointer-events: none; opacity: 0.5;' }}">←</a>
        </div>
        <div class="col-md-10">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead style="background-color: #e0e0e0">
                        <tr>
                            @foreach($availableDates as $availableDate)
                                <th>{{ $availableDate->formatted_date }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @foreach($availableDates as $availableDate)
                                <td>
                                    @foreach($availableDate->timeSlots as $timeSlot)                            
                                        @if($timeSlot->is_available == 1)
                                            <a href="{{ route('formAppointment', ['day' => $availableDate->formatted_date , 'hour' => $timeSlot->formatted_start_time]) }}" class="btn btn-sm btn-primary mb-1" ><small>{{ $timeSlot->formatted_start_time }} - {{ $timeSlot->formatted_end_time }}</small></a><br>
                                        @else
                                            <a href="{{ route('formAppointment', ['day' => $availableDate->formatted_date , 'hour' => $timeSlot->formatted_start_time]) }}" class="btn btn-sm btn-danger mb-1 disabled"><small>{{ $timeSlot->formatted_start_time }} - {{ $timeSlot->formatted_end_time }}</small></a><br>
                                        @endif             
                                    @endforeach
                                </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-1 my-auto">
            <a href="?page={{ $currentPage + 1 }}" class="btn btn-primary {{ $hasNextPage ? '' : 'disabled' }} ml-4" style="{{ $hasNextPage ? '' : 'pointer-events: none; opacity: 0.5;' }}">→</a>
        </div>
    </div>
</div>
@endsection
