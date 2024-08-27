@extends('layouts.template')

@section('content')

<!-- Header Start -->
<div class="container-fluid bg-primary mb-5">
  <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
    <h3 class="display-3 font-weight-bold text-white">Nos partenaires</h3>
    <div class="d-inline-flex text-white">
      <p class="m-0"><a class="text-white" href="/">Accueil</a></p>
      <p class="m-0 px-2">/</p>
      <p class="m-0">Partenaires</p>
    </div>
  </div>
</div>
<!-- Header End -->

<!-- Partners Start -->
<div class="container-fluid py-5">
  <div class="container">
    <div class="text-center pb-4">
      <p class="section-title px-5"><span class="px-2">Nos partenaires</span></p>
      <h1 class="mb-4">Découvrez nos partenaires</h1>
    </div>
    <div class="row">
      @foreach($partners as $partner)
      <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100 shadow-sm border-0">
          <img src="{{ asset('storage/' . $partner->picture) }}" class="card-img-top" alt="{{ $partner->name }}" style="height: 250px; object-fit: cover;">
          <div class="card-body text-center">
            <h5 class="card-title font-weight-bold">{{ $partner->name }}</h5>
            <p class="card-text">{{ $partner->description }}</p>
            <p class="card-text">{{ $partner->phone }}</p>
            <p class="card-text">{{ $partner->address }}</p>
          </div>
          <div class="card-footer bg-white border-0 text-center">
            @if($partner->website)
              <a href="{{ $partner->website }}" class="btn btn-primary" target="_blank">Visitez le site</a>
            @endif
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>
<!-- Partners End -->

@endsection
