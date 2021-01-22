<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendFloozFormRequest;
use App\Models\Coin;
use App\Models\Type;
use App\Models\Personne;
use App\Models\Transaction;
use Illuminate\Http\Request;
use MercurySeries\Flashy\Flashy;
use App\Http\Requests\TransactionFormRequest;

class TransactionController extends Controller
{
    
    /************************************ ACTION WAITING ************************************/

    public function actionWaitingSendFlooz(){

        /***************** FLOOZ **********************/

        $id              = random_int(50000,90000);
        $montant         = request('amount');
        $coin_enter      = request('coin_enter_flooz');
        $coin_out        = request('coin_out_flooz');
        $total           = request('total');
        $devise_enter    = request('devise_enter_flooz');
        $devise_out      = request('devise_out');
        $account_receive = request('account_receiver');
        $user            = auth()->user()->personne_id;

        /*************** FIN FLOOZ ********************/
        return view('transactions.commande',compact('id','coin_enter','coin_out','montant','total','devise_enter','devise_out','account_receive','user'));
    }

    public function actionWaitingSendTMoney(){

        /***************** TMONEY **********************/

        $id              = random_int(50000,90000);
        $montant         = request('amount');
        $coin_enter      = request('coin_enter_tm');
        $coin_out        = request('coin_out_tm');
        $total           = request('total');
        $devise_enter    = request('devise_enter_tm');
        $devise_out      = request('devise_out');
        $account_receive = request('account_receiver');
        $user            = auth()->user()->personne_id;

        /*************** FIN TMONEY ********************/
        return view('transactions.commande',compact('id','coin_enter','coin_out','montant','total','devise_enter','devise_out','account_receive','user'));

    }

    public function actionWaitingSendPerfectMoney(){   

        /***************** PERFECT MONEY ***********************/
        
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

        /**************** FIN PERFECT MONEY ********************/

        return view('transactions.commande',compact('id','coin_enter','coin_out','montant','total','devise_enter','devise_out','account_receive','user'));
        

        // $f = redirect('https://perfectmoney.com/acct/confirm.asp?AccountID='.$accountid.'&PassPhrase='.$password.'&Payer_Account='.$moncompte.'&Payee_Account='.$recepteur.'&Amount='.$montant.'&PAY_IN=1&PAYMENT_ID='.$reference);
        // return $f;
    }

    public function actionWaitingSendPayeer(){

        /***************** PAYEER ***********************/
        
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

        /**************** FIN PAYEER ********************/


        return view('transactions.commande',compact('id','coin_enter','coin_out','montant','total','devise_enter','devise_out','account_receive','user'));
    }

    /************************************ FIN ACTION WAITING ********************************/

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

    public function actionSendPerfectMoney(){
        // $insertion = Transaction::firstOrCreate([
        //     'reference'        => str_random(5),
        //     'identifiant'      => 'ID-'.random_int(50000,90000),
        //     'amount'           => request('amount'),
        //     'coin_enter'       => request('coint_enter'),
        //     'coin_out'         => request('coint_out'),
        //     'account_sender'   => request('myaccount'),
        //     'account_receiver'   => request('accountreceive'),
        //     'etat'             => 0,
        //     'user'             => auth()->user()->id,
        // ]);

        
          /* Tester  perfectmoney.is/api/step1.asp  OU 
        https://www.shop.com/orderpayment.asp OU
        https://perfectmoney.is/api/step1.asp (POST) OU
            https://perfectmoney.is/acct/confirm.asp OU 
            https://perfectmoney.is/acct/acc_name .asp
            OU http://perfectmoney.is /acct/rates.asp 

            Chercher le formulaire de Perfect Money  Payment Order


            Tester ceci : 
            <form action="https://perfectmoney.is/api/step1.asp" method="POST">
            <p>
                <input type="hidden" name="PAYEE_ACCOUNT" value="U9007123">
                <input type="hidden" name="PAYEE_NAME" value="My company">
                <input type="hidden" name="PAYMENT_AMOUNT" value="109.99">
                <input type="hidden" name="PAYMENT_UNITS" value="USD">
                <input type="hidden" name="STATUS_URL" 
                    value="https://www.myshop.com/cgi-bin/xact.cgi">
                <input type="hidden" name="PAYMENT_URL" 
                    value="https://www.myshop.com/cgi-bin/chkout1.cgi">
                <input type="hidden" name="NOPAYMENT_URL" 
                    value="https://www.myshop.com/cgi-bin/chkout2.cgi">
                <input type="hidden" name="BAGGAGE_FIELDS" 
                    value="ORDER_NUM CUST_NUM">
                <input type="hidden" name="ORDER_NUM" value="9801121">
                <input type="hidden" name="CUST_NUM" value="2067609">
                <input type="submit" name="PAYMENT_METHOD" value="PerfectMoney account">
            </p>
            </form>

           */

       return redirect("https://perfectmoney.is/api/step1.asp");
    }

    public function actionSendPayeer(){
        //PayementID (m_orderid) : je vais le generer
        //Payment Description(m_desc) : sera generer et encoder en Base64
        //Electronic signature(m_sign) : je vais generer
 
        $m_shop = '1273579128';
        $m_orderid = random_int(70000,150000);
        $m_amount = request('montant');
        $m_curr = request('currency');
        $m_desc = base64_encode(str_random(20));
        $m_key = 'RsBwe5ymQQ03UZvw';
        $arHash[] = $m_key;
 
        $m_sign = strtoupper(hash('sha256', implode(':', $arHash)));
     
        $arGetParams = array(
         'm_shop' => $m_shop,
         'm_orderid' => $m_orderid,
         'm_amount' => $m_amount,
         'm_curr' => $m_curr,
         'm_desc' => $m_desc,
         'm_sign' => $m_sign,
        
         );
 
        return redirect("https://payeer.com/merchant/?".http_build_query($arGetParams));
     }

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
