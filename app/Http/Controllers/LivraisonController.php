<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Livraison;
use Illuminate\Http\Request;

class LivraisonController extends Controller
{
    public function index(Commande $commande)
    {
        if (!$commande->livraison) {
            $livraison = Livraison::create([

                'commande_id' => $commande->id,
                'numero'=> random_int(1000 , 9000).$commande->id

            ]);

            return view('commande.livraison' , compact('livraison' , 'commande'));
        }else{

            return redirect()->route('commande.index')->with('success' , 'Le bordereau a deja été creé');
        }

    }

    public function show(Commande $commande){

        $livraison = $commande->livraison;

        return view('commande.livraison' , compact('commande' , 'livraison'));
    }

    public function destroy(Livraison $livraison){
        $livraison->delete();
        return redirect()->route('commande.index')->with('success' , 'Le bordereau a été supprimé');
    }
}
