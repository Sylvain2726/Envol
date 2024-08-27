<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('factures', function (Blueprint $table) {
            $table->id();
            $table->float('total');
            $table->string('statut');
            $table->foreignIdFor(\App\Models\Commande::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\User::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Client::class)->constrained()->cascadeOnDelete();
            $table->integer('numFacture')->generatedAs('facture'. random_int(1000, 9999) . date('Y') . date('m') . date('d') . date('H') . date('i') . date('s'));
            $table->float('montantPaye')->default(0);
            $table->float('montantRestant')->default(0);
            $table->string('modePaiement')->default(null);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factures');
    }
};
