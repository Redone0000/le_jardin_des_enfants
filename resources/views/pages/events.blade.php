@extends('layouts.template')

@section('content')

<!-- Header Start -->
<div class="container-fluid bg-primary mb-5">
  <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
    <h3 class="display-3 font-weight-bold text-white">Nos Événements</h3>
    <div class="d-inline-flex text-white">
      <p class="m-0"><a class="text-white" href="/">Accueil</a></p>
      <p class="m-0 px-2">/</p>
      <p class="m-0">Événements</p>
    </div>
  </div>
</div>
<!-- Header End -->

<!-- Events Start -->
<div class="container py-5">
  <div class="row">
    @foreach($events as $event)
      <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100 shadow-sm border-0">
          <!-- Image Section -->
          <div class="card-img-top" style="height: 200px; overflow: hidden;">
            @php
              $image = $event->eventData->firstWhere('type', 'photo');
            @endphp
            @if($image)
              <img src="{{ asset('storage/' . $image->file_path) }}" alt="{{ $event->name }}" style="width: 100%; height: 100%; object-fit: cover;">
            @else
              <img src="{{ asset('storage/placeholder.png') }}" alt="Image placeholder" style="width: 100%; height: 100%; object-fit: cover;">
            @endif
          </div>
          <!-- Content Section -->
          <div class="card-body">
            <h5 class="card-title">{{ $event->name }}</h5>
            <p class="card-text">{{ $event->description }}</p>
            <p class="card-text"><strong>Date:</strong> {{ \Carbon\Carbon::parse($event->event_date)->format('d/m/Y') }}</p>
          </div>
          <div class="card-footer bg-white border-0 text-center">
            <a href="{{ route('event.show', $event->id) }}" class="btn btn-primary">Voir les détails</a>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>
<!-- Events End -->

@endsection
