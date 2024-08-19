<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entree extends Model
{
    use HasFactory;

    protected $fillable = [
        'magasin_id',
        'salle_id',
        'total',
    ];

 public function items(){
     return $this->hasMany(Item::class);
 }

 public function salle(){
     return $this->belongsTo(Salle::class);
 }
}
