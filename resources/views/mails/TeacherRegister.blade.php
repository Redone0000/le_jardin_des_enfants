@component('mail::message')
Bienvenue au Jardin des enfants
Voici les informations de votre inscription :

- **Nom**: {{ $lastname }}
- **Prénom**: {{ $firstname }}
- **e-mail**: {{ $email }}
- **Mot de passe**: {{ $password }}
- **Numéro de téléphone**: {{ $phone }}
- **Description**: {{ $description }}


@component('mail::button', ['url' => 'http://127.0.0.1:8000'])
    Visitez notre site
@endcomponent

Merci,<br>
{{ config('app.name') }}
@endcomponent

