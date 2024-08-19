<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DevisItem extends Model
{
    use HasFactory;

    protected $fillable= [
        'devis_id',
        'equipement_id',
        'quantite',
        'total',
        'name',
        'type',
        'VPrice'
    ];

    public function devis(){
        return $this->belongsTo(Devis::class);
    }

    public function equipment(){
        return $this->belongsTo(Equipement::class);

    }
}
