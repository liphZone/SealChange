<?php

use App\Http\Controllers\CoinController;
use App\Http\Controllers\FedaPayController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PersonneController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TelegramController;
use App\Http\Controllers\TypeController;
use App\Http\Middleware\Connection;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*Les transaction
Ordre de gestion :
-Perfect money
-Payeer
-MTN
-Flooz
-TMoney
-Bitcoin
*/
//Page formulaire de connexion
Route::get('/',[PageController::class,'formulaireConnexion'])->name('form_login');

//Action connexion
Route::post('connexion',[PageController::class,'actionConnexion'])->name('action_login');

//Page formulaire d'inscription 
Route::get('Inscription',[PageController::class,'formulaireInscription'])->name('form_register');

//Action inscription
Route::post('inscription',[PageController::class,'actionInscription'])->name('action_register');  

//Action mot de passe oublier Part I
Route::post('mot de passe1',[PageController::class,'actionPasswordForgetOne'])->name('action_password_forget_one');

// Page formulaire de recup mot de passe 
Route::get('mot de passe/{user}/{pwd}',[PageController::class,'formulairePasswordForget'])->name('form_password_forget');

//Action mot de passe oublier Part II
Route::post('motdepasse2',[PageController::class,'actionPasswordForgetTwo'])->name('action_password_forget_two');

//Page formulaire validation de compte
Route::get('Validation',[PageController::class,'formulaireValidationCompte'])->name('form_confirm_account');

//Route action validation de compte
Route::post('validation',[PageController::class,'actionValidationCompte'])->name('action_confirm_account');


//Page Test
Route::get('Test',[PageController::class,'formulaireTest'])->name('form_test');

//Action test
Route::post('test',[PageController::class,'actionTest'])->name('action_test');


//GROUPE MIDDLEWARE **************************************
Route::group(['middleware' => ['Connect']], function () {
    
//Page index du client
Route::get('index',[PageController::class,'index'])->name('index');

//Page accueil du client
Route::get('accueil',[PageController::class,'accueil'])->name('accueil');

//Page index de l'administrateur
Route::get('index admin',[PageController::class,'indexAdmin'])->name('index_admin');

//Page accueil de l'administrateur
Route::get('accueil admin',[PageController::class,'accueilAdmin'])->name('accueil_admin');

//Resource Personne
Route::resource('personnes',PersonneController::class)->names([
    'index'  => 'list_persons',
    'create' => 'add_person'
]);

//Resource Type (Le type de monnaie)
Route::resource('types',TypeController::class)->names(
[
    'index'  => 'list_types',
    'create' => 'add_type',
    'edit'   => 'edit_type',
]);

//Resource coin
Route::resource('coins',CoinController::class)->names(
[
    'index'  => 'list_coins',
    'create' => 'add_coin',
    'edit'   => 'edit_coin',
]);

//Resource taux
Route::resource('rates',RateController::class)->names(
    [
        'index'  => 'list_rates',
        'create' => 'add_rate',
        'edit'   => 'edit_rate',
    ]);

/* ********************************* LES TRANSACTIONS ******************************** */

//Action waiting Perfect Money : j'envoie les donnees passé dans l'URL vers la page commande
Route::post('en attente perfect money',[TransactionController::class,'actionWaitingSendPerfectMoney'])->name('action_waiting_perfect_money');

//Action waiting Payeer : j'envoie les donnees passé dans l'URL vers la page commande
Route::post('en attente payeer',[TransactionController::class,'actionWaitingSendPayeer'])->name('action_waiting_payeer');

//Action waiting mtn : j'envoie les donnees passé dans l'URL vers la page commande
Route::post('en attente mtn',[TransactionController::class,'actionWaitingSendMtn'])->name('action_waiting_mtn');

//Action waiting Flooz : j'envoie les donnees passé dans l'URL vers la page commande
Route::post('en attente flooz',[TransactionController::class,'actionWaitingSendFlooz'])->name('action_waiting_flooz');

//Action waiting TMoney : j'envoie les donnees passé dans l'URL vers la page commande
Route::post('en attente t money',[TransactionController::class,'actionWaitingSendTMoney'])->name('action_waiting_t_money');

//Action waitin btc  : j'envoie les donnees passé dans l'URL vers la page commande
Route::post('en attente btc',[TransactionController::class,'actionWaitingSendBtc'])->name('action_waiting_bitcoin');

//Action waiting AdvCash : j'envoie les donnees passé dans l'URL vers la page commande
Route::post('en attente advcash',[TransactionController::class,'actionWaitingSendAdvCash'])->name('action_waiting_advcash');

//Action waiting Limo : j'envoie les donnees passé dans l'URL vers la page commande
Route::post('en attente limo',[TransactionController::class,'actionWaitingSendLimo'])->name('action_waiting_limo');

//Page Perfect Money du serveur Perfect Money
Route::post('perfect money payement',[TransactionController::class,'formulaireActionPerfectMoney'])->name('form_action_perfect_money');

//Action envoie payeer
Route::post('payeer payement',[TransactionController::class,'actionSendPayeer'])->name('action_payeer');

//Action envoie flooz/Mtn
Route::post('Mobile Money',[TransactionController::class,'actionSendMobileMoney'])->name('action_mobile_money');

//Action envoie t money
Route::post('t money',[TransactionController::class,'actionSendTMoney'])->name('action_t_money');

//Action envoie Bitcoin
Route::post('bitcoin payement',[TransactionController::class,'actionSendBitcoin'])->name('action_bitcoin');

//Page AdvCash du serveur AdvCash
Route::post('advCash',[TransactionController::class,'actionSendAdvcash'])->name('action_advcash');

//Page Limo 
Route::post('Limo payement',[TransactionController::class,'actionSendLimo'])->name('action_limo');

//Confirmation payement Flooz
Route::get('confirmer payement flooz',[TransactionController::class,'confirmationPayementFlooz'])->name('payment_confirmation');

//Formulaire de choix Historique d'une transaction
Route::get('Choix',[TransactionController::class,'formulaireChoixHistorique'])->name('form_choix_historique');

//Formulaire historique des transaction 
Route::get('Historique/{id}',[TransactionController::class,'formulaireHistorique'])->name('form_historique');

//Action bouton valider transaction depuis la reception de mail
Route::get('Valider transaction/{id_transaction}',[TransactionController::class,'actionValidateTransaction'])->name('action_validate_transaction');

//Action FedaPay
Route::post('transaction mobile money',[FedaPayController::class,'actionFedaPay'])->name('action_feda_pay');

//Page Fade Pay :transaction finalisé
// Route::get('Transaction compte mobile',[FedaPayController::class],'pageFedaPay')->name('form_feda_pay');
/* ********************************* FIN TRANSACTIONS ******************************** */

    
//Page mon profil
Route::get('Mon profil',[PageController::class,'monProfil'])->name('profile');

//Page mon profil administrateur
Route::get('profil admin',[PageController::class,'profilAdmin'])->name('profile_admin');

//Action profil
Route::post('profil',[PageController::class,'actionProfil'])->name('action_profile');

//Page formulaire de modification mot de passe
Route::get('Modifier mot de passe',[PageController::class,'formulaireUpdatePassword'])->name('form_password_update');

//Page formulaire de modification mot de passe pour l'admin
Route::get('Modifier mot de passe admin',[PageController::class,'formulaireUpdatePasswordAdmin'])->name('form_password_update_admin');

//Action modification mot de passe
Route::post('modifier mot de passe',[PageController::class,'actionUpdatePassword'])->name('action_password_update');

//Liste des utilisateurs
Route::get('Liste des utilisateurs',[PageController::class,'listeUtilisateurs'])->name('list_users');

//Action Promouvoir Utilisateur
Route::get('Promotion/{id}',[PageController::class,'promouvoir'])->name('upgrade');

//Action Promouvoir Utilisateur
Route::get('Destitution/{id}',[PageController::class,'retrograder'])->name('retrograde');

//Deconnexion
Route::get('deconnexion',[PageController::class,'deconnexion'])->name('logout');

});



