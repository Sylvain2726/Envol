<?php

use App\Models\Devis;
use App\Models\Equipement;
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
        Schema::table('devis_items', function (Blueprint $table) {
            $table->foreignIdFor(Devis::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Equipement::class)->constrained()->cascadeOnDelete();
            $table->integer('quantite')->default(0);
            $table->float('total')->default(0);


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('devis_items', function (Blueprint $table) {
            //
        });
    }
};
