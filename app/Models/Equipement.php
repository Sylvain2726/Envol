<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipement extends Model
{
    use HasFactory;

    /*
       *  $table->string('name');
          $table->string('type');
          $table->float('APrice');
          $table->float('VPrice');
          $table->integer('stock');
       * */

    protected $fillable = [
        'name',
        'type',
        'Aprice',
        'Vprice',
        'stock'
    ];

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function devisItems()
    {
        return $this->hasMany(DevisItem::class);
    }

}
