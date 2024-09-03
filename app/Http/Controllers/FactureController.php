<?php

namespace App\Http\Controllers;

use App\Mail\InvoiceMail;
use App\Models\Commande;
use App\Models\Facture;
use App\Models\Payement;
use Generator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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

    public function listePayement(Facture $facture){
        $payements = $facture->payemants;

        return view('facture.listePayment' , compact('payements'  , 'facture'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createPayment(Facture $facture)
    {
        return view('facture.create', compact('facture'));
    }

    //Enregistrer un payement à la commande



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Facture  $facture
     * @return \Illuminate\Http\Response
     */

    public function storePayement(Request $request , Facture $facture){
        //dd( $facture);
        if ($facture->montantRestant>0) {

            if ($request->montantPaye > $facture->montantRestant) {
                return redirect()->route('facture.index')->with('error' , 'Montant payé superieur au montant restant');
            }


            $payement = Payement::create([

                'facture_id'=>$facture->id,
                'montantPaye'=>$request->montantPaye,
                'modePayement'=>$request->modePayement,
                'description'=>$request->description?? null,
                'numero'=> random_int(1000 , 9000).$facture->id

            ]);

            $facture->montantPaye+= $request->montantPaye;
            $facture->montantRestant-=$request->montantPaye;


        $facture->save();

        return redirect()->route('facture.index')->with('success' , 'Payement efectuer avec succès !');
        }


        return redirect()->route('facture.index')->with('success' , 'Facutre entirement payée !');

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
            'statut' => 'non payée',
            'numFacture'=> random_int(10 , 9000).$commande->id
        ]);

        return redirect()->route('facture.index');
    }

    public function envoyer(Facture $facture){

        Mail::to($facture->commande->devis->client->email)->send(new InvoiceMail($facture));

        return redirect()->route('facture.index')->with('success' , 'Facture envoyée avec succès');

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
