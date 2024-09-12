<?php

namespace App\Http\Controllers;

use App\enum\PermissionsEnum;
use App\enum\RoleEnum;
use App\Events\UserModified;
use App\Http\Requests\ClientFormRequest;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Can;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


use function Ramsey\Uuid\v1;

class ClientController extends Controller
{
    /**
     * Voir la liste des clients.
     */
    public function index(Request $request): View
    {
       
         $user = User::find(Auth::user()->id) ;


         if (!$user->can(PermissionsEnum::GERER_CLIENTS->value)) {

            abort(403, 'Vous n\'avez pas la permission de gérer les clients.');
        }


        $clients = Client::query()
            //Grace à la methode where et orwhere on va filtrer la recherche sur les differents champs de  la BD
            ->where('firstname', 'like', "%" . $request->input('search') . "%")
            ->orwhere('name', 'like', "%" . $request->input('search') . "%")
            ->orwhere('phone', 'like', "%" . $request->input('search') . "%")
            ->orwhere('email', 'like', "%" . $request->input('search') . "%")
            ->orWhere('address', 'like', "%" . $request->input('search') . "%")
            ->orderBy('created_at', 'desc')->paginate();



        return view('client.index', compact('clients', 'request'));
    }

    /**
     * Afficher le formulaire de création de client.
     */
    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $user = User::find(Auth::user()->id) ;


        if (!$user->can(PermissionsEnum::GERER_CLIENTS->value)) {

           abort(403, 'Vous n\'avez pas la permission de gérer les clients.');
       }

        return view('client.create');
    }

    /**
     * Methode pour enregistrer le client dans la BD.
     */
    public function store(ClientFormRequest $request)
    {
        $user = User::find(Auth::user()->id) ;


        if (!$user->can(PermissionsEnum::GERER_CLIENTS->value)) {

           abort(403, 'Vous n\'avez pas la permission de gérer les clients.');
       }
        $client = Client::create($request->validated());

        return redirect()->route('client.index')->with('success', 'Client a bien été enregistré.');
    }


    /**
     * Afficher le formulaire de mise à jour d'un client.
     */
    public function edit(Client $client)

    {
        $user = User::find(Auth::user()->id) ;


        if (!$user->can(PermissionsEnum::GERER_CLIENTS->value)) {

           abort(403, 'Vous n\'avez pas la permission de modifier un client.');
       }
        //dd($client);
        return view('client.edit', compact('client'));
    }

    /**
     * Faire la mise à jour d'un client specifique.
     */
    public function update(Client $client, ClientFormRequest $request)
    {
        $user = User::find(Auth::user()->id) ;
        if (!$user->can(PermissionsEnum::GERER_CLIENTS->value)) {
            abort(403, 'Vous n\'avez pas la permission de modifier un client.');
        }


        $client->update($request->validated());

        return redirect()->route('client.index')->with('success', 'Client a bien été modifier.');
    }

    /**
     * Supprimer un client.
     */
    public function destroy(Client $client)
    {
        $user = User::find(Auth::user()->id) ;
        if (!$user->can(PermissionsEnum::SUPPRIMER_CLIENT->value)) {

            abort(403, 'Vous ne pouver pas supprimer un client, seul les administrateurs peuvent le faire.');
        }
        $client->delete();
        return redirect()->route('client.index');
    }

    // permet de recuéperer le client pour remplire dynamiquements le champs dans le formulaire de devis
    public function show_client(int $id){

        $client = Client::find($id);

        return response()->json($client);
    }
}
