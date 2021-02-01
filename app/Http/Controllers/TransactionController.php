<?php

namespace App\Http\Controllers;

use App\Models\Coin;
use App\Models\Type;
use App\Models\Personne;
use App\Models\Transaction;
use Illuminate\Http\Request;
use MercurySeries\Flashy\Flashy;
use charlesassets\LaravelPerfectMoney\PerfectMoney;

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
            'reference'          => str_random(5),
            'identifiant'        => $id,
            'coin_enter'         => request('coin_enter'),
            'coin_out'           => request('coin_out'),
            'amount'             => $montant,
            'devise_enter'       => $devise_enter,
            'devise_out'         => request('devise_out'),
            'payement_reference' => 'REF'.str_random(20),
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

    public function actionSendPerfectMoney(){
        return redirect("https://perfectmoney.is/api/step1.asp");
    }
    /**************************** FIN PERFECT MONEY **********************************/



    /****************************** FLOOZ *************************************/

    public function actionWaitingSendFlooz(){

        $id              = random_int(50000,90000);
        $montant         = request('amount');
        $coin_enter      = request('coin_enter_flooz');
        $coin_out        = request('coin_out_flooz');
        $total           = request('total');
        $devise_enter    = request('devise_enter_flooz');
        $devise_out      = request('devise_out');
        $account_receive = request('account_receiver');
        $user            = auth()->user()->personne_id;

        return view('transactions.commande',compact('id','coin_enter','coin_out','montant','total','devise_enter','devise_out','account_receive','user'));
    }

    public function actionSendFlooz(){
        //Enregistrement dans la base de donnees:
        $identifier = str_random(5);
        $insertion = Transaction::firstOrCreate([
            'reference'        => $identifier,
            'identifiant'      => 'ID-'.random_int(50000,90000),
            'amount'           => request('montant'),
            'coin_enter'       => request('coint_enter'),
            'coin_out'         => request('coint_out'),
            'account_receiver' => request('account_receive'),
            'etat'             => 0,
            'user'             => auth()->user()->id,
        ]);
        if ($insertion) {
            return redirect("https://paygateglobal.com/v1/page?token=93a934d5-557e-465d-99e3-ab0f821e419f&amount=".request('montant')."&description=".request('account_receive')."&identifier=".$identifier);
        } else {
            Flashy::error('Erreur');
            return back();
        }
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
        $identifier = str_random(5);
        $insertion = Transaction::firstOrCreate([
            'reference'        => $identifier,
            'identifiant'      => 'ID-'.random_int(50000,90000),
            'amount'           => request('montant'),
            'coin_enter'       => request('coint_enter'),
            'coin_out'         => request('coint_out'),
            'account_receiver' => request('account_receive'),
            'etat'             => 0,
            'user'             => auth()->user()->id,
        ]);
        if ($insertion) {
            return redirect("https://paygateglobal.com/v1/page?token=93a934d5-557e-465d-99e3-ab0f821e419f&amount=".request('montant')."&description=".request('account_receive')."&identifier=".$identifier);
        } else {
            Flashy::error('Erreur');
            return back();
        }
    }
    /**************************** FIN T MONEY **********************************/



    /****************************** PAYEER *************************************/

    public function actionWaitingSendPayeer(){
        $id               = random_int(50000,90000);
        $montant          = request('amount');
        $coin_enter       = request('coin_enter_payeer');
        $coin_out         = request('coin_out_payeer');
        $accountid        = request('accountid');
        $total            = request('total');
        $moncompte        = request('myaccount');
        $devise_enter     = request('devise_enter_payeer');
        $devise_out       = request('devise_out');
        $account_receive  = request('account_receiver');
        $user             = auth()->user()->personne_id;
        return view('transactions.commande',compact('id','coin_enter','coin_out','montant','total',
        'devise_enter','devise_out','account_receive','user','moncompte'));
    }

    public function formulaireActionPayeer(){
        $account_receive    = request('account_receive');
        $montant            = request('montant');
        $moncompte          = request('moncompte');
        $devise_enter       = request('devise_enter');
        $devise_out         = request('devise_out');
        $id                 = '1285857258';
        $payee_name         = auth()->user()->email;
        $reference          = random_int(50000,90000);
        $description        = base64_encode(str_random(5));
        $payement_reference = strtoupper(str_random(50));

        $insertion = Transaction::firstOrCreate([
            'reference'          => $reference,
            'identifiant'        => $id,
            'coin_enter'         => request('coin_enter'),
            'coin_out'           => request('coin_out'),
            'amount'             => $montant,
            'devise_enter'       => $devise_enter,
            'devise_out'         => $devise_out,
            'payement_reference' => 'REF'.str_random(20),
            'account_sender'     => $moncompte,
            'account_receiver'   => $account_receive ,
            'etat'               => 0,
            'user'               => auth()->user()->id,
        ]);

         if ($insertion) {
            return view('transactions.payeer',compact('account_receive','montant','moncompte','devise_enter',
            'devise_out','id','payee_name','reference','description','payement_reference'));
        } else {
            Flashy::error('Erreur');
            return back();
        }
    }

    /**************************** FIN PAYEER **********************************/


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

    public function verifierPayementFlooz(){
        
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
