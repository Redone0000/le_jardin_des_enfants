@extends('layouts.template')

@section('content')

<!-- Header Start -->
<div class="container-fluid bg-primary mb-5">
  <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
    <h3 class="display-3 font-weight-bold text-white">Nos Classes</h3>
    <div class="d-inline-flex text-white">
      <p class="m-0"><a class="text-white" href="/">Accueil</a></p>
      <p class="m-0 px-2">/</p>
      <p class="m-0">Classes</p>
    </div>
  </div>
</div>
<!-- Header End -->

<!-- Classes Start -->
<div class="container-fluid py-5">
  <div class="container">
    <div class="text-center pb-4">
      <p class="section-title px-5"><span class="px-2">Nos Classes</span></p>
      <h1 class="mb-4">Découvrez Nos Classes</h1>
    </div>
    <div class="row">
      @foreach($classes as $class)
      <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100 shadow-lg border-0 rounded">
          <div class="card-body text-center">
            <h5 class="card-title font-weight-bold">{{ $class->section->name }}</h5>
            <h6 class="card-subtitle mb-2 text-muted">{{ $class->section->description }}</h6>
            <p class="card-text font-weight-bold">Classe: {{ $class->name }}</p>
            <p class="card-text text-secondary">Enseignant: {{ $class->teacher->user->firstname ?? 'Non Assigné' }} {{ $class->teacher->user->lastname ?? '' }}</p>
          </div>
          <div class="card-footer bg-white border-0 text-center">
            <a href="{{ route('class.show', $class->id) }}" class="btn btn-primary">En savoir plus</a>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>
<!-- Classes End -->

@endsection

@section('css')
<style>
  .card-img-top {
    height: 200px;
    object-fit: cover;
  }
  .section-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: #333;
    border-bottom: 2px solid #007bff;
    padding-bottom: 10px;
    margin-bottom: 20px;
  }
  .btn-primary {
    background-color: #007bff;
    border-color: #007bff;
  }
  .btn-primary:hover {
    background-color: #0056b3;
    border-color: #004085;
  }
  .card {
    transition: transform 0.3s ease-in-out;
  }
  .card:hover {
    transform: translateY(-5px);
  }
  .card-body h5, .card-body h6 {
    margin-bottom: 10px;
  }
  .card-body p {
    margin-bottom: 0;
  }
</style>
@endsection
