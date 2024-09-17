<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Payement extends Model
{
    use HasFactory;

    protected $fillable = [
        'facture_id',
        'modePayement',
        'montantPaye',
        'description',
        'numero',
        'image'
    ];

    public function facture(){
        return $this->belongsTo(Facture::class);
    }

    public function imageUrl(){

      return Storage::url($this->image);

    }
}
