<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Devis;
use App\Models\DevisItem;
use App\Models\Equipement;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeCoverage\Report\Xml\Totals;

class DevisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deviss =  Devis::query()->with('devisitems' , 'user')->get();


        return view('devis.index',compact('deviss'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::all();
        return view('devis.etape1', compact('clients'));
    }

    public function post_etape1(Request $request){

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

    public function get_etape2(Request $request){

        $equipements = Equipement::all();

        return view('devis.etape2'  , compact('equipements'));
    }

    public function post_etape2(Request $request){

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
     * Store a newly created resource in storage.
     */
    public function detail(Devis $devi)
    {

        $devis = $devi;


        return view('devis.detail', compact('devis'));
    }

    public function listeItem(Devis $devi){


        $items = $devi->devisItems;

        return view('devis.item' , compact('items' , 'devi'));

    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Devis $devi)
    {
        $devi->devisItems()->delete();
        $devi->delete();

        return redirect()->route('devis.index');
    }
}
