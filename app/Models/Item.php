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
        'equipement_id'
    ];

    public function entree(){
        return $this->belongsTo(Entree::class);
    }
    public function equipement(){
        return $this->belongsTo(Equipement::class);
    }
}
