<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;
    protected $fillable = [
        'devis_id',
        'status',
        'client_id',
    ];


    public function devis()
    {
        return $this->belongsTo(Devis::class);
    }


    public function commandeItems(){
        return $this->hasMany(CommandeItem::class);
    }


    public function facture(){
        return $this->hasOne(Facture::class);
    }

    /**
     * Obtenir la livraison qui est associée à la commande.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function livraison(){
        return $this->hasOne(Livraison::class);
    }

}






