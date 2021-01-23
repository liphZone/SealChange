<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'identifiant',
        'coin_enter',
        'coin_out',
        'amount',
        'devise_enter',
        'devise_out',
        'payement_reference',
        'telephone',
        'account_sender',
        'account_receiver',
        'user',
        'etat',
    ];
}
