@component('mail::message')
Voici les informations de votre inscription :

- **Classe**: {{ $classe }}
- **Nom de l'enfant**: {{ $lastname }}
- **Prénom de l'enfant**: {{ $firstname }}
- **Sexe de l'enfant**: {{ $sexe }}
- **Date de naissance de l'enfant**: {{ $birth_date }}
- **Nom du parent**: {{ $lastname_tutor }}
- **Prénom du parent**: {{ $firstname_tutor }}
- **Adresse e-mail du parent**: {{ $email }}
- **Numéro de téléphone du parent**: {{ $phone }}
- **Mot de passe généré pour le parent**: {{ $password }}
- **Nom du contact d'urgence**: {{ $emergency_contact_name }}
- **Numéro de téléphone du contact d'urgence**: {{ $emergency_contact_phone }}

@component('mail::button', ['url' => 'http://127.0.0.1:8000'])
    Visitez notre site
@endcomponent

Merci,<br>
{{ config('app.name') }}
@endcomponent

