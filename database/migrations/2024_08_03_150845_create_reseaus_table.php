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
            $table->string("facebook")->nullable();
            $table->string("instagram")->nullable();
            $table->string("linkedin")->nullable();
            $table->string("tiktok")->nullable();
            $table->string("theads")->nullable();
            $table->string("telegram")->nullable();
            $table->string("whatsapp")->nullable();
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
