<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payement extends Model
{
    use HasFactory;

    protected $fillable = [
        'facture_id',
        'modePayement',
        'montantPaye',
        'description',
        'numero'
    ];

    public function facture(){
        return $this->belongsTo(Facture::class);
    }
}
