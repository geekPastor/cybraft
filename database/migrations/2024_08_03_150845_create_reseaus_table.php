<?php

use App\Models\Profil;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
//
//Twitter
//Instagram
//Linkedin
//Tik Tok
//Theads
//Telegram
//Whatsapp
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reseaux', function (Blueprint $table) {
            $table->id();
            $table->string("Facebook")->nullable();
            $table->string("Instagram")->nullable();
            $table->string("Linkedin")->nullable();
            $table->string("Tik Tok")->nullable();
            $table->string("Theads")->nullable();
            $table->string("Telegram")->nullable();
            $table->string("Whatsapp")->nullable();
            $table->foreignIdFor(Profil::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reseaux');
    
    }
};
