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
        Schema::table('reseaux', function (Blueprint $table) {
            $table->string('custom_name')->nullable()->comment('Nom du réseau social personnalisé');
            $table->string('custom_url')->nullable()->comment('URL du réseau social personnalisé');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reseaux', function (Blueprint $table) {
            $table->dropColumn(['custom_name', 'custom_url']);
        });
    }
};
