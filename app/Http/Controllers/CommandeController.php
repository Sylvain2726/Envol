<?php

namespace App\Http\Controllers;

use App\enum\PermissionsEnum;
use App\Models\Commande;
use App\Models\CommandeItem;
use App\Models\Devis;
use App\Models\Equipement;
use App\Models\Item;
use App\Models\Magasin;
use App\Models\Salle;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommandeController extends Controller
{

    /**
     * Affiche la liste de toutes les commandes
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(Auth::user()->id) ;
        if (!$user->can(PermissionsEnum::GERER_COMMANDES->value)) {

           abort(403, 'Vous n\'avez pas la permission de gérer les commandes.');
       }
        $commandes = Commande::query()->with('commandeItems')->orderBy('created_at', 'desc')->paginate(6);

       return view('commande.index', compact('commandes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $user = User::find(Auth::user()->id) ;
        if (!$user->can(PermissionsEnum::GERER_COMMANDES->value)) {

           abort(403, 'Vous n\'avez pas la permission de gérer les commandes.');
       }

        $magasins = Magasin::all();

        return view('commande.create' , compact('magasins'));
    }


    /**
     * Crée une commande à partir d'un devis.
     *
     * @param Devis $devi le devis à transformer en commande
     * @return \Illuminate\Http\Response
     */
    public function createCommande(Devis $devi)
    {
        $user = User::find(Auth::user()->id) ;
        if (!$user->can(PermissionsEnum::GERER_COMMANDES->value)) {

           abort(403, 'Vous n\'avez pas la permission de gérer les commandes.');
       }
      $commande = $devi;
      $equipements = Equipement::all();
      $salles = Salle::all();


      return view('commande.confirme' , compact('devi' , 'commande' , 'equipements' ,'salles'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        $user = User::find(Auth::user()->id) ;
        if (!$user->can(PermissionsEnum::GERER_COMMANDES->value)) {

           abort(403, 'Vous n\'avez pas la permission de gérer les commandes.');
       }


        $request->validate([
            'item.*.name'=>'required|string|exists:equipements,name',
            'item.*.VPrice'=>'required|numeric',
            'item.*.quantite'=>'required|integer|min:1,',
            'item.*.type'=>'required|string|exists:equipements,type',
            'item.*.item_id'=>'required|integer|exists:items,id',
            'item.*.equipement_id'=>'required|integer|exists:equipements,id',
            'client_id' => 'required|exists:clients,id|numeric',
            'devis_id'=>'required|exists:devis,id|numeric',

        ] , [
            'client_id.exists' => 'Le client pour cette commande n\'existe pas voici l\' identifiant : '. $request->client_id,
            'item.*.name.exists' => 'Ce nom d\'equipement n\'existe pas.',
            'item.*.type.exists' => 'Ce type d\'equipement n\'existe pas.',
            'item.*.item_id.exists' => 'Choisissez une salle valide',
        ]);
       // dd($request->all());
        $commande = new Commande();
        $commande->client_id = $request->client_id;
        $commande->devis_id = $request->devis_id;
        $commande->total = 0;
        $commande->save();


        foreach ($request->item as $item) {
            $commande->commandeItems()->create([
                'quantite' => $item['quantite'],
                'VPrice' => $item['VPrice'],
                'total' => $item['quantite'] * $item['VPrice'],
                'name' => $item['name'],
                'type' => $item['type'],
                'item_id' => $item['item_id'],
                'equipement_id' => $item['equipement_id'],

            ]);

            $itemEntree = Item::query()->find($item['item_id']);
            if ($itemEntree->quantite >= $item['quantite']) {

               $itemEntree->quantite = $itemEntree->quantite -= $item['quantite'];
               $itemEntree->save();
            }else {

                $commande->commandeItems()->delete();
                $commande->delete();

               return redirect()->route('commande.form' , ['devi' => $commande->devis])
               ->with('error', 'Quantite insuffisante pour  '.$item['name']. 'il n\'y a que '.$itemEntree->quantite.' disponible dans cette salle');
            }

        }

        $commande->total = $commande->commandeItems()->sum('total');
        $commande->devis->statut = 1;
        $commande->devis->save();

        $commande->save();


        return redirect()->route('commande.index')->with('success', 'Commande créee avec succes');
    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, Commande $commande)
    {
        $user = User::find(Auth::user()->id) ;
        if (!$user->can(PermissionsEnum::GERER_COMMANDES->value)) {

           abort(403, 'Vous n\'avez pas la permission de gérer les commandes.');
       }

        $request->validate([
            'item.*.name'=>'required|string|exists:equipements,name',
            'item.*.VPrice'=>'required|numeric',
            'item.*.quantite'=>'required|integer|min:1,',
            'item.*.type'=>'required|string|exists:equipements,type',
            'item.*.item_id'=>'required|integer|exists:items,id',
            'item.*.equipement_id'=>'required|integer|exists:equipements,id',


        ] , [
            'client_id.exists' => 'Le client pour cette commande n\'existe pas voici l\' identifiant : '. $request->client_id,
            'item.*.name.exists' => 'Ce nom d\'equipement n\'existe pas.',
            'item.*.type.exists' => 'Ce type d\'equipement n\'existe pas.',
            'item.*.item_id.exists' => 'Choisissez une salle valide',
        ]);


            foreach ($commande->commandeItems as $ligneComande) {

                foreach ($request->item as $item) {
                    $itemEntree = Item::query()->find($item['item_id']);

/*                     if ($item['quantite'] * 1 > $itemEntree->quantite) {
                        return redirect()->route('commande.items' , $commande)->with('error', 'Quantite insuffisante pour  '.$item['name']. ' il n\'y a que '.$itemEntree->quantite.' disponible dans cette salle');
                    } */

                    //dd($itemEntree->quantite , $item['quantite'] * 1 , $ligneComande->quantite);

                   // dd($itemEntree->quantite , $item['quantite'] * 1 , $ligneComande->quantite , $ligneComande->quantite - ($item['quantite'] * 1));

                    $commande->commandeItems()->where('item_id', $item['item_id'])->update([
                        'quantite' => $item['quantite'] * 1,
                        'VPrice' => $item['VPrice'],
                        'total' => $item['quantite'] * $item['VPrice'],
                        'name' => $item['name'],
                        'type' => $item['type'],
                        'item_id' => $item['item_id'],
                        'equipement_id' => $item['equipement_id'],

                    ]);

                    if ($ligneComande->quantite > $item['quantite'] * 1 ) {
                        // Si la nouvelle quantité est inférieure à l'ancienne, on ajoute la différence au stock
                        $stock = $ligneComande->quantite - $item['quantite'] * 1;
                        $itemEntree->update(['quantite' => $itemEntree->quantite + $stock]);
                    } elseif ($ligneComande->quantite < $item['quantite'] * 1) {
                        // Si la nouvelle quantité est supérieure à l'ancienne, on retire la différence du stock
                        $stock = $item['quantite'] * 1 - $ligneComande->quantite;
                        $itemEntree->update(['quantite' => $itemEntree->quantite - $stock]);
                    }


                }

            }



       // $commandeItem->save();

        $commande->total = $commande->commandeItems()->sum('total');
        $commande->save();
        return redirect()->route('commande.items' , $commande)->with('success', 'Commande modifiée avec succes');

    }



    /**
     * Retourne a la liste des devis
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function retour(){
       return redirect()->route('devis.index');
    }


    /**
     * Affiche les details d'une commande
     * @param Commande $commande
     * @return \Illuminate\Contracts\View\View
     */
    public function detailCommande(Commande $commande){
        $user = User::find(Auth::user()->id) ;
        if (!$user->can(PermissionsEnum::GERER_COMMANDES->value)) {

           abort(403, 'Vous n\'avez pas la permission de gérer les commandes.');
       }

        $items = $commande->commandeItems()->get();
        $equipements = Equipement::all();
        return view('commande.item' , compact('items' , 'commande' , 'equipements'));


    }


    /**
     * Supprime une commande
     *
     * Si la commande est en cours, remet les quantités des items
     * correspondants à leur valeur d'origine et met à jour le statut
     * du devis associé.
     *
     * @param Commande $commande la commande à supprimer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Commande $commande)
    {
        $user = User::find(Auth::user()->id) ;
        if (!$user->can(PermissionsEnum::SUPPRIMER_COMMANDE->value)) {

           abort(403, 'Vous n\'avez pas la permission de supprimer les commandes.');
       }
        if ($commande->statut == 'En cours') {
            foreach ($commande->commandeItems as $commandeItem) {
                $itemEntree = Item::query()->find($commandeItem->item_id);
                $itemEntree->quantite = $itemEntree->quantite + $commandeItem->quantite;
                $itemEntree->save();
                $commande->devis->statut = 0;
                $commande->devis->save();
                $commande->save();
            }
        }

        $commande->commandeItems()->delete();
        $commande->facture()->delete();
        $commande->delete();
        $commande->devis?  $commande->devis->statut = 0: '' ;
        $commande->devis->save();
        return redirect()->route('commande.index');
    }

    /**
     * Annule une commande
     *
     * Si la commande est en cours, remet les quantités des items
     * correspondants à leur valeur d'origine et met à jour le statut
     * du devis associé.
     *
     * @param Commande $commande la commande à annuler
     * @return \Illuminate\Http\RedirectResponse
     */
    public function annuler(Commande $commande){
        $user = User::find(Auth::user()->id) ;
        if (!$user->can(PermissionsEnum::SUPPRIMER_COMMANDE->value)) {

           abort(403, 'Vous n\'avez pas la permission d\'annuler une commande.');
       }
        foreach ($commande->commandeItems as $commandeItem) {
            $itemEntree = Item::query()->find($commandeItem->item_id);
            $itemEntree->quantite = $itemEntree->quantite + $commandeItem->quantite;
            $itemEntree->save();
            $commande->statut = 'Annulée';
            $commande->devis->statut = 0;
            $commande->devis->save();
            $commande->save();
        }

        return redirect()->route('commande.index')->with('success', 'Commande annulee avec succes');
    }
}
