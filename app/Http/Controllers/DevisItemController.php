<?php

namespace App\Http\Controllers;

use App\enum\PermissionsEnum;
use App\Models\DevisItem;
use App\Models\Equipement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DevisItemController extends Controller
{


    public function edit(DevisItem $itemDevi)
    {
        $user = User::find(Auth::user()->id) ;
        if (!$user->can(PermissionsEnum::GERER_DEVIS->value)) {

           abort(403, 'Vous n\'avez pas la permission de gérer les devis.');
       }

        $equipements = Equipement::all();
        return view('devis.itemUpdate' , compact('itemDevi' , 'equipements'));

    }

    public function update(Request $request, DevisItem $itemDevi)
    {
        $user = User::find(Auth::user()->id) ;
        if (!$user->can(PermissionsEnum::GERER_DEVIS->value)) {

           abort(403, 'Vous n\'avez pas la permission de gérer les devis.');
       }
        $request->validate([
            'name'=>'required|string|exists:equipements,name',
            'VPrice'=>'required|numeric',
            'quantite'=>'required|integer',
            'type'=>'required|string|exists:equipements,type',

        ]);
        $itemDevi->update([

            'name'=>$request->name,
            'VPrice'=>$request->VPrice,
            'quantite'=>$request->quantite,
            'type'=>$request->type,
            'total'=>$request->VPrice * $request->quantite
        ]);

        $itemDevi->devis->total= $itemDevi->devis->devisItems->sum('total');
        $itemDevi->devis->save();

        return redirect()->route('devis.index')->with('success', 'Item modifier avec success');
    }

    public function destroy(DevisItem $itemDevi)
    {
        $user = User::find(Auth::user()->id) ;
        if (!$user->can(PermissionsEnum::SUPPRIMER_DEVIS->value)) {

           abort(403, 'Vous n\'avez pas la permission supprrimer les détais d\'un devis.');
       }

        $devis = $itemDevi->devis;
        $itemDevi->delete();
        $devis->total= $devis->devisItems->sum('total');
        $devis->save();
        return redirect()->route('devis.index');

    }
}
