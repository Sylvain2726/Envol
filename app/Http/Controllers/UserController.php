<?php

namespace App\Http\Controllers;

use App\enum\PermissionsEnum;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(): View
    {


        $user = User::find(Auth::user()->id) ;


        if (!$user->can(PermissionsEnum::GERER_UTILISATEURS->value)) {

           abort(403, 'Vous n\'avez pas la permission de gérer les utilisateurs.');
       }
        $users = User::query()->paginate(10);
        $roles = Role::all();

        return view('users.index', compact('users' , 'roles'));
    }

    public function assignerRoleToUser(Request $request,User $user){

        foreach ($request->name as $role) {
            $user->assignRole($role);
        }

        return redirect()->route('users.index')->with('success' , 'Les rôles ont été ajouter avec succès !');

    }

    public function retirerRoleToUser(Request $request,User $user){

        foreach ($request->name as $role) {
            $user->removeRole($role);
        }

        return redirect()->route('users.index')->with('success' , 'Roles retirer avec succès !');

    }

    public function delete(  User $user){

        $useer = User::find(Auth::user()->id) ;

        if (!$useer->can(PermissionsEnum::SUPPRIMER_UTILISATEUR->value)) {

           abort(403, 'Vous n\'avez pas la permission de supprimer les utilisateurs.');
       }

        $user->delete();
        return redirect()->route('users.index')->with('success' , 'utilisateur supprimer avec succès !');
    }
}
