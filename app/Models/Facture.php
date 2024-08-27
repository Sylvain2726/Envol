<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    use HasFactory;

    protected $fillable = [

        'total',
        'statut',
        'commande_id',
        'user_id',
        'client_id',
        'numFacture',
        'montantPaye',
        'montantRestant',
        'modePaiement',

    ];

    public function client(){
        return $this->belongsTo(Client::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function commande(){
        return $this->belongsTo(Commande::class);
    }
}
