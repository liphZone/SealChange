<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TransactionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $monnaie_enter;
    public $monnaie_out;
    public $montant;
    public $montant_r;
    public $id_transaction;
    public $nom;
    public $prenom;
    public $email;
    public $telephone = null;
   

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($monnaie_enter,$monnaie_out,$montant,$montant_r,$id_transaction,$nom,$prenom,$email,$telephone)
    {
        $this->monnaie_enter  = $monnaie_enter;
        $this->monnaie_out    = $monnaie_out;
        $this->montant        = $montant;
        $this->montant_r      = $montant_r;
        $this->id_transaction = $id_transaction;
        $this->nom            = $nom;
        $this->prenom         = $prenom;
        $this->email          = $email;
        $this->telephone      = $telephone;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.mail_transaction')
        ->subject('Nouvelle transaction')
        ->from('liphzone@gmail.com','SealChangeGroup');
    }
}
