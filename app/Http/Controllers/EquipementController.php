<?php

namespace App\Http\Controllers;

use App\Http\Requests\EquipementFormRequest;
use App\Models\Equipement;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EquipementController extends Controller
{
    public function index(Request $request): View
    {
        $equipements = Equipement::query()
            ->where('name' , 'like' , "%".$request->input('search') ."%")
            ->orwhere('type' , 'like' , "%".$request->input('search') ."%")
            ->orWhere('VPrice' , 'like' , "%".$request->input('search') ."%")->paginate();
        return view('equipement.index', compact('equipements' ,'request'));
    }
    public function stock(Request $request){

        $equipements = Equipement::query()
        ->where('name' , 'like' , "%".$request->input('search') ."%")
        ->orwhere('type' , 'like' , "%".$request->input('search') ."%")
        ->orWhere('VPrice' , 'like' , "%".$request->input('search') ."%")
        ->orWhere('Aprice' , 'like' , "%".$request->input('search') ."%")
        ->paginate();
        return view('equipement.stock', compact('equipements' , 'request'));
    }

    public function create(): View
    {
        return view('equipement.create');
    }

    public function store(EquipementFormRequest $request)
    {
        Equipement::create($request->validated());

        return redirect()->route('equipement.index')->with('success' , 'Equipement à bien été enregistré');
    }

    public function edit(Equipement $equipement):View
    {
        return view('equipement.edit', compact('equipement'));
    }

    public function update(EquipementFormRequest $request, Equipement $equipement)
    {

        $equipement->update($request->validated());
        return redirect()->route('equipement.index')->with('success' , 'Equipement à bien été modifier');
    }

    public function destroy(Equipement $equipement):RedirectResponse|View
    {
        $equipement->delete();
        return redirect()->route('equipement.index');
    }

    public function show_equipement(int $id){

        $equipement = Equipement::find($id);
        return response()->json($equipement);
    }
}
