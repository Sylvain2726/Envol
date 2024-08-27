<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Facture;
use Generator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FactureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $factures = Facture::all();
        return view('facture.index', compact('factures'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Commande $commande)
    {
        return view('facture.create', compact('commande'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request , Commande $commande)
    {
        //dd($request->all() , $commande);

        $factue = Facture::create([
            'commande_id' => $commande->id,
            'total' => $commande->total,
            'client_id' => $commande->client_id,
            'user_id' => Auth::user()->id,
            'montantPaye' => 0,
            'montantRestant' => $commande->total,
            'modePaiement' => $request->modePayement,
            'statut' => 'non payée',
            'numFacture'=> 'FactureN°'.random_int(10 , 9000).$commande->id
        ]);

        return redirect()->route('facture.index');
    }

    public function generer(Facture $facture){
        $items = $facture->commande->commandeItems;
        $commande = $facture->commande;

        return view('facture.generer', compact('facture' , 'commande' , 'items'));

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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Facture $facture)
    {
        $facture->delete();
        return redirect()->route('facture.index')->with('success' , 'Facture supprimer avec succès');
    }
}
