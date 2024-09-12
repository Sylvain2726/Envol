<?php

namespace App\Http\Controllers;

use App\enum\PermissionsEnum;
use App\Models\Commande;
use App\Models\Livraison;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LivraisonController extends Controller
{
    /**
     * Affiche la vue de la creation d'un bordereau de livraison pour une commande
     * Si le bordereau a deja été créé, redirige vers la page de gestion des commandes
     * avec un message de succes
     *
     * @param Commande $commande
     * @return \Illuminate\Http\Response
     */
    public function index(Commande $commande)
    {
        $user = User::find(Auth::user()->id) ;
        if (!$user->can(PermissionsEnum::GERER_COMMANDES->value)) {

           abort(403, 'Vous n\'avez pas la permission de voir les bons de sortie.');
       }
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

    /**
     * Affiche la vue du bordereau de livraison d'une commande
     *
     * @param Commande $commande
     * @return \Illuminate\Http\Response
     */
    public function show(Commande $commande){
        $user = User::find(Auth::user()->id) ;
        if (!$user->can(PermissionsEnum::GERER_COMMANDES->value)) {

           abort(403, 'Vous n\'avez pas la permission de voir les bons de sortie.');
       }

        $livraison = $commande->livraison;

        return view('commande.livraison' , compact('commande' , 'livraison'));
    }

    /**
     * Supprime un bordereau de livraison
     *
     * @param Livraison $livraison le bordereau de livraison à supprimer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Livraison $livraison){
        $user = User::find(Auth::user()->id) ;
        if (!$user->can(PermissionsEnum::SUPPRIMER_COMMANDE->value)) {

           abort(403, 'Vous n\'avez pas la permission de supprimer les bon de sortie.');
       }
        $livraison->delete();
        return redirect()->route('commande.index')->with('success' , 'Le bordereau a été supprimé');
    }
}
