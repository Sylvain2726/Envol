<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devis extends Model
{
    use HasFactory;

    protected $fillable = [
        'total',
        'statut',
        'user_id',
        'client_id',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function devisItems(){
        return $this->hasMany(DevisItem::class);
    }

    public function commande(){
        return $this->belongsTo(Commande::class);
    }
}
