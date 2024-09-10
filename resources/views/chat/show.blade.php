@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

<!-- Header Start -->
<div class="container-fluid bg-secondary mb-3 px-0">
    <div
    class="d-flex flex-column align-items-center justify-content-center"
    style="min-height: 100px"
    >
    <h3 class="display-5 font-weight-bold text-white">Chat</h3>
    <div class="d-inline-flex text-white">
        <p class="m-0"><a class="text-white" href="">Accueil</a></p>
        <p class="m-0 ">/</p>
        <p class="m-0">Contact Us</p>
    </div>
    </div>
</div>
<!-- Header End -->
@stop

@section('content')
<section>
    <div class="container py-5">
        <div class="row ">
            <div class="col-md-8">
                <div class="card" id="chat1" style="border-radius: 15px;">
                    <div
                        class="card-header d-flex justify-content-between align-items-center p-3 bg-info text-white border-bottom-0"
                        style="border-top-left-radius: 15px; border-top-right-radius: 15px;">
                        <i class="fas fa-angle-left"></i>
                        <p class="mb-0 fw-bold">{{ $conversation->getUsersFullName() }}</p>
                        <i class="fas fa-times"></i>
                    </div>

                    <div class="card-body">
                    <div id="messages-container">
    @foreach ($messages as $message)
        <div class="d-flex {{ $message->user_id == auth()->id() ? 'flex-row-reverse' : 'flex-row' }} justify-content-start mb-4">
            <div class="p-3 {{ $message->user_id == auth()->id() ? 'me-3' : 'ms-3' }}" style="border-radius: 15px; background-color: {{ $message->user_id == auth()->id() ? 'rgb(220, 220, 220)' : 'rgba(57, 192, 237,.2)' }}">
                <strong>{{ $message->user->firstname }} {{ $message->user->lastname }}</strong>
                <p class="small mb-0">{{ $message->message }}</p>
            </div>
        </div>
    @endforeach
</div>

                        <!-- Formulaire pour envoyer un message -->
                        <form action="{{ route('chat.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="conversation_id" value="{{ $conversation->id }}">
                        <div data-mdb-input-init class="form-outline">
                            <textarea class="form-control bg-body-tertiary" id="textAreaExample" rows="4" name="message"></textarea>
                        </div>
                        <button type="submit" class="btn btn-info mt-3">Envoyer</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-m-4 ml-5 mt-5">
                @can('access-admin')
                    <div class="row mb-3">
                        <a href="{{ route('teacher.index') }}" class="btn btn-warning mr-3">Liste des enseignants</a>
                    </div>
                    <div class="row">
                        <a href="{{ route('children.index') }}" class="btn btn-success">Liste des enfants et Parents</a>
                    </div>
                @endcan

                @can('access-teacher')
                    <div class="row ">
                        <a href="{{ route('children.index') }}" class="btn btn-success">Liste des enfants et Parents</a>
                    </div>
                @endcan
            </div>
            
        </div>
    </div>
</section>

<script>
    function fetchMessages() {
        let conversationId = {{ $conversation->id }};

        fetch(`/chat/messages/${conversationId}`)
            .then(response => response.json())
            .then(data => {
                let messagesContainer = document.getElementById('messages-container');
                messagesContainer.innerHTML = ''; // Clear existing messages

                data.messages.forEach(message => {
                    let messageDiv = document.createElement('div');
                    // Apply the correct class based on whether the message is from the user or not
                    messageDiv.className = message.user_id === {{ auth()->id() }} ? 'd-flex flex-row-reverse justify-content-start mb-4' : 'd-flex flex-row justify-content-start mb-4';

                    let messageContent = document.createElement('div');
                    messageContent.className = 'p-3 ' + (message.user_id === {{ auth()->id() }} ? 'me-3' : 'ms-3');
                    messageContent.style.borderRadius = '15px';
                    messageContent.style.backgroundColor = message.user_id === {{ auth()->id() }} ? 'rgb(220, 220, 220)' : 'rgba(57, 192, 237,.2)';

                    let strong = document.createElement('strong');
                    strong.textContent = `${message.user_firstname} ${message.user_lastname}`;
                    let p = document.createElement('p');
                    p.className = 'small mb-0';
                    p.textContent = message.message;

                    messageContent.appendChild(strong);
                    messageContent.appendChild(p);
                    messageDiv.appendChild(messageContent);

                    messagesContainer.appendChild(messageDiv);
                });
            })
            .catch(error => console.error('Error fetching messages:', error));
    }

    // Poll every 5 seconds
    setInterval(fetchMessages, 5000);

    // Initial fetch to populate messages on page load
    fetchMessages();
</script>

@stop
