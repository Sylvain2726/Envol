<?php

namespace App\Http\Controllers;

use App\Models\DevisItem;
use App\Models\Equipement;
use Illuminate\Http\Request;

class DevisItemController extends Controller
{

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function edit(DevisItem $itemDevi)
    {
        //dd($itemDevi);

        $equipements = Equipement::all();
        return view('devis.itemUpdate' , compact('itemDevi' , 'equipements'));

    }

    public function update(Request $request, DevisItem $itemDevi)
    {
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

        $devis = $itemDevi->devis;
        $itemDevi->delete();
        $devis->total= $devis->devisItems->sum('total');
        $devis->save();
        return redirect()->route('devis.index');

    }
}
