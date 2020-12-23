<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConnexionFormRequest;
use App\Http\Requests\InscriptionFormRequest;
use App\Http\Requests\PasswordForgetFormRequest;
use App\Http\Requests\PersonneFormRequest;
use App\Mail\PasswordForgetMail;
use App\Mail\RegisterMail;
use App\Models\Personne;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use MercurySeries\Flashy\Flashy;

class PageController extends Controller
{
    public function index(){
        return view('layout.index');
    }

    public function accueil(){
        return view('layout.accueil');
    }

    public function monProfil(){
        $personne = Personne::where('id',auth()->user()->id)->first();
        return view('pages.profil',compact('personne'));
    }

    public function formulaireInscription(){
        return view('pages.inscription');
    }

    public function actionInscription(InscriptionFormRequest $i, PersonneFormRequest $p){
        $personne = Personne::firstOrCreate([
            'nom'    => $p->nom,
            'prenom' => $p->prenom,
            'email'  => $p->email,
        ]);

        $user = User::firstOrCreate([
            'email'       => $personne->email,
            'password'    => bcrypt($p->password),
            'token'       => str_random(60),
        ],
        [
            'personne_id' => $personne->id,
        ]);

        Mail::to($user)->send(new RegisterMail($user));

        if ($personne AND $user) {
            Flashy::success('Inscription réussie , Vous avez reçu un mail');
            return redirect()->route('form_login');
        } else {
            Flashy::error("Echec d'inscription");
            return back();
        }
        
    }

    public function validationCompte(User $user,$token){
        if ($user->exists) {
            $user->update([
                'email_verified_at' => now(),
                'token' => null
            ]);
            Flashy('Votre compte a été validé vous pouvez vous connecter');
            return redirect()->route('form_login');
        } else {
            Flashy::error("Echec de validation");
            return back();
        }
        
    }

    public function formulaireConnexion(){
        return view('pages.connexion');
    }

    public function actionConnexion(){
        $try_connexion = Auth::attempt(['email'=>request('email'),'password'=>request('password')]);
        if ($try_connexion) {
            Flashy::success('Bienvenu sur votre page');
            return redirect()->route('index');
        } else {
            Flashy::error('Erreur! email ou mot de passe incorrect');
            return back();
        }        
    }

    public function formulairePasswordForget(){
        return view('pages.password_forget');
    }

    public function actionPasswordForget(PasswordForgetFormRequest $pass){
        $user = User::where('email',request('email'))->first();
        if ($user) {
            $password = str_random(8);
            $user->update(['password'=>bcrypt($password)]);
            Mail::to($user)->send(new PasswordForgetMail($user,$password));
            Flashy::success('Un lien vous a été envoyé dans votre boîte mail(spam)');
            return redirect()->route('form_login');
        } 
        else {
            Flashy::error("Vous n'avez pas de compte");
            return back();
        }
    }

    public function deconnexion(){
        $dec = Auth::logout();
        // Flashy::success('Vous êtes déconnecté(e).');
        return redirect('/');
    }
}
