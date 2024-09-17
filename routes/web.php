<?php

use App\Http\Controllers\AdministrationController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\DevisController;
use App\Http\Controllers\DevisItemController;
use App\Http\Controllers\EntreeController;
use App\Http\Controllers\EquipementController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\LivraisonController;
use App\Http\Controllers\MagasinController;
use App\Http\Controllers\SalleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Models\Client;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::view('about', 'about')->name('about');

    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::delete('supprimer/utilisateur{user}', [UserController::class, 'delete'])->name('users.delete');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('client', ClientController::class);
    Route::resource('equipement', EquipementController::class);
    Route::resource('magasin', MagasinController::class);
    Route::resource('salle', SalleController::class)->except('show');
    Route::resource('devis', DevisController::class);
    Route::resource('itemDevis' , DevisItemController::class);
    Route::resource('entree', EntreeController::class);
    Route::resource('commande', CommandeController::class);
    Route::resource('role' , RoleController::class);



    Route::get('/salls/magasin-{magasin}', [SalleController::class, 'list'])->name('salle.liste');
    Route::get('/entree/detail/{entree}', [EntreeController::class, 'detail'])->name('entree.detail');
    Route::get('/devis/detail/{devi}', [DevisController::class, 'detail'])->name('devis.details');

    Route::post('item/delete/{item}', [EntreeController::class, 'itemDelete'])->name('item.destroy');
    Route::post('/entree/detail/modifer/{item}', [EntreeController::class, 'itemModifer'])->name('item.update');
    Route::get('/items', [EntreeController::class, 'itemIndex'])->name('item.index');
    Route::get('/stock', [EquipementController::class, 'stock'])->name('equipement.stock');
    Route::get('/creation/commande{devi}' , [CommandeController::class, 'createCommande'])->name('commande.form');
    Route::post('/commande/retour/', [CommandeController::class, 'retour'])->name('commande.retour');
    Route::post('/commande/annuler/{commande}', [CommandeController::class, 'annuler'])->name('commande.annuler');
    Route::get('/commande/livraison/{commande}', [LivraisonController::class, 'index'])->name('commande.livraison');
    Route::get('/voir/livraison/{commande}', [LivraisonController::class, 'show'])->name('voir.livraison');
    Route::delete('/supprimer/livraison/{livraison}', [LivraisonController::class, 'destroy'])->name('livraison.destroy');
    Route::get('/creation/payement/{facture}', [FactureController::class ,'createPayment'])->name('facture.createPayment');
    Route::post('/enregistre/facture/{commande}' , [FactureController::class, 'store'])->name('facture.store');
    Route::post('/enregistre/payement/{facture}' , [FactureController::class, 'storePayement'])->name('payement.store');
    Route::get('/facture' , [FactureController::class, 'index'])->name('facture.index');
    Route::get('/envoyer/facture/{facture}' , [FactureController::class, 'envoyer'])->name('facture.envoyer');
    Route::delete('/facture/supprimer{facture}' , [FactureController::class, 'destroy'])->name('facture.destroy');
    Route::get('/facture/gereration{facture}' , [FactureController::class, 'generer'])->name('facture.generer');
    Route::get('/facture/listePayement{facture}' , [FactureController::class, 'listePayement'])->name('facture.payements');
    Route::delete('/supprimer/payement/{payement}' , [FactureController::class, 'deletePayement'])->name('payement.destroy');

    Route::post('etape1/devis/store' , [DevisController::class, 'post_etape1'])->name('post.etape1');
    Route::get('etape2/devis/' , [DevisController::class, 'get_etape2'])->name('get.etape2');
    Route::post('etape2/devis/' , [DevisController::class, 'post_etape2'])->name('post.etape2');
    Route::get('listeItem/devis/{devi}', [DevisController::class , 'listeItem'])->name('devis.items');
    Route::get('details/commande/{commande}', [CommandeController::class, 'detailCommande'])->name('commande.items');
    Route::post('/role/assignerPermission/{role}' ,[RoleController::class, 'assignerPermission'])->name('role.assignerPermission');
    Route::post('/role/retirerPermission/{role}' ,[RoleController::class, 'retirerPermission'])->name('role.retirerPermission');
    Route::post('/utilisateru/assignerRole/{user}' ,[UserController::class, 'assignerRoleToUser'])->name('user.assignerRole');
    Route::post('/utilisateru/retirerRole/{user}' ,[UserController::class, 'retirerRoleToUser'])->name('user.retirerRole');

    //Ces routes permettent juste de remplire automatiquement certain champ en fonction du client ou équipement choisie
    Route::get('voir/client/{id}', [ClientController::class, 'show_client'])->name('show.client');
    Route::get('voir/equipement/{id}', [EquipementController::class, 'show_equipement'])->name('show.equipement');
    Route::get('/voir/magasin/{id}', [MagasinController::class, 'show_magasin'])->name('show.magasin');
    Route::get('/voir/item/{id}', [MagasinController::class, 'listItems'])->name('show.items');
});

require __DIR__ . '/auth.php';
