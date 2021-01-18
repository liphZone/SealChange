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
    public function formulaireTransaction(){
        $categorie = Type::all();
        $monnaie = Coin::all();
        return view('transactions.transaction',compact('categorie','monnaie'));
    }

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

    public function actionSendPerfectMoney(){
        $reference = 'ID-'.random_int(50000,90000);
        $accountid = request('accountid');
        $password  = request('pwd');
        $moncompte = request('myaccount');
        $montant   = request('amount');
        $recepteur = request('accountreceive');
        $f = redirect('https://perfectmoney.com/acct/confirm.asp?AccountID='.$accountid.'&PassPhrase='.$password.'&Payer_Account='.$moncompte.'&Payee_Account='.$recepteur.'&Amount='.$montant.'&PAY_IN=1&PAYMENT_ID='.$reference);
        return $f;
    }

    public function actionSendFlooz(SendFloozFormRequest $s){
        $identifier = str_random(5);
        $insertion = Transaction::firstOrCreate([
            'reference'  => $s->$identifier,
            'amount'     => $s->montant,
            'coin_enter' => $s->input_enter_flooz,
            'coin_out'   => $s->input_out_flooz,
            'etat'       => 0,
            'user'       => auth()->user()->id,
        ]);

        if ($insertion) {
            Flashy::success('Transaction en cours');
            return redirect("https://paygateglobal.com/v1/page?token=93a934d5-557e-465d-99e3-ab0f821e419f&amount=".$s->montant."&description=Envoi&identifier=".$identifier);
        }else{
            Flashy::error('Erreur');
            return back();
        }
       
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

    public function actionSendAdvcash(){
       $auth = random_int(50000,100000);
       $api = request('apiname');
       $email = request('email');
       return redirect('');
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

    public function formulaireChoixHistorique(){
        $categorie = Type::all();
        $monnaie =Coin::all();
        return view('historiques.choix_historique',compact('categorie','monnaie'));
    }

    public function formulaireHistorique(){
        return view('historiques.historique');
    }

  

}
