<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\CommandeItem;
use App\Models\Devis;
use App\Models\Equipement;
use App\Models\Item;
use App\Models\Magasin;
use App\Models\Salle;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $commandes = Commande::query()->with('commandeItems')->get();
/*
       Commande::with('commandeItems')->delete();
       CommandeItem::with('commande')->delete(); */



       return view('commande.index', compact('commandes'));
    }

    public function create(){

        $magasins = Magasin::all();

        return view('commande.create' , compact('magasins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createCommande(Devis $devi)
    {
        $commande = $devi;
/*       $commande = new Commande();
      $commande->devis_id = $devi->id;
      $commande->client_id = $devi->client_id;

      $commande->save();

      foreach ($devi->devisItems as $item) {

          $commande->commandeItems()->create([

            'item_id' => $item->item_id,
            'quantite' => $item->quantite,
            'total' => $item->total,
            'name' => $item->name,
            'type' => $item->type,
            'VPrice' => $item->VPrice,
            'equipement_id' => $item->equipement_id,

          ]); */

          //$commande->commandeItems()->associate($commandeItem);
          //$commandeItems = $commande->commandeItems()->get();

          //$listeItems = Item::all();



      $equipements = Equipement::all();


      return view('commande.confirme' , compact('devi' , 'commande' , 'equipements' ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
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
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, Commande $commande)
    {


    }

    public function retour(Commande $commande){
        $commande->commandeItems()->delete();
        $commande->delete();
       return redirect()->route('devis.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Commande $commande)
    {
        $commande->commandeItems()->delete();
        $commande->delete();
        $commande->devis->statut = 0;
        $commande->devis->save();
        return redirect()->route('commande.index');
    }

    public function annuler(Commande $commande){
        foreach ($commande->commandeItems as $commandeItem) {
            $itemEntree = Item::query()->find($commandeItem->item_id);
            $itemEntree->quantite = $itemEntree->quantite + $commandeItem->quantite;
            $itemEntree->save();
            $commande->statut = 'Annulée';
            $commande->save();
        }

        return redirect()->route('commande.index')->with('success', 'Commande annulee avec succes');
    }
}
