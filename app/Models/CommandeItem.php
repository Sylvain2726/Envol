<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommandeItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'commandes_id',
        'item_id',
        'equipement_id',
        'quantite',
        'total',
        'name' ,
        'type',
        'VPrice'
    ];

    public function item(){
        return $this->belongsTo(Item::class);
    }

    public function commande(){
        return $this->belongsTo(Commande::class);
    }
}
