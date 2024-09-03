<?php

namespace App\Models;

use Faker\Provider\ar_EG\Payment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    /**
         * Avori tous les payement de la  facture
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        public function payemants(): HasMany
        {
            return $this->hasMany(Payement::class);
        }

}
