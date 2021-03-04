@component('mail::message')
Nouvelle transaction 

Utilisateur : {{ "$nom $prenom" }} 
<br>    
Email DE L'utilisateur : {{ $email }}
<br>
Commande : Transfert de {{ $monnaie_enter }} vers {{ $monnaie_out }}.
<br>

Id de la transaction : {{ $id_transaction }}
<br>

Montant en entrée : {{ $montant }}
<br>

Montant à reçevoir : {{ $montant_r }}

@component('mail::button', ['url' => ''])
Terminer transaction
@endcomponent 
<br>
Veuillez traiter cette transaction en attente.
<p class="text-danger"> Veuillez cliquer sur le bouton <span class="text-dark"> Terminer transaction </span> après avoir traité la requete de transaction.Merci </p>
{{ config('app.name') }}
@endcomponent
