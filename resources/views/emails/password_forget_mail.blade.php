@component('mail::message')
# Seal Change

Voici votre nouveau mot de passe.

@component('mail::button', ['url' => ''])
{{ $password }}
@endcomponent
Vous pouvez toutefois changer votre mot de passe lorsque vous serez connecté.

Merci,<br>
{{ config('app.name') }}
@endcomponent
