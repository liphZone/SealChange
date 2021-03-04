<?php

namespace App\Http\Controllers;

use App\Models\Coin;
use App\Models\Type;
use App\Models\Personne;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\TransactionMail;
use MercurySeries\Flashy\Flashy;
use Illuminate\Support\Facades\Mail;
use charlesassets\LaravelPerfectMoney\PerfectMoney;
use Illuminate\Support\Facades\Redirect;

class TransactionController extends Controller
{

    /****************************** PERFECT MONEY *************************************/

    public function actionWaitingSendPerfectMoney(){   
        $id               = random_int(50000,90000);
        $montant          = request('amount');
        $coin_enter       = request('coin_enter_pm');
        $coin_out         = request('coin_out_pm');
        $accountid        = request('accountid');
        $total            = request('total');
        $password         = request('pwd');
        $moncompte        = request('myaccount');
        $devise_enter     = request('devise_enter_pm');
        $devise_out       = request('devise_out_pm');
        $account_receive  = request('accountreceive');
        $user             = auth()->user()->personne_id;
        $payee_name       = auth()->user()->email;

        return view('transactions.commande',compact('id','coin_enter','coin_out','montant','total','moncompte',
        'devise_enter','devise_out','account_receive','user','payee_name'));
    }

    public function formulaireActionPerfectMoney(){
        $account_receive  = request('account_receive');
        $montant          = request('montant');
        $moncompte        = request('moncompte');
        $devise_enter     = request('devise_enter');
        $devise_out       = request('devise_out');
        $id               = random_int(50000,90000);
        $payee_name       = auth()->user()->email;

        $insertion = Transaction::firstOrCreate([
            // 'reference'          => str_random(5),
            'identifiant'        => $id,
            'coin_enter'         => request('coin_enter'),
            'coin_out'           => request('coin_out'),
            'amount'             => $montant,
            'devise_enter'       => $devise_enter,
            'devise_out'         => request('devise_out'),
            // 'payement_reference' => 'REF'.str_random(20),
            'account_sender'     => request('moncompte'),
            'account_receiver'   => request('account_receive'),
            'etat'               => 0,
            'user'               => auth()->user()->id,
        ]);
         if ($insertion) {
            return view('transactions.perfectmoney',compact('account_receive','montant','moncompte','devise_enter','devise_out','id','payee_name'));
        } else {
            Flashy::error('Erreur');
            return back();
        }
    }
    /**************************** FIN PERFECT MONEY **********************************/

    /****************************** MTN *************************************/
    public function  actionWaitingSendMtn(){
        $id_transaction     = rand();
        $montant            = request('amount');
        $montant_a_recevoir = request('having_amount');
        $coin_enter         = request('coin_enter_mtn');
        $coin_out           = request('coin_out_mtn');
        $devise_enter       = request('devise_enter_mtn');
        $devise_out         = request('devise_out');
        $account_receive    = request('account_receiver');
        $user               = auth()->user()->personne_id;
        return view('transactions.commande',compact('id_transaction','montant','montant_a_recevoir','coin_enter','coin_out',
        'devise_enter','devise_out','account_receive','user'));
    }

    public function actionSendMtn(){
        //Enregistrement dans la base de donnees:
        $reference          =  Str::random(10);
        $id_transaction     = request('id_transaction');
        $montant            = request('amount');
        $montant_a_recevoir = request('having_amount');
        $user               = auth()->user()->id;

        $insertion = Transaction::firstOrCreate([
            'reference'        => $reference,
            'coin_enter'       => request('coin_enter'),
            'coin_out'         => request('coin_out'),
            'amount'           => $montant,
            'having_amount'    => $montant_a_recevoir,
            'id_transaction'   => $id_transaction,
            'devise_enter'     => request('devise_enter'),
            'devise_out'       => request('devise_out'),
            'account_receiver' => request('account_receive'),
            'etat'             => 0,
            'user'             => $user,
        ]);
        if ($insertion) {
            return view('transactions.mobile_money',compact('montant','user'));
        } else {
            Flashy::error('Erreur');
            return back();
        }
    }



    /****************************** FIN MTN *************************************/

   

    /****************************** FLOOZ *************************************/

    public function actionWaitingSendFlooz(){
        $id_transaction     = rand();
        $montant            = request('amount');
        $montant_a_recevoir = request('having_amount');
        $coin_enter         = request('coin_enter_flooz');
        $coin_out           = request('coin_out_flooz');
        $devise_enter       = request('devise_enter_flooz');
        $devise_out         = request('devise_out');
        $account_receive    = request('account_receiver');
        $user               = auth()->user()->personne_id;

        return view('transactions.commande',compact('id_transaction','montant','montant_a_recevoir','coin_enter','coin_out',
        'devise_enter','devise_out','account_receive','user'));
    }

    public function actionSendMobileMoney(){
        //Enregistrement dans la base de donnees:
        $reference          = Str::random(10);
        $id_transaction     = request('id_transaction');
        $montant            = request('amount');
        $montant_a_recevoir = request('having_amount');
        $user               = auth()->user()->id;

        $insertion = Transaction::firstOrCreate([
            'reference'        => $reference,
            'coin_enter'       => request('coin_enter'),
            'coin_out'         => request('coin_out'),
            'amount'           => $montant,
            'having_amount'    => $montant_a_recevoir,
            'id_transaction'   => $id_transaction,
            'devise_enter'     => request('devise_enter'),
            'devise_out'       => request('devise_out'),
            'account_receiver' => request('account_receive'),
            'etat'             => 0,
            'user'             => $user,
        ]);
        if ($insertion) {
            return view('transactions.mobile_money',compact('montant','user'));
        } else {
            Flashy::error('Erreur');
            return back();
        }
    }

    public function formulaireMobileMoney(){
        return view('transactions.mobile_money');
    }

    /**************************** FIN FLOOZ **********************************/



    /****************************** T MONEY *************************************/

    public function actionWaitingSendTMoney(){
        $id              = random_int(50000,90000);
        $montant         = request('amount');
        $coin_enter      = request('coin_enter_tm');
        $coin_out        = request('coin_out_tm');
        $total           = request('total');
        $devise_enter    = request('devise_enter_tm');
        $devise_out      = request('devise_out');
        $account_receive = request('account_receiver');
        $user            = auth()->user()->personne_id;
        return view('transactions.commande',compact('id','coin_enter','coin_out','montant','total','devise_enter','devise_out','account_receive','user'));
    }

    public function actionSendTMoney(){
        $reference          = Str::random(10);
        $id_transaction     = rand();
        
        $insertion = Transaction::firstOrCreate([
            'reference'        => $reference ,
            'identifiant'      => 'ID-'.random_int(50000,90000),
            'amount'           => request('montant'),
            'coin_enter'       => request('coin_enter_tm'),
            'coin_out'         => request('coin_out_tm'),
            'account_receiver' => request('account_receive'),
            'etat'             => 0,
            'user'             => auth()->user()->id,
        ]);
        if ($insertion) {
            return redirect("https://paygateglobal.com/v1/page?token=93a934d5-557e-465d-99e3-ab0f821e419f&amount=".request('montant')."&description=".request('account_receive')."&identifier=".$id_transaction);
        } else {
            Flashy::error('Erreur');
            return back();
        }
    }

    /**************************** FIN T MONEY **********************************/



    /****************************** PAYEER *************************************/

    public function actionWaitingSendPayeer(){
        $montant            = request('amount');
        $montant_a_recevoir = request('having_amount');
        $coin_enter         = request('coin_enter_payeer');
        $coin_out           = request('coin_out_payeer');
        $moncompte          = request('myaccount');
        $devise_enter       = request('devise_enter_payeer');
        $devise_out         = request('devise_out');
        $id_transaction     = request('id_transaction');
        $user               = auth()->user()->personne_id;

        $phone = array(
            "Sénégal"       => 221, 
            "Mali"          => 223, 
            "Guinée"        => 224, 
            "Côte d'Ivoire" => 225, 
            "Burkina Faso"  => 226, 
            "Niger"         => 227, 
            "Togo"          => 228, 
            "Bénin"         => 229, 
            "Ghana"         => 233, 
            "Cameroun"      => 237, 
            "Gabon"         => 241, 
            ); 
            $trie = ksort($phone);
        return view('transactions.commande',compact('montant','montant_a_recevoir','coin_enter','coin_out','moncompte',
        'devise_enter','devise_out','id_transaction','user','phone'));
    }

    public function actionSendPayeer(){

        $reference          = Str::random(10);
        $montant            = request('amount');
        $montant_a_recevoir = request('having_amount');
        $id_transaction     = request('id_transaction');
        $devise_enter       = request('devise_enter');
        $devise_out         = request('devise_out');
        $telephone          = request('indicatif')." ".request('telephone');
        $moncompte          = request('myaccount');
        $coin_enter         = request('coin_enter');
        $coin_out           = request('coin_out');
        $account_receiver   = request('account_receiver');

        $user          = Personne::where('id',auth()->user()->personne_id)->first();
        $monnaie_enter = Coin::where('id',$coin_enter)->first();
        $monnaie_out   = Coin::where('id',$coin_out)->first();
        //Je recupere les informations de l'utilisateur pour utiliser 'id_transaction'
        $transaction   = Transaction::where('user',auth()->user()->id)->first();

        if ($transaction === null) {
            $insertion = Transaction::firstOrCreate([
                'id_transaction' => $id_transaction,
            ],
            [
                'reference'        => $reference,
                'coin_enter'       => $coin_enter,
                'coin_out'         => $coin_out,
                'amount'           => $montant,
                'having_amount'    => $montant_a_recevoir,
                'devise_enter'     => $devise_enter,
                'devise_out'       => $devise_out,
                'telephone'        => $telephone,
                'myaccount'        => $moncompte,
                'account_receiver' => $account_receiver,
                'etat'             => 0,
                'user'             => auth()->user()->id,
            ]);
            if ($insertion) {
                Mail::to('philippesf3@gmail.com')->queue(new TransactionMail($monnaie_enter->libelle,$monnaie_out->libelle,$montant,$montant_a_recevoir,$id_transaction,$user->nom,$user->prenom,$user->email));
                Flashy::success('En cours de traitement ...');
                return view('transactions.transaction',compact('montant','montant_a_recevoir','coin_enter','coin_out','devise_out'));
            } else {
                Flashy::error('Erreur');
                return back();
            }
        }
        elseif($transaction->id_transaction === $id_transaction){
            return view('transactions.transaction',compact('montant','montant_a_recevoir','coin_enter','coin_out','devise_out'));
        }


    }

    /**************************** FIN PAYEER **********************************/




    /*****************************  ADVCASH ************************************/

    public function actionWaitingSendAdvCash(){
        $id               = random_int(50000,90000);
        $montant          = request('amount');
        $coin_enter       = request('coin_enter_adv');
        $coin_out         = request('coin_out_adv');
        $accountid        = request('accountid');
        $total            = request('total');
        $moncompte        = request('myaccount');
        $devise_enter     = request('devise_enter_adv');
        $devise_out       = request('devise_out');
        $account_receive  = request('account_receiver');
        $user             = auth()->user()->personne_id;
        $email            = request('email') ;

        return view('transactions.commande',compact('id','coin_enter','coin_out','montant','total','moncompte',
        'devise_enter','devise_out','account_receive','user','email'));
    }

    public function formulaireAdvCash(){
        $account_receive  = request('account_receive');
        $montant          = request('montant');
        $moncompte        = request('moncompte');
        $devise_enter     = request('devise_enter');
        $devise_out       = request('devise_out');
        $id               = request('id');
        $email            = auth()->user()->email;
        // $reference        = str_random(50);

        // $insertion = Transaction::firstOrCreate([
        //     'reference'          => str_random(5),
        //     'identifiant'        => $id,
        //     'coin_enter'         => request('coin_enter'),
        //     'coin_out'           => request('coin_out'),
        //     'amount'             => $montant,
        //     'devise_enter'       => $devise_enter,
        //     'devise_out'         => request('devise_out'),
        //     'payement_reference' => 'REF'.str_random(20),
        //     'account_sender'     => request('moncompte'),
        //     'account_receiver'   => request('account_receive'),
        //     'etat'               => 0,
        //     'user'               => auth()->user()->id,
        // ]);
        //  if ($insertion) {
            return view('transactions.advcash',compact('account_receive','montant','moncompte','devise_enter','devise_out','id','email','reference'));
        // } else {
        //     Flashy::error('Erreur');
        //     return back();
        // }
    }

    /**************************** FIN ADVCASH **********************************/

    public function confirmationPayementFlooz(Request $request){
        $utilisateur = Transaction::where('reference',request('identifier'))->first();
        $save = $utilisateur->where('etat',0)->update([
            'tx_reference_flooz' => request('tx_reference'),
            'payement_method'    => request('payement_method'),
            'payement_reference' => request('payement_reference'),
            'telephone'          => request('phone_number'),
            'etat'               => 1,
        ]);
        if ($save) {
            Flashy::success('Envoie confirmé');
        }
    }


    public function  formulaireTransaction(){
        return view('transactions.transaction');
    }

    public function formulaireChoixHistorique(){
        $categorie = Type::all();
        $monnaie =Coin::all();
        return view('historiques.choix_historique',compact('categorie','monnaie'));
    }

    public function formulaireHistorique(){
        return view('historiques.historique');
    }
}
