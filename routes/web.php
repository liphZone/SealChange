<?php

use App\Http\Controllers\CoinController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\TypeController;

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


//Page index du client
Route::get('index',[PageController::class,'index'])->name('index');

//Page accueil du client
Route::get('accueil',[PageController::class,'accueil'])->name('accueil');

//Page index de l'administrateur
Route::get('index admin',[PageController::class,'indexAdmin'])->name('index_admin');

//Page accueil de l'administrateur
Route::get('accueil admin',[PageController::class,'accueilAdmin'])->name('accueil_admin');

//Resource Type (Le type de monnaie)
Route::resource('types',TypeController::class)->names(
[
    'index'  => 'list_types',
    'create' => 'add_type',
]);

Route::resource('coins',CoinController::class)->names(
[
    'index'  => 'list_coins',
    'create' => 'add_coin',
]);

//Page mon profil
Route::get('Mon profil',[PageController::class,'monProfil'])->name('profile');

//Page mon profil administrateur
Route::get('profil admin',[PageController::class,'profilAdmin'])->name('profile_admin');

//Page formulaire d'inscription
Route::get('Inscription',[PageController::class,'formulaireInscription'])->name('form_register');

//Action inscription
Route::post('inscription',[PageController::class,'actionInscription'])->name('action_register');

//Route token
Route::get('confirm/{user}/{token}',[PageController::class,'validationCompte'])->name('confirm');

//Page formulaire de connexion
Route::get('/',[PageController::class,'formulaireConnexion'])->name('form_login');

//Action connexion
Route::post('connexion',[PageController::class,'actionConnexion'])->name('action_login');

//Page formulaire de modification mot de passe
Route::get('Modifier mot de passe',[PageController::class,'formulaireUpdatePassword'])->name('form_password_update');

//Action modification mot de passe
Route::post('modifier mot de passe',[PageController::class,'actionUpdatePassword'])->name('action_password_update');

// Page formulaire de recup mot de passe 
Route::get('mot de passe',[PageController::class,'formulairePasswordForget'])->name('form_password_forget');

//Action mot de passe oublier
Route::post('mot de passe',[PageController::class,'actionPasswordForget'])->name('action_password_forget');

//Deconnexion
Route::get('deconnexion',[PageController::class,'deconnexion'])->name('logout');