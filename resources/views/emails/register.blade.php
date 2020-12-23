@component('mail::message')
SealChange vous remercie de votre inscription, 

veuillez valider votre compte en cliquant sur le bouton ci-dessous pour terminer votre inscription, merci.

@component('mail::button', ['url' => route('confirm',[$user,$user->token])])
Valider mon compte
@endcomponent

Merci,<br>
{{ config('app.name') }}
@endcomponent
