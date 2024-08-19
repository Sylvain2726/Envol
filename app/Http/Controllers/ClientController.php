<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientFormRequest;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\View\View;

use function Ramsey\Uuid\v1;

class ClientController extends Controller
{
    /**
     * Voir la liste des clients.
     */
    public function index(Request $request): View
    {
        $clients = Client::query()
            //Grace à la methode where et orwhere on va filtrer la recherche sur les differents champs de  la BD
            ->where('firstname', 'like', "%" . $request->input('search') . "%")
            ->orwhere('name', 'like', "%" . $request->input('search') . "%")
            ->orwhere('phone', 'like', "%" . $request->input('search') . "%")
            ->orwhere('email', 'like', "%" . $request->input('search') . "%")
            ->orWhere('address', 'like', "%" . $request->input('search') . "%")
            ->paginate();
        return view('client.index', compact('clients', 'request'));
    }

    /**
     * Afficher le formulaire de création de client.
     */
    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        return view('client.create');
    }

    /**
     * Methode pour enregistrer le client dans la BD.
     */
    public function store(ClientFormRequest $request)
    {
        Client::create($request->validated());
        return redirect()->route('client.index')->with('success', 'Client a bien été enregistré.');
    }


    /**
     * Afficher le formulaire de mise à jour d'un client.
     */
    public function edit(Client $client)

    {
        //dd($client);
        return view('client.edit', compact('client'));
    }

    /**
     * Faire la mise à jour d'un client specifique.
     */
    public function update(Client $client, ClientFormRequest $request)
    {


        $client->update($request->validated());

        return redirect()->route('client.index')->with('success', 'Client a bien été modifier.');
    }

    /**
     * Supprimer un client.
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('client.index');
    }

    // permet de recuéperer le client pour remplire dynamiquements le champs dans le formulaire de devis
    public function show_client(int $id){

        $client = Client::find($id);

        return response()->json($client);
    }
}
