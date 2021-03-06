@component('mail::message')
Nouvelle transaction 

Utilisateur : {{ "$nom $prenom" }} 
<br>    
Email  L'utilisateur : {{ $email }}
<br>
Contact : {{ $telephone }}
<br>
Commande : Transfert de {{ $monnaie_enter }} vers {{ $monnaie_out }}.
<br>

Id de la transaction : {{ $id_transaction }}
<br>

Montant en entrée : {{ $montant }}
<br>

Montant à reçevoir : {{ $montant_r }}

@component('mail::button', ['url' => route('action_validate_transaction',$id_transaction)])
Terminer transaction
@endcomponent 
<br>
Veuillez traiter cette transaction en attente.
<p class="text-danger"> Veuillez cliquer sur le bouton après avoir traité la requête de transaction.Merci </p>
{{ config('app.name') }}
@endcomponent
