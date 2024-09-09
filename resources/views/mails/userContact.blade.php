<x-mail::message>
# Bonjour {{ $name }}
# E-mail de {{ $nameSender }}
# Objet {{ $subject }}
{{ $content }}

<x-mail::button :url="$url">
    Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
