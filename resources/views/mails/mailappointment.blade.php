<x-mail::message>
# {{ $appointment->subject }}

 Détails de votre rendez-vous:

- **Jour**: {{ $appointment->day }}
- **Heure**: {{ $appointment->hour }}
- **Nom de l'enfant**: {{ $appointment->child_last_name }}
- **Prénom de l'enfant**: {{ $appointment->child_first_name }}
- **Date de naissance**: {{ $appointment->child_birth_date }}
- **Sexe de l'enfant**: {{ $appointment->child_sex }}
- **Nom du parent**: {{ $appointment->parent_last_name }}
- **Prénom du parent**: {{ $appointment->parent_first_name }}
- **Numéro de téléphone**: {{ $appointment->phone_number }}
- **Adresse e-mail**: {{ $appointment->email }}

<x-mail::button :url="route('appointment.cancel',['id' => $appointment->id, 'token' => $appointment->token])">
Annuler le rendez-vous
</x-mail::button>


<x-mail::button :url="'http://127.0.0.1:8000'">
Visitez notre site
</x-mail::button>

Merci,<br>
{{ config('app.name') }}
</x-mail::message>