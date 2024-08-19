<?php

namespace App\Http\Controllers;

use App\Http\Requests\MagasinFormRequest;
use App\Models\Magasin;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class MagasinController extends Controller
{
    public function index(Request $request)
    {
        $magasins = Magasin::query()
            ->where('name' , 'like' , "%".$request->input('search')."%")
            ->orWhere('address' , 'like' , "%".$request->input('search')."%")
            ->paginate();
        return view('magasin.index', compact('magasins' , 'request'));
    }

    public function create()
    {
        return view('magasin.create');
    }

    public function store(MagasinFormRequest $request): \Illuminate\Http\RedirectResponse
    {
        Magasin::query()->create($request->validated());
        return redirect()->route('magasin.index')->with('success' , 'Magasin ajouté avec succès');
    }

    public function edit(Magasin $magasin)
    {
        return view('magasin.edit', compact('magasin'));
    }

    public function update(MagasinFormRequest $request, Magasin $magasin)
    {
        Magasin::query()->update($request->validated());
        return redirect()->route('magasin.index')->with('success' , 'Magasin modifier avec succès');
    }

    //Supprimer le magasin et toutes les salles associées
    public function destroy(Magasin $magasin)
    {
        $magasin->salles()->delete();
        $magasin->delete();
        return redirect()->route('magasin.index');
    }
}
