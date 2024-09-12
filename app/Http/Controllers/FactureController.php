<?php

namespace App\Http\Controllers;

use App\enum\PermissionsEnum;
use App\Mail\InvoiceMail;
use App\Models\Commande;
use App\Models\Facture;
use App\Models\Payement;
use App\Models\User;
use Generator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class FactureController extends Controller
{

    /**
     * Affiche la liste de toutes les factures
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $user = User::find(Auth::user()->id) ;
        if (!$user->can(PermissionsEnum::GERER_FACTURES->value)) {

           abort(403, 'Vous n\'avez pas la permission de gérer les factures.');
       }
        $factures = Facture::all();
        return view('facture.index', compact('factures'));
    }

    /**
     * Affiche la liste des payements pour  une facture
     *
     * @param Facture $facture
     * @return \Illuminate\Contracts\View\View
     */
    public function listePayement(Facture $facture){
        $user = User::find(Auth::user()->id) ;
        if (!$user->can(PermissionsEnum::GERER_FACTURES->value)) {

           abort(403, 'Vous n\'avez pas la permission de gérer les factures.');
       }
        $payements = $facture->payemants;

        return view('facture.listePayment' , compact('payements'  , 'facture'));
    }


    /**
     * Affiche le formulaire de création d'un payement
     *
     * @param Facture $facture
     * @return \Illuminate\Contracts\View\View
     */
    public function createPayment(Facture $facture)
    {
        $user = User::find(Auth::user()->id) ;
        if (!$user->can(PermissionsEnum::GERER_FACTURES->value)) {

           abort(403, 'Vous n\'avez pas la permission de gérer les payements.');
       }
        return view('facture.create', compact('facture'));
    }




    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Facture $facture
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storePayement(Request $request , Facture $facture){
        //dd( $facture);
        $user = User::find(Auth::user()->id) ;
        if (!$user->can(PermissionsEnum::GERER_FACTURES->value)) {

           abort(403, 'Vous n\'avez pas la permission de gérer les payements.');
       }
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
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Commande $commande
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request , Commande $commande)
    {

        $user = User::find(Auth::user()->id) ;
        if (!$user->can(PermissionsEnum::GERER_FACTURES->value)) {

           abort(403, 'Vous n\'avez pas la permission de gérer les factures.');
       }
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

    /**
     * Envoie une facture par email au client lié à cette facture
     *
     * @param \App\Models\Facture $facture
     * @return \Illuminate\Http\RedirectResponse
     */
    public function envoyer(Facture $facture){
        $user = User::find(Auth::user()->id) ;
        if (!$user->can(PermissionsEnum::GERER_FACTURES->value)) {

           abort(403, 'Vous n\'avez pas la permission de gérer les factures.');
       }

        Mail::to($facture->commande->devis->client->email)->send(new InvoiceMail($facture));

        return redirect()->route('facture.index')->with('success' , 'Facture envoyée avec succès');

    }


    /**
     * Génère la facture liée à la commande $commande
     *
     * @param \App\Models\Facture $facture
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function generer(Facture $facture){
        $user = User::find(Auth::user()->id) ;
        if (!$user->can(PermissionsEnum::GERER_FACTURES->value)) {

           abort(403, 'Vous n\'avez pas la permission de gérer les factures.');
       }
        $items = $facture->commande->commandeItems;
        $commande = $facture->commande;
        return view('facture.genererFacture', compact('facture' , 'commande' , 'items'));

    }





    /**
     * Supprime la facture $facture
     *
     * @param \App\Models\Facture $facture
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Facture $facture)
    {

        $user = User::find(Auth::user()->id) ;
        if (!$user->can(PermissionsEnum::SUPPRIMER_FACTURE->value)) {

           abort(403, 'Vous n\'avez pas la permission de supprimer les factures.');
       }

        $facture->payemants()->delete();
        $facture->delete();
        return redirect()->route('facture.index')->with('success' , 'Facture supprimer avec succès');
    }
}
