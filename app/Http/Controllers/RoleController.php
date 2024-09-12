<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $roles =  Role::all();
       $permissions = Permission::all();
        return view('role.index' , compact('roles' , 'permissions'));
    }

    public function assignerPermission( Request $request,Role $role){

        foreach ($request->name as $permission) {
            $role->givePermissionTo($permission);
            $role->save();
        }

        return redirect()->route('role.index')->with('success' , 'Toutes les permissions ont éte ajouter avec succès');

    }

    public function retirerPermission( Request $request,Role $role){

        foreach ($request->name as $permission) {
            $role->revokePermissionTo($permission);
            $role->save();
        }

        return redirect()->route('role.index')->with('success' , 'Les permissions ont été retirer avec succès');

    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255' , Rule::unique('roles', 'name' )],
        ]);

        $role = Role::create(['name' => $request->name]);
        return redirect()->route('role.index')->with('success' , 'Role ajouter avec succes');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        dd($role);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255' , Rule::unique('roles', 'name' )->ignore($role->id)],
        ]);
        $role->update(['name' => $request->name]);
        return redirect()->route('role.index')->with('success' , 'Role modifier avec succes');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('role.index')->with('success' , 'Role supprimer avec succes');
    }
}
