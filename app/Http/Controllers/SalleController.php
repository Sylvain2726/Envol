<?php

namespace App\Http\Controllers;

use App\Http\Requests\SalleFormRequest;
use App\Models\Magasin;
use App\Models\Salle;
use Illuminate\Http\Request;

class SalleController extends Controller
{
    /**
     * Liste de tout les salles mais pas d'abord utiliser.
     */
    public function index()
    {
        return view('salle.index');
    }

    /**Avoir la liste des salles du magasin passer en parametre */
    public function list(Magasin $magasin)
    {
        //Recuéperer les salle du magasin grace à la relation hasMany()
       $salles =  $magasin->salles;

        return view('salle.index', compact('salles'));
    }

    /**
     * création de de la salle pour le magasin Selectionné .
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);
        $magasin = Magasin::query()->find($request->magasin_id);
        $magasin->salles()->create([
            'name'=>$request->input('name'),
            'magasin_id'=>$magasin->id
        ]);

        return redirect()->route('magasin.index')->with('success' , 'salle ajouté avec succès');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(salle $salle)
    {
        return $salle;
        //return view('salle.edit', compact('salle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SalleFormRequest $request, salle $salle)
    {
        Salle::query()->update($request->validated());
        return redirect()->route('salle.index')->with('success' , 'salle modifier avec succès');
    }

    /**
     * supprimer la salle.
     */
    public function destroy(Salle $salle)
    {
        $salle->delete();
        return redirect()->route('magasin.index')->with('supprimer' , 'Salle supprimer avec succes');
    }
}
