<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable =[
       'entree_id' ,
        'quantite',
        'total',
        'Aprice',
        'name',
        'type',
        'equipement_id',
        'salle_id'
    ];

    public function entree(){
        return $this->belongsTo(Entree::class);
    }
    public function equipement(){
        return $this->belongsTo(Equipement::class);
    }

    public function salle(){
        return $this->belongsTo(Salle::class);
    }

    public function devisItem(){
        return $this->belongsTo(DevisItem::class);
    }

    public function commandeItem(){
        return $this->belongsTo(CommandeItem::class);
    }
}
