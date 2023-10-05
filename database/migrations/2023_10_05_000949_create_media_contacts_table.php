<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('media_contacts', function (Blueprint $table) {
            $table->id();
            $table->string('address');
            $table->string('email');
            $table->string('phone');
            $table->string('socialMedia')->nullable();
            $table->string('linkSocialNetwork', 64)->nullable();        
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media_contacts');
    }
};
