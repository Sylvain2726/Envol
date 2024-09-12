<?php

namespace App\Http\Controllers;

use App\enum\PermissionsEnum;
use App\Http\Requests\MagasinFormRequest;
use App\Models\Magasin;
use App\Models\Salle;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MagasinController extends Controller
{

    public function index(Request $request)
    {
        $user = User::find(Auth::user()->id) ;
        if (!$user->can(PermissionsEnum::GERER_MAGASINS->value)) {

           abort(403, 'Vous n\'avez pas la permission de gerer les magasins.');
       }
        $magasins = Magasin::query()
            ->where('name' , 'like' , "%".$request->input('search')."%")
            ->orWhere('address' , 'like' , "%".$request->input('search')."%")
            ->paginate();
        return view('magasin.index', compact('magasins' , 'request'));
    }

    public function create()
    {
        $user = User::find(Auth::user()->id) ;
        if (!$user->can(PermissionsEnum::GERER_MAGASINS->value)) {

           abort(403, 'Vous n\'avez pas la permission de gerer les magasins.');
       }
        return view('magasin.create');
    }

    public function store(MagasinFormRequest $request): \Illuminate\Http\RedirectResponse
    {
        $user = User::find(Auth::user()->id) ;
        if (!$user->can(PermissionsEnum::GERER_MAGASINS->value)) {

           abort(403, 'Vous n\'avez pas la permission de gerer les magasins.');
       }
        Magasin::query()->create($request->validated());
        return redirect()->route('magasin.index')->with('success' , 'Magasin ajouté avec succès');
    }

    public function edit(Magasin $magasin)
    {
        $user = User::find(Auth::user()->id) ;
        if (!$user->can(PermissionsEnum::GERER_MAGASINS->value)) {

           abort(403, 'Vous n\'avez pas la permission de gerer les magasins.');
       }
        return view('magasin.edit', compact('magasin'));
    }

    public function update(MagasinFormRequest $request, Magasin $magasin)
    {
        $user = User::find(Auth::user()->id) ;
        if (!$user->can(PermissionsEnum::GERER_MAGASINS->value)) {

           abort(403, 'Vous n\'avez pas la permission de gerer les magasins.');
       }
        Magasin::query()->update($request->validated());
        return redirect()->route('magasin.index')->with('success' , 'Magasin modifier avec succès');
    }

    //Supprimer le magasin et toutes les salles associées
    public function destroy(Magasin $magasin)
    {
        $user = User::find(Auth::user()->id) ;
        if (!$user->can(PermissionsEnum::SUPPRIMER_MAGASIN->value)) {

           abort(403, 'Vous n\'avez pas la permission de gerer les magasins.');
       }
        $magasin->salles()->delete();
        $magasin->delete();
        return redirect()->route('magasin.index');
    }

    public function show_magasin(int $id){
        $salle = Salle::find($id);
        $items = $salle->items()->with('equipement')->get();
        //$items->equipement;
        return response()->json($items);

    }
    public function listItems(int $id){
        $salle = Salle::find($id);
        $items = $salle->items;
        $items->equipement();
        return response()->json($salle);
    }
}
