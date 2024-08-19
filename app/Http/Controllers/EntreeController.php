<?php

namespace App\Http\Controllers;

use App\Http\Requests\EntreeFormRequest;
use App\Models\Entree;
use App\Models\Equipement;
use App\Models\Item;
use App\Models\Magasin;
use App\Models\Salle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EntreeController extends Controller
{
    public function index()
    {
        $entrees = Entree::query()->with('salle' , 'items')->paginate();
        $magasins = Magasin::all();

        return view('entree.index', compact('entrees', 'magasins'));
    }

    //Voir les details de l'entree
    public function detail(Entree $entree){
        $equipements = Equipement::all();
        $items = $entree->items;
        return view('entree.details', compact('items', 'equipements' , 'equipements'));
    }

    public function create()
    {
        $magasins = Magasin::all();
        $equipements = Equipement::all();
        return view('entree.create' , compact('magasins','equipements'));
    }

    /**
     * Enregistrer une nouvelle entree
     */
    public function store(EntreeFormRequest $request)
    {
            //Recuperer la salle correspondant à la salle selectionée dans le formulaire
            $salle = Salle::query()->find($request->salle_id);
            $entree = new Entree();
            //associer la salle recupere en haut a l'entrée
            $entree->salle()->associate($salle);
            $entree->total = 0;
            $entree->save();
            /**
             * Pour chaque item d'entrée selectionné dans le formulaire
             * on l'ajoute à l'entree directement à la liaison items()
             */
            foreach ($request->equipement as $equipement) {
                $entree->items()->create([
                    'equipement_id' => $equipement['equipement_id'],
                    'Aprice'=>$equipement['Aprice'],
                    'quantite'=>$equipement['quantite'],
                    'total'=>$equipement['Aprice'] * $equipement['quantite'],
                ]);
            }
            //Calculer le total en fonction des totaux des items de l'entrée
            $entree->total = $entree->items->sum('total');
            $entree->save();
            //Mise à jour du stock de chaque equipement
            foreach($request->equipement as $equi){
                $equipem = Equipement::query()->find($equi['equipement_id']);
               /**
                *  Créer un nouveau équipement si le prix d'achat de l'équipment en bd est différent de celui choisie
                **/

                if ($equipem->APrice==null || $equipem->APrice==$equi['Aprice']){
                    $equipem->update([
                        'stock'=> $equipem->stock+=$equi['quantite'],
                        'Aprice'=> $equi['Aprice'],
                ]);
                }else{
                    Equipement::create([
                        'name' => $equipem->name,
                        'type' => $equipem->type,
                        'Vprice' => $equipem->VPrice,
                        'stock' => $equi['quantite'],
                        'Aprice' => $equi['Aprice'],
                    ]);
                }

            };
        return redirect()->route('entree.index');
    }

    public function edit(Entree $entree)
    {
       dd($entree);
       // return view('entree.edit', compact('entree'));
    }

    public function update(Request $request, Entree $entree)
    {
        //dd($request , $entree);
        $entree->update([
            'salle_id' => $request->salle_id
        ]);
        return redirect()->route('entree.index')->with('success' , 'entrée modifier avec succès');
    }
    /**
     * Supprimer une entrée
     */

    public function destroy(Entree $entree)
    {
        $entree->delete();
        return redirect()->route('entree.index');
    }
    /**
     * Supprimer les items d'une entrée
     */
    public function itemDelete(Item $item){
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
     * Modifier les items d'une entrée
     */
    public function itemModifer(Item $item ,  Request $request){
        $item->update([
            'Aprice' => $request->Aprice,
            'equipement_id' => $request->equipement_id,
            'quantite' => $request->quantite,
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
        $items = Item::all();

        return $items;
    }

}
