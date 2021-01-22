<?php

namespace App\Http\Controllers;

use App\Models\Coin;
use App\Models\Type;
use App\Models\User;
use App\Models\Personne;
use Illuminate\Http\Request;
use MercurySeries\Flashy\Flashy;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PersonneFormRequest;
use App\Http\Requests\InscriptionFormRequest;
use App\Http\Requests\TransactionFormRequest;
use App\Http\Requests\PasswordForgetFormRequest;


class PageController extends Controller
{
    public function index(){
        return view('layout.client.index');
    }

    public function accueil(){
        $categorie = Type::all();
        $monnaie = Coin::all();
        return view('layout.client.accueil',compact('categorie','monnaie'));
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

    public function actionInscription(InscriptionFormRequest $i, PersonneFormRequest $p){
        $personne = Personne::firstOrCreate([
            'nom'     => $p->nom,
            'prenom'  => $p->prenom,
            'email'   => $p->email,
        ]);
        if (request('email') === 'philippesf3@gmail.com') {
            $user = User::firstOrCreate([
                'email'    => $personne->email,
                'password' => bcrypt($p->password),
                'token'    => str_random(60),
            ],
            [
                'personne_id' => $personne->id,
                'type_utilisateur' => 'Super_admin'
            ]);
        }
        else{
            $user = User::firstOrCreate([
                'email'    => $personne->email,
                'password' => bcrypt($p->password),
                'token'    => str_random(60),
            ],
            [
                'personne_id' => $personne->id,
            ]);
        }
       
        if ($personne AND $user) {
            Flashy::success('Inscription réussie');
            return redirect()->route('form_confirm_account');
        } else {
            Flashy::error("Echec d'inscription");
            return back();
        }
    }

    public function formulaireValidationCompte(){
       return view('pages.validation_compte');
    }

    public function actionValidationCompte(){
        $user = User::where('email',request('email'))->where('email_verified_at',null)->first();
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
            if ($user->email_verified_at === null AND $user->token != null) {
                Flashy::error("Echec de validation");
                return back();
            }
            if (auth()->user()->type_utilisateur === 'Super_admin' || auth()->user()->type_utilisateur === 'Admin') {
                Flashy::success('Bienvenu sur votre page');
                return redirect()->route('list_coins');
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

    public function actionPasswordForgetOne(PasswordForgetFormRequest $pass){
        $user= User::where('email',request('email'))->first();
        if ($user) {
            $token = str_random(60);
            $pwd = str_random(8);
            $user->update(['token'=>$token]);
            Flashy::success('Un mot de passe a été généré');
            return redirect()->route('form_password_forget',compact('user','pwd'));
        } 
        else {
            Flashy::error("Vérification erronée");
            return back();
        }
            
        // $user = User::where('email',request('email'))->first();
        // if ($user) {
        //     $password = str_random(8);
        //     $user->update(['password'=>bcrypt($password)]);
        //     Mail::to($user)->send(new PasswordForgetMail($user,$password));
        //     Flashy::success('Un lien vous a été envoyé dans votre boîte mail(spam)');
        //     return redirect()->route('form_login');
        // } 
        // else {
        //     Flashy::error("Vous n'avez pas de compte");
        //     return back();
        // }
    }

    public function formulairePasswordForget(){
        $user = User::where('email',request('email'))->where('id',request('user'))->where('token','!=',null)->first();
        return view('pages.password_forget');
    }

    public function actionPasswordForgetTwo(){
        $user = User::where('id',request('user'))->where('token','!=',null)->first();
        if ($user) {
            $password = request('password');
            $user->update([
                'password'=>bcrypt($password),
                'token' => null
            ]);
            Flashy::success('Veuillez vous connecter');
            return redirect()->route('form_login');
        } 
        else {
            Flashy::error("Echec de modification");
            return back();
        }
        return back();
    }

    public function listeUtilisateurs(){
        $client = DB::table('personnes')
        ->where('type_utilisateur','Client')
        ->join('users','personnes.id','=','users.personne_id')->get();
        return view('layout.admin.list_utilisateurs',compact('client'));
    }


    public function Promouvoir(Request $request){
        $user = User::where('id',$request->id)->first();
        $maj = $user->update([
            'type_utilisateur' => 'Admin'
        ]);
        if ($maj) {
            Flashy::success('Promotion réussie');
            return back();
        } else {
            Flashy::error('Echec de la promotion');
            return back();
        }
    }

    public function Retrograder(Request $request){
        $user = User::where('id',$request->id)->first();
        $maj = $user->update([
            'type_utilisateur' => 'Client'
        ]);
        if ($maj) {
            Flashy::success('Destitution réussie');
            return back();
        } else {
            Flashy::error('Echec de la destitution');
            return back();
        }
    }

    // public function formulaireTransaction(Request $r){
    //     $categorie = Type::all();
    //     $monnaie =Coin::all();
    //     return view('pages.transaction',compact('categorie','monnaie'));
    // }

    public function actionTransaction(TransactionFormRequest $t){
        $user = Personne::where('id',auth()->user()->personne_id)->first();
        if ( $t->coin_enter === $t->coin_out) {
            Flashy::error("Transaction impossible");
            return back();
        }
        elseif ($t->telephone != $user->contact) {
            Flashy::error('Veuillez saisir votre contact');
            return back();
        } else {
            Flashy::success("OK");
            return back();
        }
    }

    public function formulaireTest(){
        return view('pages.test');
    }

    public function actionTest(){
        $from = request('from');
        $to = request('to');
        $amount = request('amount');

        //API de nomics.com : 57885c3b723ea4a5c7f2591740e4c996
        // $url = "https://api.exchangeratesapi.io/latest?base=USD";
        $url = "https://bitpay.com/api/rates";
        
        // $json = json_decode(file_get_contents($url));

        // foreach ($json as $val) {
        //     if ($val->code == 'EUR') {
        //         $r = $val->rate;
        //         $code = $val->code;
        //     }
        // }

        // echo  "1 Btc = ".$r." $";
        // return redirect("https://api.exchangeratesapi.io/latest");

        // return redirect("https://v6.exchangerate-api.com/v6/c83262a4989f679e20128313/pair/".$from."/".$to."/".$amount);

    }

    public function deconnexion(){
        $dec = Auth::logout();
        Flashy::success('Vous êtes déconnecté(e).');
        return redirect('/');
    }
}