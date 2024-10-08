@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Fil d'actualité</h1>
@stop

@section('content')
<div class="container-fluid mt-4">
    <div class="row d-flex justify-content-center align-items-center">
    <div class="col-lg-10">
        <div class="profile-cover">
            <!-- Profil cover content (identique à ton code) -->
            <div class="profile-cover__action bg--img" data-overlay="0.3">
                <a href="{{route('profile.show')}}" class="btn btn-info">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Profil</span>
                </a>
                <button class="btn btn-rounded btn-info">
                    <i class="fa fa-comment"></i>
                    <span>Message</span>
                </button>
            </div>
        </div>
            @foreach($activities as $activity)
            <div class="panel bg-white p-4 shadow-sm rounded mb-4">
            <div class="row mb-3 align-items-center">
                <div class="col-md-8 d-flex align-items-center">
                    <img src="{{ asset('storage/' . $activity->class->teacher->picture) }}" alt="Photo" class="rounded-circle" width="60">
                    <a href="#" class="text-secondary ml-2">{{ $activity->class->teacher->user->lastname }} {{ $activity->class->teacher->user->firstname }}</a>
                </div>
                <div class="col-md-4 text-md-right">
                    <span class="text-secondary">{{ $activity->class->name }}</span>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-8">
                    <strong>{{ $activity->title }}</strong>
                </div>
                <div class="col-md-4 text-md-right">
                    <span class="text-muted">{{ $activity->ActivityType->name }}</span>
                </div>
            </div>

                <div class="row mb-4">
                    <div class="col">
                        <p>{{ $activity->description }}</p>
                    </div>
                </div>

<!-- Affichage des fichiers -->
@if($activity->ActivityData->isNotEmpty())
<div class="row">
    @foreach($activity->ActivityData as $data)
    @php
        $extension = pathinfo($data->file_path, PATHINFO_EXTENSION);
        $isImage = in_array($extension, ['jpg', 'jpeg', 'png', 'gif']);
        $isPdf = $extension === 'pdf';
        $isVideo = in_array($extension, ['mp4', 'avi', 'mov']);
    @endphp
    <div class="col-md-4 mb-4">
        <div class="card border-0 shadow-sm rounded">
            <a href="{{ asset('storage/' . $data->file_path) }}" target="_blank" class="d-block">
                @if($isImage)
                    <img src="{{ asset('storage/' . $data->file_path) }}" alt="Photo" class="card-img-top" style="height: 200px; object-fit: cover;">
                @elseif($isPdf)
                    <div class="d-flex flex-column align-items-center justify-content-center" style="height: 200px; background-color: #e74c3c; color: white;">
                        <i class="fas fa-file-pdf fa-3x"></i>
                        <p class="mt-2">PDF Document</p>
                    </div>
                @elseif($isVideo)
                    <div class="d-flex flex-column align-items-center justify-content-center" style="height: 200px; background-color: #3498db; color: white;">
                        <i class="fas fa-video fa-3x"></i>
                        <p class="mt-2">Video File</p>
                    </div>
                @else
                    <div class="d-flex flex-column align-items-center justify-content-center" style="height: 200px; background-color: #95a5a6; color: white;">
                        <i class="fas fa-file fa-3x"></i>
                        <p class="mt-2">Other File</p>
                    </div>
                @endif
            </a>
        </div>
    </div>
    @endforeach
</div>
@else
<p>No files for this activity.</p>
@endif

                <hr class="mt-4">
                <div class="row mb-2">
                    <div class="col">
                        <a href="#" class="text-secondary" onclick="toggleComments(event, {{ $activity->id }})"> <i class="fa fa-comments mr-1"></i>{{ $activity->comments->count() }}</a>
                        <span class="float-right text-secondary"> <i class="fa fa-clock mr-2"></i>{{ $activity->created_at->format('d/m/Y à H:i') }}</span>
                    </div>
                </div>
                <div id="comments-container-{{ $activity->id }}" class="comments-container" style="display:none;">
                <!-- Affichage des commentaires -->
                @foreach($activity->comments as $comment)
                    <div class="comment" id="comment-{{ $comment->id }}">
                        <strong>{{ $comment->user->login }} :</strong>
                        <p id="comment-content-{{ $comment->id }}">{{ $comment->content }} 
                            <span class="float-right text-secondary">{{ $comment->created_at->format('d/m/Y H:i') }}</span>
                        </p>
                        
                        @if(Auth::check() && Auth::user()->id == $comment->user_id)
                            <!-- Edit Button -->
                            <button class="btn btn-sm btn-warning" onclick="showEditForm({{ $comment->id }})">Edit</button>
                            
                            <!-- Edit Form -->
                            <form id="edit-form-{{ $comment->id }}" action="{{ route('comments.update', ['id' => $comment->id]) }}" method="POST" style="display:none;">
                                @csrf
                                @method('PUT')
                                <textarea name="content" class="form-control">{{ $comment->content }}</textarea>
                                <button type="submit" class="btn btn-sm btn-info mt-2">Save</button>
                                <button type="button" class="btn btn-sm btn-secondary mt-2" onclick="hideEditForm({{ $comment->id }})">Cancel</button>
                            </form>
                            <!-- Delete Button -->
                            <form id="delete-form-{{ $comment->id }}" action="{{ route('comments.destroy', ['id' => $comment->id]) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this comment?')">Delete</button>
                            </form>
                        @endif
                    </div>
                @endforeach

                </div>
                <form action="{{ route('comments.store', ['activityId' => $activity->id]) }}" method="POST">
                    @csrf
                    <input type="hidden" name="activity_id" value="{{ $activity->id }}"> <!-- Ajouter l'ID de l'activité ici -->
                    <div class="form-group">
                        <textarea name="comment" placeholder="Commenter" class="form-control"></textarea>
                    </div>
                    <div class="actions bg-light p-2 rounded d-flex align-items-center">
                        <button type="submit" class="btn btn-sm btn-info ml-auto">
                            Poster
                        </button>
                    </div>
                </form>
            </div>
            @endforeach
        </div>
    </div>
</div>
@stop

@section('css')
<style>

body{
 background:#dcdcdc;
 margin-top:20px;
}
.profile-cover {
    position: relative;
    z-index: 0;
}

.panel {
    margin-bottom: 30px;
    color: #696969;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 1px 5px rgba(0, 0, 0, 0.08);
}

.profile-cover__action {
    display: -ms-flexbox;
    display: -webkit-box;
    display: flex;
    padding: 120px 30px 10px 153px;
    border-radius: 5px 5px 0 0;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    -ms-flex-pack: end;
    -webkit-box-pack: end;
    justify-content: flex-end;
    overflow: hidden;
    background: url(https://bootdey.com/img/Content/bg1.jpg) no-repeat;
    background-size: cover;
}

.profile-cover__action > .btn {
    margin-left: 10px;
    margin-bottom: 10px;
}

.profile-cover__img {
    position: absolute;
    /* top: 120px;
    left: 30px; */
    top: 25px;
    left: 30px;
    text-align: center;
    z-index: 1;
}

.profile-cover__img > img {
    max-width: 120px;
    border: 5px solid #fff;
    border-radius: 50%;
}

.profile-cover__img > .h3 {
    color: #393939;
    font-size: 20px;
    line-height: 30px;
}

.profile-cover__img > img + .h3 {
    margin-top: 6px;
}

.profile-cover__info .nav {
    margin-right: 28px;
    padding: 15px 0 10px 170px;
    color: #999;
    font-size: 16px;
    line-height: 26px;
    font-weight: 300;
    text-align: center;
    text-transform: uppercase;
    -ms-flex-pack: end;
    -webkit-box-pack: end;
    justify-content: flex-end;
}

.profile-cover__info .nav li {
    margin-top: 13px;
    margin-bottom: 13px;
}

.profile-cover__info .nav li:not(:first-child) {
    margin-left: 30px;
    padding-left: 30px;
    border-left: 1px solid #eee;
}

.profile-cover__info .nav strong {
    display: block;
    margin-bottom: 10px;
    color: #e16123;
    font-size: 34px;
}

@media (min-width: 481px) {
    .profile-cover__action > .btn {
        min-width: 125px;
    }

    .profile-cover__action > .btn > span {
        display: inline-block;
    }
}

@media (max-width: 600px) {
    .profile-cover__info .nav {
        display: block;
        margin: 90px auto 0;
        padding-left: 30px;
        padding-right: 30px;
    }

    .profile-cover__info .nav li:not(:first-child) {
        margin-top: 8px;
        margin-left: 0;
        padding-top: 18px;
        padding-left: 0;
        border-top: 1px solid #eee;
        border-left-width: 0;
    }
}

.panel {
    margin-bottom: 30px;
    color: #696969;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 1px 5px rgba(0, 0, 0, 0.08);
}

.panel-heading {
    color: #393939;
    padding: 10px 20px;
    border-width: 0;
    border-radius: 0;
}

.panel-heading:after,
.panel-heading:before {
    content: " ";
    display: table;
}

.panel-heading:after {
    clear: both;
}

.panel-title {
    float: left;
    margin-top: 3px;
    margin-bottom: 3px;
    font-size: 14px;
    line-height: 24px;
    font-weight: 700;
    text-transform: uppercase;
}

.panel-title select {
    border-width: 0;
    background-color: transparent;
    text-transform: uppercase;
}

.panel-title select option {
    text-transform: capitalize;
}

.panel-title .select2 {
    display: block;
    min-width: 200px;
}

.panel-title .select2-selection {
    height: auto;
    padding: 0;
    background-color: transparent;
    border-width: 0;
    border-radius: 0;
    overflow: hidden;
    white-space: nowrap;
}

.no-outlines .panel-title .select2-selection {
    outline: 0;
}

.panel-title .select2-selection .select2-selection__rendered {
    float: left;
    margin-right: 8px;
    padding: 0;
    line-height: inherit;
}

.panel-title .select2-selection .select2-selection__arrow {
    float: left;
    display: block;
    position: relative;
    top: auto;
    right: auto;
    width: auto;
    height: auto;
}

.panel-title .select2-selection .select2-selection__arrow:before {
    content: "\f107";
    font-family: "Font Awesome\ 5 Free";
    font-weight: 700;
}

.panel-title .select2-container--open .select2-selection__arrow:before {
    content: "\f106";
}

.panel-heading .dropdown {
    float: right;
}

.panel-heading .dropdown .dropdown-toggle {
    margin: -10px -20px;
    padding: 10px 20px;
    color: #999;
    border-width: 0;
    font-size: 14px;
    line-height: 30px;
    cursor: pointer;
}

.panel-heading .dropdown .dropdown-toggle:after,
.toolbar__nav > li > a > span {
    display: none;
}

.panel-heading .dropdown-menu {
    top: 30px !important;
    left: auto !important;
    right: -20px;
    margin: 0;
    padding: 10px 0;
    border-width: 0;
    border-radius: 4px 0 0 4px;
    box-shadow: 0 1px 5px rgba(0, 0, 0, 0.08);
    -webkit-transform: none !important;
    transform: none !important;
    z-index: 1001;
}

.panel-heading .dropdown-menu a {
    padding: 5px 15px;
    color: #999;
    font-size: 13px;
    line-height: 23px;
}

.panel-heading .dropdown-menu a:hover {
    color: #e16123;
}

.panel-heading .dropdown-menu i {
    min-width: 15px;
    margin-right: 6px;
    font-size: 11px;
    text-align: center;
}

.panel-subtitle {
    margin: 20px 0;
}

.panel-subtitle:first-child {
    margin-top: 0;
}

.panel-subtitle .h5 {
    color: #999;
    font-weight: 600;
}

.panel-subtitle .h5 small {
    color: #777;
}

.panel-body {
    padding: 20px;
}

.panel-content,
.panel-social {
    position: relative;
    border-radius: 0 0 4px 4px;
}

.panel-content {
    border-top: 1px solid #eee;
    padding: 31px 20px 33px;
}

.panel-about table {
    width: 100%;
    word-break: break-word;
}

.panel-about table tr + tr td,
.panel-about table tr + tr th {
    padding-top: 8px;
}

.panel-about table th {
    min-width: 120px;
    color: #2bb3c0;
    font-weight: 400;
    vertical-align: top;
}

.panel-about table th > i {
    min-width: 14px;
    margin-right: 8px;
    text-align: center;
}

.panel-social {
    padding: 0 20px 33px;
    z-index: 0;
}

.panel-heading + .panel-social {
    padding-top: 21px;
    border-top: 1px solid #eee;
}

.panel-social > .nav {
    -ms-flex-pack: center;
    -webkit-box-pack: center;
    justify-content: center;
}

.panel-social > .nav > li:not(:last-child) {
    margin-right: 20px;
}

.panel-social > .nav > li > a {
    color: #ccc;
}

.panel-activity__status > .actions {
    display: -ms-flexbox;
    display: -webkit-box;
    display: flex;
    padding: 10px 20px;
    background-color: #ebebea;
    border-style: solid;
    border-width: 0 1px 1px;
    border-color: #ccc;
    border-bottom-left-radius: 4px;
    border-bottom-right-radius: 4px;
}

.btn-link {
    display: inline-block;
    color: inherit;
    font-weight: inherit;
    cursor: pointer;
    background-color: transparent;
}

button.btn-link {
    border-width: 0;
}

.panel-activity__status > .actions > .btn-group > .btn-link:not(:last-child) {
    margin-right: 25px;
}

.panel-activity__status > .actions > .btn-group > .btn-link {
    padding-left: 0;
    padding-right: 0;
    color: #9c9c9c;
}

.btn-info {
    background-color: #2bb3c0;
    border: none;
}

.btn-group,
.btn-group-vertical {
    position: relative;
    display: -ms-inline-flexbox;
    display: inline-flex;
    vertical-align: middle;
}

.panel-activity__status > .actions > .btn-group {
    -ms-flex: 1;
    -webkit-box-flex: 1;
    flex: 1;
    font-size: 16px;
}

.panel-activity__list {
    margin: 60px 0 0;
    padding: 0;
    list-style: none;
}

.panel-activity__list,
.panel-activity__list > li {
    position: relative;
    z-index: 0;
}

.panel-activity__list:before {
    content: " ";
    display: none;
    position: absolute;
    top: 20px;
    left: 35px;
    bottom: 0;
    border-left: 2px solid #ebebea;
}

.activity__list__icon {
    display: none;
    position: absolute;
    top: 2px;
    left: 0;
    min-width: 30px;
    color: #fff;
    background-color: #2bb3c0;
    border-radius: 50%;
    line-height: 30px;
    text-align: center;
}

.panel-activity__list,
.panel-activity__list > li {
    position: relative;
    z-index: 0;
}

.activity__list__header {
    position: relative;
    min-height: 35px;
    padding-top: 4px;
    padding-left: 45px;
    color: #999;
    z-index: 0;
}

.activity__list__body {
    padding-top: 13px;
    padding-left: 43px;
}

.entry-content .gallery {
    margin: 0;
    list-style: none;
    padding: 0;
}

.entry-content .gallery,
.m-error {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
}

.entry-content .gallery > li {
    padding-right: 20px;
    -ms-flex-preferred-size: 0;
    flex-basis: 0;
    -ms-flex-positive: 1;
    flex-grow: 1;
    max-width: 100%;
}

.gallery > li img {
    max-width: 100%;
    height: auto;
}

.entry-content blockquote:last-child,
p:last-child,
table:last-child,
ul:last-child {
    margin-bottom: 0;
}

.entry-content blockquote:last-child,
p:last-child,
table:last-child,
ul:last-child {
    margin-bottom: 0;
}

.entry-content blockquote p:before {
    content: "\f10d";
    color: #999;
    margin-right: 12px;
    font-family: "FontAwesome";
    font-size: 24px;
    font-weight: 900;
}

.activity__list__header img {
    position: absolute;
    top: 0;
    left: 0;
    max-width: 35px;
    border-radius: 50%;
}

.activity__list__header a {
    color: #222;
    font-weight: 600;
}

.activity__list__footer {
    display: -ms-flexbox;
    display: -webkit-box;
    display: flex;
    margin-top: 23px;
    margin-left: 43px;
    padding: 13px 8px 0;
    color: #999;
    border-top: 1px dotted #ccc;
}

.activity__list__footer a {
    color: inherit;
}

.activity__list__footer a + a {
    margin-left: 15px;
}

.activity__list__footer i {
    margin-right: 8px;
}

.activity__list__footer a:hover {
    color: #222;
}

.activity__list__footer span {
    margin-left: auto;
}

.panel-activity__list > li + li {
    margin-top: 51px;
}

.weather--panel {
    padding: 24px 20px 36px;
    border-radius: 5px;
    text-align: center;
}

.weather--title {
    font-size: 18px;
    line-height: 28px;
    font-weight: 600;
}

.weather--title .fa {
    margin-right: 5px;
    font-size: 30px;
    line-height: 40px;
}

.weather--info {
    margin-top: 14px;
    font-size: 46px;
    line-height: 56px;
}

.weather--info .wi {
    margin-right: 10px;
}

.bg-blue {
    background-color: #2bb3c0;
}

.bg-orange {
    background-color: #e16123;
}

.todo--panel .list-group,
.user--list > li,
.user--list > li > a {
    position: relative;
    z-index: 0;
}

.hero-height {
    max-height: 314px;
}

.hero-height .mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar {
    background: rgb(233, 236, 238);
}

.todo--panel .list-group {
    margin-bottom: 0;
    padding-top: 23px;
    padding-bottom: 25px;
}

.todo--panel .list-group:before {
    content: " ";
    position: absolute;
    top: 0;
    left: 20px;
    right: 20px;
    border-top: 1px solid #eee;
}

.todo--panel .list-group-item {
    margin-top: 27px;
    padding: 0;
    border-width: 0;
}

li.list-group-item:first-child {
    margin-top: 0;
}

.todo--label {
    padding-left: 20px;
    padding-right: 30px;
    color: #696969;
    font-weight: 400;
}

.todo--input {
    display: none;
}

.todo--text {
    display: block;
    position: relative;
    padding-left: 39px;
    -webkit-transition: color 0.25s;
    transition: color 0.25s;
    cursor: pointer;
    z-index: 0;
}

.todo--input:checked + .todo--text {
    color: #999;
    text-decoration: line-through;
}

.todo--text:after,
.todo--text:before {
    position: absolute;
    top: 50%;
    left: 0;
    margin-top: -10px;
    width: 20px;
    height: 20px;
    border-radius: 2px;
}

.todo--text:before {
    border: 1px solid #ccc;
    content: " ";
}

.todo--text:after {
    content: "\f00c";
    color: #fff;
    background-color: #009378;
    font-family: "FontAwesome";
    font-size: 11px;
    line-height: 21px;
    font-weight: 700;
    text-align: center;
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    -webkit-transform: scale(0.3);
    transform: scale(0.3);
    -webkit-transition: opacity 0.25s linear, -webkit-transform 0.25s linear;
    transition: opacity 0.25s linear, transform 0.25s linear;
    transition: opacity 0.25s linear, transform 0.25s linear, -webkit-transform 0.25s linear;
}

.todo--input:checked + .todo--text:after {
    opacity: 1;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
    -webkit-transform: scale(1);
    transform: scale(1);
}

.todo--remove {
    position: absolute;
    top: 50%;
    right: 20px;
    margin-top: -15px;
    color: #999;
    font-size: 18px;
    line-height: 28px;
}

.todo--panel .input-group {
    border-top: 1px solid #eee;
}

.todo--panel .form-control {
    height: auto;
    padding: 13px 20px 14px;
    border-width: 0;
}

.todo--panel .btn-link {
    padding: 12px 16px;
    color: #ccc;
    font-size: 28px;
    border-width: 0;
    text-decoration: none;
}

.feeds-panel {
    margin: 20px 20px 0;
    padding-top: 17px;
    padding-bottom: 23px;
    border-top: 1px solid #ebebea;
}

.feeds-panel li {
    position: relative;
    width: 100%;
    min-height: 20px;
    padding-left: 40px;
    z-index: 0;
}

.feeds-panel li a {
    color: #e16123;
}

.feeds-panel li + li {
    margin-top: 12px;
}

.bg-red {
    background-color: #ff4040;
}

.bg-green {
    background-color: #009378;
}

.comments-panel > ul > li:after,
.comments-panel > ul > li:before,
.feeds-panel li:after,
.feeds-panel li:before {
    content: " ";
    display: table;
}

.comments-panel > ul > li:after,
.feeds-panel li:after {
    clear: both;
}

.feeds-panel .time {
    float: right;
    margin-left: 5px;
    color: #ccc;
    font-style: italic;
}

.feeds-panel .fa {
    position: absolute;
    top: 0;
    left: 0;
    min-width: 30px;
    border-radius: 2px;
    font-size: 12px;
    line-height: 30px;
    text-align: center;
}

.feeds-panel .text {
    color: #696969;
    line-height: 26px;
}
</style>
@stop

@section('js')
<script>
function toggleComments(event, activityId) {
    event.preventDefault(); // Empêche le rechargement de la page

    var commentsContainer = document.getElementById('comments-container-' + activityId);
    if (commentsContainer.style.display === 'none' || commentsContainer.style.display === '') {
        commentsContainer.style.display = 'block';
    } else {
        commentsContainer.style.display = 'none';
    }
}

function showEditForm(commentId) {
    document.getElementById('comment-content-' + commentId).style.display = 'none';
    document.getElementById('edit-form-' + commentId).style.display = 'block';
}

function hideEditForm(commentId) {
    document.getElementById('comment-content-' + commentId).style.display = 'block';
    document.getElementById('edit-form-' + commentId).style.display = 'none';
}
</script>
</script>
@stop
