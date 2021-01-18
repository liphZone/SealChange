<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'tx_reference_flooz',
        'coin_enter',
        'coin_out',
        'amount',
        'payement_method',
        'payement_reference',
        'telephone',
        'sender',
        'receiver',
        'user',
        'etat',
    ];
}
