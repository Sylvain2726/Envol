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
}
