<?php

use App\Http\Controllers\CoinController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PayementController;
use App\Http\Controllers\PersonneController;
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

//Resource Payement
Route::resource('payements',PayementController::class)->names([
    'index'  => 'list_payments',
    'create' => 'add_payment'
]);

//Confirmation payement
Route::get('confirmer payement',[PageController::class,'confirmationPayement'])->name('payment_confirmation');

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
]);

//Resource coin
Route::resource('coins',CoinController::class)->names(
[
    'index'  => 'list_coins',
    'create' => 'add_coin',
]);

//Page formulaire de transaction
Route::get('Transaction/{id}',[PageController::class,'formulaireTransaction'])->name('form_deal');

//Action Transaction
Route::post('transaction',[PageController::class,'actionTransaction'])->name('action_deal');
    
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



