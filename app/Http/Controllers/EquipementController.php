<?php

namespace App\Http\Controllers;

use App\enum\PermissionsEnum;
use App\Http\Requests\EquipementFormRequest;
use App\Models\Equipement;
use App\Models\Item;
use App\Models\Salle;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class EquipementController extends Controller
{
    /**
     * Affiche la page d'accueil des équipements.
     * Permet de filtrer les équipements par nom, type ou prix.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $user = User::find(Auth::user()->id) ;
        if (!$user->can(PermissionsEnum::GERER_EQUIPEMENTS->value)) {

           abort(403, 'Vous n\'avez pas la permission de gérer les équipement.');
       }
        $equipements = Equipement::query()
            ->where('name' , 'like' , "%".$request->input('search') ."%")
            ->orwhere('type' , 'like' , "%".$request->input('search') ."%")
            ->orWhere('VPrice' , 'like' , "%".$request->input('search') ."%")->paginate();
        return view('equipement.index', compact('equipements' ,'request'));
    }
    /**
     * Affiche la page de l'inventaire des équipements.
     * Permet de filtrer les équipements par nom, type ou prix.
     *
     * @param Request $request
     * @return View
     */
    public function stock(Request $request){

        $user = User::find(Auth::user()->id) ;
        if (!$user->can(PermissionsEnum::CONSULTER_STOCK->value)) {

           abort(403, 'Vous n\'avez pas la permission de gérer les équipement.');
       }

        $salles = Salle::all();

        $equipements = Equipement::query()
        ->where('name' , 'like' , "%".$request->input('search') ."%")
        ->orwhere('type' , 'like' , "%".$request->input('search') ."%")
        ->orWhere('VPrice' , 'like' , "%".$request->input('search') ."%")
        ->orWhere('Aprice' , 'like' , "%".$request->input('search') ."%")
        ->paginate();
        return view('equipement.stock', compact('equipements' , 'request' , 'salles'));
    }

    /**
     * Affiche la page de création d'un équipement.
     *
     * @return View
     */
    public function create(): View
    {
        $user = User::find(Auth::user()->id) ;
        if (!$user->can(PermissionsEnum::GERER_EQUIPEMENTS->value)) {

           abort(403, 'Vous n\'avez pas la permission de gérer les équipement.');
       }
        return view('equipement.create');
    }

    /**
     * Enregistre un équipement en base de données.
     *
     * @param EquipementFormRequest $request
     * @return RedirectResponse
     */
    public function store(EquipementFormRequest $request)
    {
        $user = User::find(Auth::user()->id) ;
        if (!$user->can(PermissionsEnum::GERER_EQUIPEMENTS->value)) {

           abort(403, 'Vous n\'avez pas la permission de gérer les équipement.');
       }
        Equipement::create($request->validated());

        return redirect()->route('equipement.index')->with('success' , 'Equipement à bien été enregistré');
    }

    /**
     * Affiche la page de modification d'un équipement.
     *
     * @param Equipement $equipement L'équipement à modifier
     * @return View La page de modification
     */
    public function edit(Equipement $equipement):View
    {
        $user = User::find(Auth::user()->id) ;
        if (!$user->can(PermissionsEnum::GERER_EQUIPEMENTS->value)) {

           abort(403, 'Vous n\'avez pas la permission de gérer les équipement.');
       }
        return view('equipement.edit', compact('equipement'));
    }

    /**
     * Met à jour un équipement en base de données.
     *
     * @param EquipementFormRequest $request
     * @param Equipement $equipement L'équipement à mettre à jour
     * @return RedirectResponse
     */
    public function update(EquipementFormRequest $request, Equipement $equipement)
    {
        $user = User::find(Auth::user()->id) ;
        if (!$user->can(PermissionsEnum::GERER_EQUIPEMENTS->value)) {

           abort(403, 'Vous n\'avez pas la permission de gérer les équipement.');
       }

        $equipement->update($request->validated());
        return redirect()->route('equipement.index')->with('success' , 'Equipement à bien été modifier');
    }

    /**
     * Supprime un équipement de la base de données.
     *
     * @param Equipement $equipement L'équipement à supprimer
     * @return RedirectResponse Redirection vers la page de la liste des équipements
     */
    public function destroy(Equipement $equipement):RedirectResponse|View
    {
        $user = User::find(Auth::user()->id) ;
        if (!$user->can(PermissionsEnum::SUPPRIMER_EQUIPEMENT->value)) {

           abort(403, 'Vous n\'avez pas la permission de gérer les équipement.');
       }
        $equipement->delete();
        return redirect()->route('equipement.index');
    }

    /**
     * Renvoie un équipement en format JSON.
     *
     * @param int $id L'ID de l'équipement à renvoyer
     * @return \Illuminate\Http\JsonResponse
     */
    public function show_equipement(int $id){
 

        $items = Item::find($id);
        $equipement = $items->equipement;
        $equipement->items;

        return response()->json($equipement);
    }
}
