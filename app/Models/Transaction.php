<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'coin_enter',
        'coin_out',
        'amount',
        'having_amount',
        'id_transaction',
        'devise_enter',
        'devise_out',
        'telephone',
        'myaccount',
        'account_receiver',
        'user',
        'etat',
    ];
}
