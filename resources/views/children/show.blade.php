@extends('adminlte::page')

@section('title', 'show child')

@section('content_header')
    <h1></h1>
@stop

@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-3">
                <div class="row">
                    <img src="{{ asset('storage/' . $child->picture) }}" alt="Photo" width="100%">
                </div>
                <div class="row mt-3">
                    <a href="" class="btn btn-info">???</a>
                </div>
                <div class="row mt-3">
                    <a href="" class="btn btn-success">Contacter {{ $child->tutor->user->firstname }} {{ $child->tutor->user->lastname }}(à faire)</a>
                </div>
            </div>
            <div class="col-md-7 ml-5">
                <h1 class=""><strong>{{ $child->firstname}} {{ $child->lastname }} <span class="float-right">#{{ $child->classe->name }}</span></strong></h1>
                <div class="table-responsive table-striped mt-5">
                    <table class="table table-horizontal">
                        <tbody>
                                <tr>
                                    <th scope="row">Identitfiant</th>
                                    <td>{{ $child->id }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">sexe</th>
        
                                    
                                    @if($child->sexe === "Male")
                                    <td>Garcon</td>
                                    @else
                                    <td>Fille</td>
                                    @endif
                                </tr>
                                <tr>
                                    <th scope="row">Date de naissance</th>
                                    <td>{{ $child->birth_date }}</td>
                                </tr>
                            <tr>
                                <th scope="row">Classe</th>
                                <td>{{ $child->classe->name }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Parent</th>
                                <td>{{ $child->tutor->user->firstname }} {{ $child->tutor->user->lastname }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop