@extends('adminlte::page')

@section('title', 'Modifier Partenaire')

@section('content_header')
    <h1>Modifier Partenaire</h1>
@stop

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Modifier les détails de {{ $partner->name }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('partners.update', $partner->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label for="name">Nom</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $partner->name) }}" required>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" class="form-control">{{ old('description', $partner->description) }}</textarea>
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="address">Adresse</label>
                        <input type="text" id="address" name="address" class="form-control" value="{{ old('address', $partner->address) }}">
                        @error('address')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone">Téléphone</label>
                        <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone', $partner->phone) }}">
                        @error('phone')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="website">Site Web</label>
                        <input type="url" id="website" name="website" class="form-control" value="{{ old('website', $partner->website) }}">
                        @error('website')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="picture">Image</label>
                        <input type="file" id="picture" name="picture" class="form-control">
                        @if($partner->picture)
                            <img src="{{ asset('storage/' . $partner->picture) }}" alt="Photo" class="img-fluid mt-2" style="max-width: 200px;">
                        @endif
                        @error('picture')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    <a href="{{ route('partners.show', $partner->id) }}" class="btn btn-secondary">Annuler</a>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .form-control {
            border-radius: 0.25rem;
        }
    </style>
@stop

@section('js')
@stop
