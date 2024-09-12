<?php

namespace App\Http\Controllers;

use App\enum\PermissionsEnum;
use App\Http\Requests\EntreeFormRequest;
use App\Models\Entree;
use App\Models\Equipement;
use App\Models\Item;
use App\Models\Magasin;
use App\Models\Salle;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EntreeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(Auth::user()->id) ;
        if (!$user->can(PermissionsEnum::GERER_ENTREES->value)) {

           abort(403, 'Vous n\'avez pas la permission de gérer les entrée.');
       }
        $entrees = Entree::query()->with('items')->paginate();
        return view('entree.index', compact('entrees'));
    }

    /**
     * Affiche les détails d'une entrée
     *
     * @param Entree $entree L'entree que l'on souhaite afficher
     * @return \Illuminate\Http\Response
     */
    public function detail(Entree $entree){

        $user = User::find(Auth::user()->id) ;
        if (!$user->can(PermissionsEnum::GERER_ENTREES->value)) {

           abort(403, 'Vous n\'avez pas la permission de gérer les entrée.');
       }
        $equipements = Equipement::all();
        $magasins = Magasin::all();

        $items = $entree->items;
        return view('entree.details', compact('items', 'equipements' , 'magasins'));
    }

    /**
     * Affiche le formulaire de création d'une entrée
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::find(Auth::user()->id) ;
        if (!$user->can(PermissionsEnum::GERER_ENTREES->value)) {

           abort(403, 'Vous n\'avez pas la permission de gérer les entrée.');
       }
        $magasins = Magasin::all();
        $equipements = Equipement::all();
        return view('entree.create' , compact('magasins','equipements'));
    }


        /**
         * Store a newly created resource in storage.
         *
         * @param \Illuminate\Http\Request $request
         * @return \Illuminate\Http\RedirectResponse
         */
    public function store(EntreeFormRequest $request)
    {
        $user = User::find(Auth::user()->id) ;
        if (!$user->can(PermissionsEnum::GERER_ENTREES->value)) {

           abort(403, 'Vous n\'avez pas la permission de gérer les entrée.');
       }

            //Recuperer la salle correspondant à la salle selectionée dans le formulaire
            //$salle = Salle::query()->find($request->salle_id);
            $entree = new Entree();
            $entree->total = 0;
            $entree->save();
            //associer la salle recupere en haut a l'entrée
            //$entree->salle()->associate($salle);

            /**
             * Pour chaque item d'entrée selectionné dans le formulaire
             * on l'ajoute à l'entree directement à la liaison items()
             */
            foreach ($request->equipement as $equipement) {
                $entree->items()->create([
                    'equipement_id' => $equipement['equipement_id'],
                    'Aprice'=>$equipement['Aprice'],
                    'quantite'=>$equipement['quantite'],
                    'salle_id'=>$equipement['salle_id'],
                    'total'=>$equipement['Aprice'] * $equipement['quantite'],
                ]);
            }
            //Calculer le total en fonction des totaux des items de l'entrée
            $entree->total = $entree->items->sum('total');
            $entree->save();

        return redirect()->route('entree.index');
    }

    public function edit(Entree $entree)
    {
        $user = User::find(Auth::user()->id) ;
        if (!$user->can(PermissionsEnum::GERER_ENTREES->value)) {

           abort(403, 'Vous n\'avez pas la permission de gérer les entrée.');
       }
       dd($entree);
       // return view('entree.edit', compact('entree'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Entree  $entree
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Entree $entree)
    {
        $user = User::find(Auth::user()->id) ;
        if (!$user->can(PermissionsEnum::GERER_ENTREES->value)) {

           abort(403, 'Vous n\'avez pas la permission de gérer les entrée.');
       }

        $entree->update([
            'salle_id' => $request->salle_id
        ]);
        return redirect()->route('entree.index')->with('success' , 'entrée modifier avec succès');
    }


    /**
     * Supprime l'entrée et ses items associés, puis redirige vers la page d'accueil des entrées.
     *
     * @param \App\Models\Entree $entree
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Entree $entree)
    {
        $user = User::find(Auth::user()->id) ;
        if (!$user->can(PermissionsEnum::SUPPRIMER_ENTREE->value)) {

           abort(403, 'Vous n\'avez pas la permission de gérer les entrée.');
       }
        $entree->items()->delete();
        $entree->delete();
        return redirect()->route('entree.index');
    }


    /**
     * Supprime un item d'une entrée et met à jour le total de cette entrée,
     * puis redirige vers la page d'accueil des entrées.
     *
     * @param \App\Models\Item $item L'item que l'on souhaite supprimer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function itemDelete(Item $item){

        $user = User::find(Auth::user()->id) ;
        if (!$user->can(PermissionsEnum::SUPPRIMER_ENTREE->value)) {

           abort(403, 'Vous n\'avez pas la permission de gérer les entrée.');
       }
        //dd($item);
        $entree = $item->entree;

        $entree->update([
            'total' => $entree->total-=$item->total
        ]);
        $entree->items()->where('id', $item->id)->delete();
        $item->delete();

        return redirect()->route('entree.index');
    }

    /**
     * Modifie un item d'une entrée et met à jour le total de cette entrée,
     * puis redirige vers la page d'accueil des entrées.
     *
     * @param \App\Models\Item $item L'item que l'on souhaite modifier
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function itemModifer(Item $item ,  Request $request){
        $user = User::find(Auth::user()->id) ;
        if (!$user->can(PermissionsEnum::GERER_ENTREES->value)) {

           abort(403, 'Vous n\'avez pas la permission de gérer les entrée.');
       }

        $request->validate([
            'Aprice'=> 'required|numeric|min:1',
            'equipement_id'=> 'required|numeric|exists:equipements,id',
            'salle_id'=> 'required|numeric|exists:salles,id',
            'quantite'=> 'required|numeric|min:1'
        ]);

        $item->update([
            'Aprice' => $request->Aprice,
            'equipement_id' => $request->equipement_id,
            'quantite' => $request->quantite,
            'salle_id' => $request->salle_id,
            'total' => $request->quantite * $request->Aprice
        ]);
        $entree = $item->entree;
        $entree->update([
            'total' => $entree->total = $entree->items->sum('total')
        ]);

        return redirect()->route('entree.index')->with('success' , 'entrée modifier avec succès');
    }

    /**
     * Retourner la liste des items mais je l'ai fais pour des testes
     */

    public function itemIndex(){
        $user = User::find(Auth::user()->id) ;
        if (!$user->can(PermissionsEnum::GERER_ENTREES->value)) {

           abort(403, 'Vous n\'avez pas la permission de gérer les entrée.');
       }
        $items = Item::all();
        return $items;
    }

}
