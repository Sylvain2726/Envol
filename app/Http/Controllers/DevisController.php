<?php

namespace App\Http\Controllers;

use App\enum\PermissionsEnum;
use App\Events\UserModified;
use App\Models\Client;
use App\Models\Devis;
use App\Models\DevisItem;
use App\Models\Equipement;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeCoverage\Report\Xml\Totals;

class DevisController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(Auth::user()->id) ;
        if (!$user->can(PermissionsEnum::GERER_DEVIS->value)) {

           abort(403, 'Vous n\'avez pas la permission de gérer les devis.');
       }

        $deviss =  Devis::query()->with('devisitems' , 'user')->orderBy('created_at' , 'desc')->paginate(10);
        return view('devis.index',compact('deviss'));
    }


    /**
     * Affiche le formulaire de creation d'un devis
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::find(Auth::user()->id) ;
        if (!$user->can(PermissionsEnum::GERER_DEVIS->value)) {

           abort(403, 'Vous n\'avez pas la permission de gérer les devis.');
       }


        $clients = Client::all();

        return view('devis.etape1', compact('clients'));
    }

    /**
     * Enregistre les informations du client pour le devis.
     * Stocke le client_id dans la session.
     * Redirige vers la deuxième étape.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function post_etape1(Request $request){
        $user = User::find(Auth::user()->id) ;
        if (!$user->can(PermissionsEnum::GERER_DEVIS->value)) {

           abort(403, 'Vous n\'avez pas la permission de gérer les devis.');
       }

        $request->validate([
            'client_id'=>'required|exists:clients,id|numeric',
            'equipements.*.'=>'nullable',
            'quantite'=>'nullable'
        ]);

        $devis =  new Devis();
        $devis->client_id = $request->client_id;
        $request->session()->put('devis' , $devis);

        return redirect()->route('get.etape2');

    }

    /**
     * Affiche la deuxième étape de la création d'un devis, qui affiche la liste des équipements.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function get_etape2(Request $request){
        $user = User::find(Auth::user()->id) ;
        if (!$user->can(PermissionsEnum::GERER_DEVIS->value)) {

           abort(403, 'Vous n\'avez pas la permission de gérer les devis.');
       }

        $equipements = Equipement::all();

        return view('devis.etape2'  , compact('equipements'));
    }

    /**
     * Enregistre les informations de l'équipement pour le devis.
     * Ajoute les équipements au devis.
     * Enregistre le total du devis.
     * Supprime le devis de la session.
     * Redirige vers la liste des devis.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function post_etape2(Request $request){
        $user = User::find(Auth::user()->id) ;
        if (!$user->can(PermissionsEnum::GERER_DEVIS->value)) {

           abort(403, 'Vous n\'avez pas la permission de gérer les devis.');
       }

        $request->validate([
            'equipements.*.quantite'=>'required|numeric',
            'equipements.*.equipement_id'=>'required|numeric'
        ]);

        $devis = $request->session()->get('devis');
        $client = Client::query()->find($devis->client_id);
        $devis->client()->associate($client);
        $devis->user_id = Auth::user()->id;

        $devis->save();

        foreach ($request->equipements as $equipement) {
            $item = Item::query()->find($equipement['equipement_id']);
            if ($equipement['quantite'] > $item->quantite) {
                return redirect()->route('get.etape2');
            }

            $devis->devisItems()->create([

                "equipement_id"=>$item->equipement->id,
                'item_id'=>$item->id,
                "quantite"=>$equipement['quantite'],
                "total"=>$item->equipement->VPrice * $equipement['quantite'],
                'name'=>$item->equipement->name,
                'VPrice'=>$item->equipement->VPrice,
                'type'=>$item->equipement->type
            ]);
        }

        $devis->total = $devis->devisItems->sum('total');

        $devis->save();
        $request->session()->forget('devis');
        return redirect()->route('devis.index')->with('success' , 'Devis a bien été enregistré');

    }

    /**
     * Affiche les détails d'un devis.
     *
     * @param Devis $devi le devis dont on veut afficher les détails
     * @return \Illuminate\Http\Response
     */
    public function detail(Devis $devi)
    {
        $user = User::find(Auth::user()->id) ;
        if (!$user->can(PermissionsEnum::GERER_DEVIS->value)) {

           abort(403, 'Vous n\'avez pas la permission de gérer les devis.');
       }

        $devis = $devi;
        return view('devis.detail', compact('devis'));
    }

    /**
     * Affiche la liste des items du devis.
     *
     * @param Devis $devi le devis dont on veut afficher les items
     * @return \Illuminate\Http\Response
     */
    public function listeItem(Devis $devi){

        $user = User::find(Auth::user()->id) ;
        if (!$user->can(PermissionsEnum::GERER_DEVIS->value)) {

           abort(403, 'Vous n\'avez pas la permission de gérer les devis.');
       }

        $items = $devi->devisItems;

        return view('devis.item' , compact('items' , 'devi'));

    }


    /**
     * Supprime un devis et ses items associés.
     * Redirige vers la liste des devis.
     *
     * @param Devis $devi le devis  supprimer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Devis $devi)
    {

        $user = User::find(Auth::user()->id) ;
        if (!$user->can(PermissionsEnum::SUPPRIMER_DEVIS->value)) {

           abort(403, 'Vous n\'avez pas la permission de supprimer un devis.');
       }
        $devi->devisItems()->delete();
        $devi->delete();

        return redirect()->route('devis.index');
    }
}
