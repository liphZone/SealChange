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
        $id_transaction = rand();
        return view('layout.client.accueil',compact('categorie','monnaie','id_transaction'));
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
        $phone = array(
            "Etats Unis d'Amérique" => 1, 
            "Canada" => 1, 
            "Fédération russe" => 7, 
            "Kazakhstan" => 7, 
            "Ouzbekistan" => 7, 
            "Egypte" => 20, 
            "Afrique du Sud" => 27, 
            "Grèce" => 30, 
            "Pays-Bas" => 31, 
            "Belgique" => 32, 
            "France" => 33, 
            "Espagne" => 34, 
            "Hongrie" => 36, 
            "Italie" => 39, 
            "Vatican" => 39, 
            "Roumanie" => 40, 
            "Liechtenstein" => 41, 
            "Suisse" => 41, 
            "Autriche" => 43, 
            "Royaume-Uni" => 44, 
            "Danemark" => 45, 
            "Suède" => 46, 
            "Norvège" => 47, 
            "Pologne" => 48, 
            "Allemagne" => 49, 
            "Pérou" => 51, 
            "Mexique Centre" => 52, 
            "Cuba" => 53, 
            "Argentine" => 54, 
            "Brésil" => 55, 
            "Chili" => 56, 
            "Colombie" => 57, 
            "Vénézuela" => 58, 
            "Malaisie" => 60, 
            "Australie" => 61, 
            "Ile Christmas" => 61, 
            "Indonésie" => 62, 
            "Philippines" => 63, 
            "Nouvelle-Zélande" => 64, 
            "Singapour" => 65, 
            "Thaïlande" => 66, 
            "Japon" => 81, 
            "Corée du Sud" => 82, 
            "Viêt-Nam" => 84, 
            "Chine" => 86, 
            "Turquie" => 90, 
            "Inde" => 91, 
            "Pakistan" => 92, 
            "Afghanistan" => 93, 
            "Sri Lanka" => 94, 
            "Union Birmane" => 95, 
            "Iran" => 98, 
            "Maroc" => 212, 
            "Algérie" => 213, 
            "Tunisie" => 216, 
            "Libye" => 218, 
            "Gambie" => 220, 
            "Sénégal" => 221, 
            "Mauritanie" => 222, 
            "Mali" => 223, 
            "Guinée" => 224, 
            "Côte d'Ivoire" => 225, 
            "Burkina Faso" => 226, 
            "Niger" => 227, 
            "Togo" => 228, 
            "Bénin" => 229, 
            "Maurice" => 230, 
            "Libéria" => 231, 
            "Sierra Leone" => 232, 
            "Ghana" => 233, 
            "Nigeria" => 234, 
            "République du Tchad" => 235, 
            "République Centrafricaine" => 236, 
            "Cameroun" => 237, 
            "Cap-Vert" => 238, 
            "Sao Tomé-et-Principe" => 239, 
            "Guinée équatoriale" => 240, 
            "Gabon" => 241, 
            "Bahamas" => 242, 
            "Congo" => 242, 
            "Congo Zaïre (Rep. Dem.)" => 243, 
            "Angola" => 244, 
            "Guinée-Bissao" => 245, 
            "Barbade" => 246, 
            "Ascension" => 247, 
            "Seychelles" => 248, 
            "Soudan" => 249, 
            "Rwanda" => 250, 
            "Ethiopie" => 251, 
            "Somalie" => 252, 
            "Djibouti" => 253, 
            "Kenya" => 254, 
            "Tanzanie" => 255, 
            "Ouganda" => 256, 
            "Burundi" => 257, 
            "Mozambique" => 258, 
            "Zambie" => 260, 
            "Madagascar" => 261, 
            "Réunion" => 262, 
            "Zimbabwe" => 263, 
            "Namibie" => 264, 
            "Malawi" => 265, 
            "Lesotho" => 266, 
            "Botswana" => 267, 
            "Antigua-et-Barbuda" => 268, 
            "Swaziland" => 268, 
            "Mayotte" => 269, 
            "République comorienne" => 269, 
            "Saint Hélène" => 290, 
            "Erythrée" => 291, 
            "Aruba" => 297, 
            "Ile Feroe" => 298, 
            "Groà«nland" => 299, 
            "Iles vierges américaines" => 340, 
            "Iles Caïmans" => 345, 
            "Espagne" => 349, 
            "Gibraltar" => 350, 
            "Portugal" => 351, 
            "Luxembourg" => 352, 
            "Irlande" => 353, 
            "Islande" => 354, 
            "Albanie" => 355, 
            "Malte" => 356, 
            "Chypre" => 357, 
            "Finlande" => 358, 
            "Bulgarie" => 359, 
            "Lituanie" => 370, 
            "Lettonie" => 371, 
            "Estonie" => 372, 
            "Moldavie" => 373, 
            "Arménie" => 374, 
            "Biélorussie" => 375, 
            "Andorre" => 376, 
            "Monaco" => 377, 
            "Saint-Marin" => 378, 
            "Ukraine" => 380, 
            "Yougoslavie" => 381, 
            "Croatie" => 385, 
            "Slovénie" => 386, 
            "Bosnie-Herzégovine" => 387, 
            "Macédoine" => 389, 
            "Italie" => 390, 
            "République Tchèque" => 420, 
            "Slovaquie" => 421, 
            "Liechtenstein" => 423, 
            "Bermudes" => 441, 
            "Grenade" => 473, 
            "Iles Falklands" => 500, 
            "Belize" => 501, 
            "Guatemala" => 502, 
            "Salvador" => 503, 
            "Honduras" => 504, 
            "Nicaragua" => 505, 
            "Costa Rica" => 506, 
            "Panama" => 507, 
            "Haïti" => 509, 
            "Guadeloupe" => 590, 
            "Bolivie" => 591, 
            "Guyane" => 592, 
            "Equateur" => 593, 
            "Guinée Française" => 594, 
            "Paraguay" => 595, 
            "Antilles Françaises" => 596, 
            "Suriname" => 597, 
            "Uruguay" => 598, 
            "Antilles hollandaise" => 599, 
            "Saint Eustache" => 599, 
            "Saint Martin" => 599, 
            "Turks et caicos" => 649, 
            "Monteserrat" => 664, 
            "Saipan" => 670, 
            "Guam" => 671, 
            "Antarctique-Casey" => 672, 
            "Antarctique-Scott" => 672, 
            "Ile de Norfolk" => 672, 
            "Brunei Darussalam" => 673, 
            "Nauru" => 674, 
            "Papouasie - Nouvelle Guinée" => 675, 
            "Tonga" => 676, 
            "Iles Salomon" => 677, 
            "Vanuatu" => 678, 
            "Fidji" => 679, 
            "Palau" => 680, 
            "Wallis et Futuna" => 681, 
            "Iles Cook" => 682, 
            "Niue" => 683, 
            "Samoa Américaines" => 684, 
            "Samoa occidentales" => 685, 
            "Kiribati" => 686, 
            "Nouvelle-Calédonie" => 687, 
            "Tuvalu" => 688, 
            "Polynésie Française" => 689, 
            "Tokelau" => 690, 
            "Micronésie" => 691, 
            "Marshall" => 692, 
            "Sainte-Lucie" => 758, 
            "Dominique" => 767, 
            "Porto Rico" => 787, 
            "République Dominicaine" => 809, 
            "Saint-Vincent-et-les Grenadines" => 809, 
            "Corée du Nord" => 850, 
            "Hong Kong" => 852, 
            "Macao" => 853, 
            "Cambodge" => 855, 
            "Laos" => 856, 
            "Trinité-et-Tobago" => 868, 
            "Saint-Christophe-et-Niévès" => 869, 
            "Atlantique Est" => 871, 
            "Marisat (Atlantique Est)" => 872, 
            "Marisat (Atlantique Ouest)" => 873, 
            "Atlantique Ouest" => 874, 
            "Jamaïque" => 876, 
            "Bangladesh" => 880, 
            "Taiwan" => 886, 
            "Maldives" => 960, 
            "Liban" => 961, 
            "Jordanie" => 962, 
            "Syrie" => 963, 
            "Iraq" => 964, 
            "Koweït" => 965, 
            "Arabie saoudite" => 966, 
            "Yémen" => 967, 
            "Oman" => 968, 
            "Palestine" => 970, 
            "Emirats arabes unis" => 971, 
            "Israà«l" => 972, 
            "Bahreïn" => 973, 
            "Qatar" => 974, 
            "Bhoutan" => 975, 
            "Mongolie" => 976, 
            "Népal" => 977, 
            "Tadjikistan (Rep. du)" => 992, 
            "Turkménistan" => 993, 
            "Azerbaïdjan" => 994, 
            "Géorgie" => 995, 
            "Kirghizistan" => 996, 
            "Bahamas" => 1242, 
            "Barbade" => 1246, 
            "Anguilla" => 1264, 
            "Antigua et Barbuda " => 1268, 
            "Vierges Britanniques (Iles)" => 1284, 
            "Vierges Américaines (Iles)" => 1340, 
            "Cayman (Iles)" => 1345, 
            "Bermudes" => 1441, 
            "Grenade" => 1473, 
            "Turks et Caïcos (Iles)" => 1649, 
            "Montserrat" => 1664, 
            "Sainte-Lucie" => 1758, 
            "Dominique" => 1767, 
            "Saint-Vincent-et-Grenadines" => 1784, 
            "Porto Rico" => 1787, 
            "Hawaï" => 1808, 
            "Dominicaine (Rep.)" => 1809, 
            "Saint-Vincent-et-Grenadines" => 1809, 
            "Trinité-et-Tobago" => 1868, 
            "Saint-Kitts-et-Nevis" => 1869, 
            "Jamaïque" => 1876, 
            "Norfolk (Ile)" => 6723 
            ); 
            $trie = ksort($phone);
        $personne = Personne::where('id',auth()->user()->id)->first();
        return view('layout.client.profil',compact('personne','phone'));
    }

    public function actionProfil(PersonneFormRequest $request){
        $utilisateur = Personne::where('id',Auth::user()->personne_id)->first();
      
        if (isset($request->identity) === null && isset($request->image_justificative) === null) {
            $identity = $request->identity->store('Zone','public');
            $image_justificative = $request->image_justificative->store('Zone','public');
            $update = $utilisateur->update([
                'sexe'                => request('sexe'),
                'date'                => request('date'),
                'contact'             => request('indicatif')." ".request('contact'),
                'pays'                => request('pays'),
                'region'              => request('region'),
                'ville'               => request('ville'),
                'adresse'             => request('adresse'),
                'identity'            => request('identity'),
                'image_justificative' => request('image_justificative'),
            ]);
        }
        elseif (isset($request->identity) === null) {
            $identity = $request->identity->store('Zone','public');
            $update = $utilisateur->update([
                'sexe'                => request('sexe'),
                'date'                => request('date'),
                'contact'             => request('indicatif')." ".request('contact'),
                'pays'                => request('pays'),
                'region'              => request('region'),
                'ville'               => request('ville'),
                'adresse'             => request('adresse'),
                'identity'            => $identity,
            ]);
        }
        elseif (isset($request->image_justificative) === null) {
            $image_justificative = $request->image_justificative->store('Zone','public');
            $update = $utilisateur->update([
                'sexe'                => request('sexe'),
                'date'                => request('date'),
                'contact'             => request('indicatif')." ".request('contact'),
                'pays'                => request('pays'),
                'region'              => request('region'),
                'ville'               => request('ville'),
                'adresse'             => request('adresse'),
                'image_justificative' => $image_justificative,
            ]);
        }
        else {
            $identity = $request->identity->store('Zone','public');
            $image_justificative = $request->image_justificative->store('Zone','public');
            $update = $utilisateur->update([
                'sexe'                => request('sexe'),
                'date'                => request('date'),
                'contact'             => request('indicatif')." ".request('contact'),
                'pays'                => request('pays'),
                'region'              => request('region'),
                'ville'               => request('ville'),
                'adresse'             => request('adresse'),
                'identity'            => $identity,
                'image_justificative' => $image_justificative,
            ]);
        }
        
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