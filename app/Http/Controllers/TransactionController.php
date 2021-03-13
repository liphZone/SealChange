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
        $id_transaction     = request('id_transaction');
        $montant            = request('amount');
        $montant_a_recevoir = request('having_amount');
        $coin_enter         = request('coin_enter_pm');
        $coin_out           = request('coin_out_pm');
        $moncompte          = request('myaccount');
        $devise_enter       = request('devise_enter_pm');
        $devise_out         = request('devise_out_pm');
        $account_receive    = request('accountreceiver');
        $user               = auth()->user()->personne_id;
        $payee_name         = auth()->user()->email;

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

        return view('transactions.commande',compact('id_transaction','coin_enter','coin_out','montant','montant_a_recevoir','moncompte',
        'devise_enter','devise_out','account_receive','user','payee_name','phone'));
    }

    public function formulaireActionPerfectMoney(){
        $reference          = Str::random(10);
        $montant            = request('montant');
        $montant_a_recevoir = request('having_amount');
        $id_transaction     = request('id_transaction');
        $devise_enter       = request('devise_enter');
        $devise_out         = request('devise_out');
        $telephone          = request('telephone');
        $moncompte          = request('myaccount');
        $coin_enter         = request('coin_enter');
        $coin_out           = request('coin_out');
        $payee_name         = auth()->user()->email;
        $account_receive    = request('account_receive');

        $user          = Personne::where('id',auth()->user()->personne_id)->first();
        $monnaie_enter = Coin::where('id',$coin_enter)->first();
        $monnaie_out   = Coin::where('id',$coin_out)->first();
        $transaction   = Transaction::where('user',auth()->user()->id)->first();


        if ($transaction === null) 
        {

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
                'myaccount'        => $moncompte,
                'telephone'        => $telephone,
                'account_receiver' => $account_receive,
                'etat'             => 0,
                'user'             => auth()->user()->id,
            ]);
             if ($insertion) {
             
                return view('transactions.perfectmoney',compact('account_receive','montant','moncompte','devise_enter',
                'devise_out','id_transaction','payee_name'));
            } else {
                Flashy::error('Erreur');
                return back();
            }

        }
        elseif ($transaction->id_transaction != $id_transaction) 
        {
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
                'myaccount'        => $moncompte,
                'telephone'        => $telephone,
                'account_receiver' => $account_receive,
                'etat'             => 0,
                'user'             => auth()->user()->id,
            ]);
             if ($insertion) {
             
                return view('transactions.perfectmoney',compact('account_receive','montant','moncompte','devise_enter',
                'devise_out','id_transaction','payee_name'));
            } else {
                Flashy::error('Erreur');
                return back();
            }

        }
        else
        {
            Flashy::error('Erreur de transaction');
            return redirect()->route('accueil');
        }

       
    }
    /**************************** FIN PERFECT MONEY **********************************/


    /****************************** PAYEER *************************************/

    public function actionWaitingSendPayeer(){
        $montant            = request('amount');
        $montant_a_recevoir = request('having_amount');
        $coin_enter         = request('coin_enter_payeer');
        $coin_out           = request('coin_out_payeer');
        $moncompte          = 'P1040648631';
        $devise_enter       = request('devise_enter_payeer');
        $devise_out         = request('devise_out');
        $account_receiver   = request('account_receiver');
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
        'devise_enter','devise_out','account_receiver','id_transaction','user','phone'));
    }

    public function actionSendPayeer(){

        $reference          = Str::random(10);
        $montant            = request('amount');
        $montant_a_recevoir = request('having_amount');
        $id_transaction     = request('id_transaction');
        $devise_enter       = request('devise_enter');
        $devise_out         = request('devise_out');
        $telephone          = request('telephone');
        $moncompte          = request('myaccount');
        $coin_enter         = request('coin_enter');
        $coin_out           = request('coin_out');
        $account_receiver   = request('account_receiver');

        $user          = Personne::where('id',auth()->user()->personne_id)->first();
        $monnaie_enter = Coin::where('id',$coin_enter)->first();
        $monnaie_out   = Coin::where('id',$coin_out)->first();
        //Je recupere les informations de l'utilisateur pour utiliser 'id_transaction'
        $transaction   = Transaction::where('user',auth()->user()->id)->first();

        if ($transaction === null) 
        {
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
             
                // Flashy::success('En cours de traitement ...');
                return view('transactions.transaction',compact('montant','montant_a_recevoir','coin_enter','coin_out','devise_out'));
            } else {
                Flashy::error('Erreur');
                return back();
            }
        }
        elseif ($transaction->id_transaction != $id_transaction) 
        {
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
             
                Flashy::success('En cours de traitement ...');
                return view('transactions.transaction',compact('montant','montant_a_recevoir','coin_enter','coin_out','devise_out','id_transaction'));
            } else {
                Flashy::error('Erreur');
                return back();
            }
        }
        else
        {
            return view('transactions.transaction',compact('montant','montant_a_recevoir','coin_enter','coin_out','devise_out','id_transaction'));
        }
    }

    /**************************** FIN PAYEER **********************************/


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

        return view('transactions.commande',compact('id_transaction','montant','montant_a_recevoir','coin_enter','coin_out',
        'devise_enter','devise_out','account_receive','user','phone'));
    }


    /****************************** FIN MTN *************************************/

   

    /****************************** FLOOZ *************************************/

    public function actionWaitingSendFlooz(){
        $id_transaction     = request('id_transaction');
        $montant            = request('amount');
        $montant_a_recevoir = request('having_amount');
        $coin_enter         = request('coin_enter_flooz');
        $coin_out           = request('coin_out_flooz');
        $devise_enter       = request('devise_enter_flooz');
        $devise_out         = request('devise_out');
        $account_receive    = request('account_receiver');
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

        return view('transactions.commande',compact('id_transaction','montant','montant_a_recevoir','coin_enter','coin_out',
        'devise_enter','devise_out','account_receive','user','phone'));
    }

    public function actionSendMobileMoney(){
        //Enregistrement dans la base de donnees:
        $reference          = Str::random(10);
        $montant            = request('amount');
        $montant_a_recevoir = request('having_amount');
        $id_transaction     = request('id_transaction');
        $devise_enter       = request('devise_enter');
        $devise_out         = request('devise_out');
        $telephone          = request('telephone');
        $coin_enter         = request('coin_enter');
        $coin_out           = request('coin_out');
        $account_receive    = request('account_receive');

        $user          = Personne::where('id',auth()->user()->personne_id)->first();
        $monnaie_enter = Coin::where('id',$coin_enter)->first();
        $monnaie_out   = Coin::where('id',$coin_out)->first();
        $transaction   = Transaction::where('user',auth()->user()->id)->first();


        if ($transaction === null) 
        {
            
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
                'account_receiver' => $account_receive,
                'etat'             => 0,
                'user'             => auth()->user()->id,
            ]);
            if ($insertion) {
             
                return view('transactions.mobile_money',compact('montant','user'));
            } else {
                Flashy::error('Erreur');
                return back();
            }
        }

        elseif ($transaction->id_transaction != $id_transaction) 
        {
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
                'account_receiver' => $account_receive,
                'etat'             => 0,
                'user'             => auth()->user()->id,
            ]);
            if ($insertion) {
             
                Flashy::success('En cours de traitement ...');
                return view('transactions.mobile_money',compact('montant','user'));
            } else {
                Flashy::error('Erreur');
                return back();
            }
        }
        else
        {
            return view('transactions.mobile_money',compact('montant','user'));
        }
    }

    public function formulaireMobileMoney(){
        return view('transactions.mobile_money');
    }

    /**************************** FIN FLOOZ **********************************/



    /****************************** T MONEY *************************************/

    public function actionWaitingSendTMoney(){
        $id_transaction     = request('id_transaction');
        $montant            = request('amount');
        $montant_a_recevoir = request('having_amount');
        $coin_enter         = request('coin_enter_tm');
        $coin_out           = request('coin_out_tm');
        $devise_enter       = request('devise_enter_tm');
        $devise_out         = request('devise_out');
        $account_receive    = request('account_receiver');
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

        return view('transactions.commande',compact('id_transaction','coin_enter','coin_out','montant','montant_a_recevoir','devise_enter','devise_out','account_receive','user','phone'));
    }

    public function actionSendTMoney(){
        $reference          = Str::random(10);
        $montant            = request('amount');
        $montant_a_recevoir = request('having_amount');
        $id_transaction     = request('id_transaction');
        $devise_enter       = request('devise_enter');
        $devise_out         = request('devise_out');
        $telephone          = request('telephone');
        $coin_enter         = request('coin_enter');
        $coin_out           = request('coin_out');
        $account_receive    = request('account_receive');

        $user          = Personne::where('id',auth()->user()->personne_id)->first();
        $monnaie_enter = Coin::where('id',$coin_enter)->first();
        $monnaie_out   = Coin::where('id',$coin_out)->first();
        $transaction   = Transaction::where('user',auth()->user()->id)->first();

        if ($transaction === null) 
        {
            $insertion = Transaction::firstOrCreate([
                'id_transaction' => $id_transaction,
            ],
            [
                'reference'        => $reference ,
                'coin_enter'       => $coin_enter,
                'coin_out'         => $coin_out,
                'amount'           => $montant,
                'having_amount'    => $montant_a_recevoir,
                'devise_enter'     => $devise_enter,
                'devise_out'       => $devise_out,
                'telephone'        => $telephone,
                'account_receiver' =>  $account_receive,
                'etat'             => 0,
                'user'             => auth()->user()->id,
            ]);
            if ($insertion) {
             
                return redirect("https://paygateglobal.com/v1/page?token=93a934d5-557e-465d-99e3-ab0f821e419f&amount=".$montant."&description=Retrait"."&identifier=".$id_transaction);
            } else {
                Flashy::error('Erreur');
                return back();
            }
        }
        elseif ($transaction->id_transaction != $id_transaction) 
        {
            $insertion = Transaction::firstOrCreate([
                'id_transaction' => $id_transaction,
            ],
            [
                'reference'        => $reference ,
                'coin_enter'       => $coin_enter,
                'coin_out'         => $coin_out,
                'amount'           => $montant,
                'having_amount'    => $montant_a_recevoir,
                'devise_enter'     => $devise_enter,
                'devise_out'       => $devise_out,
                'account_receiver' => request('account_receive'),
                'etat'             => 0,
                'user'             => auth()->user()->id,
            ]);
            if ($insertion) {
             
                return redirect("https://paygateglobal.com/v1/page?token=93a934d5-557e-465d-99e3-ab0f821e419f&amount=".$montant."&description=Retrait"."&identifier=".$id_transaction);
            } else {
                Flashy::error('Erreur');
                return back();
            }
        }
        else
        {    
            Flashy::error('Erreur survenue lors du transfert');
            return redirect()->route('accueil');
        }
    }

    /**************************** FIN T MONEY **********************************/

    
    /**************************** FIN BITCOIN **********************************/
    public function actionWaitingSendBtc(){
        $montant            = request('amount');
        $montant_a_recevoir = request('having_amount');
        $coin_enter         = request('coin_enter_btc');
        $coin_out           = request('coin_out_btc');
        $devise_enter       = request('devise_enter_btc');
        $devise_out         = request('devise_out');
        $id_transaction     = rand();
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
        return view('transactions.commande',compact('montant','montant_a_recevoir','coin_enter','coin_out',
        'devise_enter','devise_out','id_transaction','user','phone'));
    }

    public function actionSendBitcoin(){
        $reference          = Str::random(10);
        $montant            = request('amount');
        $montant_a_recevoir = request('having_amount');
        $id_transaction     = request('id_transaction');
        $devise_enter       = request('devise_enter');
        $devise_out         = request('devise_out');
        $telephone          = request('telephone');
        $coin_enter         = request('coin_enter');
        $coin_out           = request('coin_out');
        $account_receiver   = request('account_receiver');

        $adresse_bitcoin    = request('ttc');
        
        $user          = Personne::where('id',auth()->user()->personne_id)->first();
        $monnaie_enter = Coin::where('id',$coin_enter)->first();
        $monnaie_out   = Coin::where('id',$coin_out)->first();
        //Je recupere les informations de l'utilisateur pour utiliser 'id_transaction'
        $transaction   = Transaction::where('user',auth()->user()->id)->first();

        if ($transaction === null) 
        {
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
                'myaccount'        => $adresse_bitcoin,
                'account_receiver' => $account_receiver,
                'etat'             => 0,
                'user'             => auth()->user()->id,
            ]);
            if ($insertion) {
                // Flashy::success('En cours de traitement ...');
                return view('transactions.cryptocurrency',compact('montant','montant_a_recevoir','coin_enter','coin_out','devise_out','adresse_bitcoin'));
            } else {
                Flashy::error('Erreur');
                return back();
            }
        }
        elseif ($transaction->id_transaction != $id_transaction) 
        {
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
                'myaccount'        => $adresse_bitcoin,
                'account_receiver' => $account_receiver,
                'etat'             => 0,
                'user'             => auth()->user()->id,
            ]);
            if ($insertion) {
                Flashy::success('En cours de traitement ...');
                return view('transactions.cryptocurrency',compact('montant','montant_a_recevoir','coin_enter','coin_out','devise_out','id_transaction','adresse_bitcoin'));
            } else {
                Flashy::error('Erreur');
                return back();
            }
        }
        else
        {
            return view('transactions.cryptocurrency',compact('montant','montant_a_recevoir','coin_enter','coin_out','devise_out','id_transaction','adresse_bitcoin'));
        }
    }
    /**************************** FIN BITCOIN **********************************/

    /****************************  ADVCASH **********************************/
    public function actionWaitingSendAdvcash(){
        $montant            = request('amount');
        $montant_a_recevoir = request('having_amount');
        $coin_enter         = request('coin_enter_advcash');
        $coin_out           = request('coin_out_advcash');
        $moncompte          = 'U033816068648';
        $devise_enter       = request('devise_enter_advcash');
        $devise_out         = request('devise_out');
        $id_transaction     = rand();
        $account_receiver   = request('account_receiver');
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
        'devise_enter','devise_out','id_transaction','account_receiver','user','phone'));
    }

    public function actionSendAdvcash(){

        $reference          = Str::random(10);
        $montant            = request('amount');
        $montant_a_recevoir = request('having_amount');
        $id_transaction     = request('id_transaction');
        $devise_enter       = request('devise_enter');
        $devise_out         = request('devise_out');
        $telephone          = request('telephone');
        $moncompte          = request('myaccount');
        $coin_enter         = request('coin_enter');
        $coin_out           = request('coin_out');
        $account_receiver   = request('account_receiver');

        $user          = Personne::where('id',auth()->user()->personne_id)->first();
        $monnaie_enter = Coin::where('id',$coin_enter)->first();
        $monnaie_out   = Coin::where('id',$coin_out)->first();
        //Je recupere les informations de l'utilisateur pour utiliser 'id_transaction'
        $transaction   = Transaction::where('user',auth()->user()->id)->first();

        if ($transaction === null) 
        {
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
             
                // Flashy::success('En cours de traitement ...');
                return view('transactions.transaction',compact('montant','montant_a_recevoir','coin_enter','coin_out','devise_out'));
            } else {
                Flashy::error('Erreur');
                return back();
            }
        }
        elseif ($transaction->id_transaction != $id_transaction) 
        {
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
             
                Flashy::success('En cours de traitement ...');
                return view('transactions.transaction',compact('montant','montant_a_recevoir','coin_enter','coin_out','devise_out','id_transaction'));
            } else {
                Flashy::error('Erreur');
                return back();
            }
        }
        else
        {
            return view('transactions.transaction',compact('montant','montant_a_recevoir','coin_enter','coin_out','devise_out','id_transaction'));
        }
    }   
    /**************************** FIN ADVCASH ******************************/

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

    public function actionValidateTransaction(Request $id_transaction){
        $transaction_validate = Transaction::where('user',auth()->user()->personne_id)->where('id_transaction',request('id_transaction'))->first();
        $validation = $transaction_validate->update([
            'etat' => 1
        ]);

        return redirect()->route('accueil');
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
