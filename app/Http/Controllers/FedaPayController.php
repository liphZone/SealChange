<?php

namespace App\Http\Controllers;

use App\Models\Coin;
use \FedaPay\FedaPay;
use \FedaPay\Transaction;
use Illuminate\Http\Request;
use MercurySeries\Flashy\Flashy;

class FedaPayController extends Controller
{

    public function actionFedaPay(){
        $coin_enter = Coin::where('id',request('enter'))->first();
        $coin_out = Coin::where('id',request('out'))->first();
        $entree = $coin_enter->libelle;
        $sortie = $coin_out->libelle;
        // dd($coin->libelle);


        FedaPay::setApiKey("sk_live_75vH-vRSe3N0QAztsNGkv-Kb");
        FedaPay::setEnvironment('live');

        /**
        * Create a transaction
        */
        $transaction = Transaction::create([
            "description" => "Transaction de l'utilisateur ".request('prenom').' '.request('nom'),
            "amount" => request('montant'),
            "currency" => ["iso" => "XOF"],
            "customer" => [
                "firstname" => request('prenom'),
                "lastname" => request('nom'),
                "email" => request('email')
            ]
        ]);
        
        /**
         * Send a mobile money request
         * mtn,moov,mtn_ci,moov_tg,mtn_open
         * , "country" => "bj"
         */
        if (strtolower($coin_enter->libelle) === 'flooz') {
            $token = $transaction->generateToken();
            $link = $token->url;
            // $transaction->sendNow('moov', ['phone_number' => ['number' => request('telephone')]]);
        }
        elseif (strtolower($coin_enter->libelle) === 'mtn' || strtolower($coin_enter->libelle) === 'mtn mobile money' || 
        strtolower($coin_enter->libelle) === 'm t n' || strtolower($coin_enter->libelle) === 'mobile money') {
            // $transaction->sendNow('mtn', ['phone_number' => ['number' => request('telephone')]]);
        }

        if ($token) {
            Flashy::success('Transaction éffectuée avec success');
            return view('transactions.fedapay',compact('entree','sortie','link'));
        }else{
            Flashy::error('Erreur de transaction');
            return redirect()->route('accueil');
        }
        /**
         * Or generate a payment link to let the customer choose its payment mode
         *
         * $token = $transaction->generateToken();
         * // to paymen page at $token->url
   */
    }

    

}
