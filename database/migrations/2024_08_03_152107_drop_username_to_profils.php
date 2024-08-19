<?php

use App\Models\reseau;
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
        Schema::table('profils', function (Blueprint $table) {
            $table->dropColumn("username");
            $table->dropColumn("plateform");
            $table->string("profession")->nullable();
            $table->string("sexe")->nullable();
            $table->string("domicile")->nullable();
            $table->string("competences")->nullable();
            $table->date("naissance")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profils', function (Blueprint $table) {
            $table->string("username")->nullable();
            $table->string("plateform")->nullable();
           $table->dropColumn("profession");
           $table->dropColumn("sexe");
           $table->dropColumn("domicile");
           $table->dropColumn("competences");
           $table->dropColumn("naissance");
        });
    }
};
