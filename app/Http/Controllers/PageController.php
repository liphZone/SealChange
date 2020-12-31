<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Personne;
use App\Mail\RegisterMail;
use Illuminate\Http\Request;
use App\Mail\PasswordForgetMail;
use MercurySeries\Flashy\Flashy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\PersonneFormRequest;
use App\Http\Requests\InscriptionFormRequest;
use App\Http\Requests\PasswordForgetFormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class PageController extends Controller
{
    public function index(){
        return view('layout.client.index');
    }

    public function accueil(){
        return view('layout.client.accueil');
    }

    public function indexAdmin(){
        return view('layout.admin.index');
    }

    public function accueilAdmin(){
        return view('layout.admin.accueil');
    }

    public function profilAdmin(){
        $personne = Personne::where('id',auth()->user()->id)->first();
        return view('layout.admin.profil',compact('personne'));
    }

    public function monProfil(){
        $personne = Personne::where('id',auth()->user()->id)->first();
        return view('layout.client.profil',compact('personne'));
    }

    public function actionProfil(){
        $utilisateur = Personne::where('id',Auth::user()->personne_id)->first();
        $update = $utilisateur->update([
            'sexe'    => request('sexe'),
            'date'    => request('date'),
            'contact' => request('contact'),
            'pays'    =>  request('pays'),
            'region'  => request('region'),
            'ville'   => request('ville'),
            'adresse' => request('adresse')
            ]);

        if ($update) {
            Flashy::success('Mise à jour réussie');
            return back();
        }else{
            Flashy::error('Echec !');
            return back();
        }
    }

    public function formulaireInscription(){
        return view('pages.inscription');
    }

    public function listeUtilisateurs(){
        $client = DB::table('personnes')
        ->where('type_utilisateur','Client')
        ->join('users','personnes.id','=','users.personne_id')->get();
        return view('layout.admin.list_utilisateurs',compact('client'));
    }

    public function actionInscription(InscriptionFormRequest $i, PersonneFormRequest $p){
        $personne = Personne::firstOrCreate([
            'nom'    => $p->nom,
            'prenom' => $p->prenom,
            'email'  => $p->email,
        ]);

        $user = User::firstOrCreate([
            'email'    => $personne->email,
            'password' => bcrypt($p->password),
            'token'    => str_random(60),
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
            Flashy('Votre compte a été validé, vous pouvez vous connecter');
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
        $user = Auth::user();
        if ($try_connexion) {
            if ($user->email_verified_at === null AND $user->token != null ) {
                Flashy::error("Echec de validation");
                return back();
            }
            if (auth()->user()->type_utilisateur === 'Super_admin' || auth()->user()->type_utilisateur === 'Admin') {
                Flashy::success('Bienvenu sur votre page');
                return redirect()->route('accueil_admin');
            }elseif (auth()->user()->type_utilisateur === 'Client') {
                Flashy::success('Bienvenu sur votre page');
                return redirect()->route('accueil');
            }
        } else {
            Flashy::error('Erreur! email ou mot de passe incorrect');
            return back();
        }        
    }

    public function formulaireUpdatePassword(){
        return view('layout.client.password_update');
    }

    public function formulaireUpdatePasswordAdmin(){
        return view('layout.admin.password_update');
    }

    public function actionUpdatePassword(){
        request()->validate([
            'password' => ['required', 'confirmed', 'min:4'],
            'password_confirmation' => ['required'],
        ]);
        $utilisateur = User::where('id',Auth::user()->personne_id)->first();
        if ($utilisateur) {
            $update = $utilisateur->update(['password' => bcrypt(request('password'))]);
            if ($update) {
                Flashy::success('Votre mot de passe a été changé avec succès');
                return back();
            } else {
                Flashy::error('Echec lors de la modification du mot de passe !');
                return back();
            }
        } else {
            Flashy::warning('Utilisateur non reconnu');
            return back();
        }
        return back();
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
    
    public function confirmationPayement(){

    }


    

    public function deconnexion(){
        $dec = Auth::logout();
        Flashy::success('Vous êtes déconnecté(e).');
        return redirect('/');
    }
}
