<?php

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
        Schema::table('commande_items', function (Blueprint $table) {
            $table->string('name');
            $table->string('type');
            $table->float('VPrice')->default(0);
            $table->foreignIdFor(Equipement::class)->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('commande_items', function (Blueprint $table) {
            //
        });
    }
};
