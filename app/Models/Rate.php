<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;

    protected $fillable = [
        'monnaie_enter',
        'devise_enter',
        'valeur_enter',
        'monnaie_out',
        'devise_out',
        'valeur_out',
    ];
}
