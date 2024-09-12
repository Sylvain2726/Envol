<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salle extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];
    public function magasin()
    {
        return $this->belongsTo(Magasin::class);
    }

    public function items(){
        return $this->hasMany(Item::class);
    }

    /**
     * Retourne le stock total de l'equipement $id dans cette salle.
     *
     * @param int $id l'id de l'equipement.
     * @return int le stock total de l'equipement.
     */
    public function getStock(int $id){
       $equipement =  Equipement::find($id);
       $tock = $equipement->items->where('salle_id', $this->id)->sum('quantite');
       return $tock;

    }
}
