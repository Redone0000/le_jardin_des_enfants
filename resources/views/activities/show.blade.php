@extends('adminlte::page')

@section('title', 'Show Child')

@section('content_header')
    <h1></h1>
@stop

@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-3">
                <div class="row">
                    <!-- Place for any additional content if needed -->
                </div>
                <div class="row mt-3">
                    <a href="" class="btn btn-info">???</a>
                </div>
                <div class="row mt-3">
                    <!-- Place for any additional content if needed -->
                </div>
            </div>
            <div class="col-md-7 ml-5">
                <h1>
                    <strong>{{ $activity->title }}</strong>
                    <span class="float-right">#{{ $activity->class->name }}</span>
                </h1>
                <div class="table-responsive table-striped mt-5">
                    <table class="table table-horizontal">
                        <tbody>
                            <tr>
                                <th scope="row">Identifiant</th>
                                <td>{{ $activity->id }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Type</th>
                                <td>{{ $activity->activityType->name }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Description</th>
                                <td>{{ $activity->description }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                @if($activity->activityData->isNotEmpty())
                    <div>
                        <h4 class="mt-3 mb-3">Data Activities</h4>
                        
                        <!-- Images -->
                        @if($activity->activityData->filter(fn($data) => $data->isImage())->isNotEmpty())
                            <h5 class="mt-2 mb-2">Images</h5>
                            <div class="row mb-3">
                                @foreach($activity->activityData->filter(fn($data) => $data->isImage()) as $data)
                                    <div class="col-md-3 m-0 p-0 mb-2">
                                        <a href="{{ asset('storage/' . $data->file_path) }}" target="_blank">
                                            <img src="{{ asset('storage/' . $data->file_path) }}" alt="Photo" width="100%" height="100%">
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <!-- Videos -->
                        @if($activity->activityData->filter(fn($data) => $data->isVideo())->isNotEmpty())
                            <h5 class="mt-2 mb-2">Videos</h5>
                            <div class="row mb-3">
                                @foreach($activity->activityData->filter(fn($data) => $data->isVideo()) as $data)
                                    <div class="col-md-6 m-0 p-0 mb-2">
                                        <video width="100%" height="100%" controls>
                                            <source src="{{ asset('storage/' . $data->file_path) }}" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <!-- PDFs -->
                        @if($activity->activityData->filter(fn($data) => $data->isPdf())->isNotEmpty())
                            <h5 class="mt-2 mb-2">PDFs</h5>
                            <div class="row mb-3">
                                @foreach($activity->activityData->filter(fn($data) => $data->isPdf()) as $data)
                                    <div class="col-md-3 m-0 p-0 mb-2">
                                        <a href="{{ asset('storage/' . $data->file_path) }}" download>Download PDF</a>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @else
                    <p>Aucune donnée d'activité trouvée pour cette activité.</p>
                @endif
            </div>
        </div>
    </div>
@stop
