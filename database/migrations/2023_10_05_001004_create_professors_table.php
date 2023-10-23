<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('professors', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('dni', 8)->unique();
            $table->string('lastName', 40);
            $table->string('motherLastName', 40);
            $table->string('firstName', 40);
            $table->date('birthDate');
            $table->binary('gender', 2);
            $table->char('nationality', 3)->charset('ascii');
            $table->char('ubigeoCode', 6);
            $table->unsignedBigInteger('mediaContactId');
            $table->timestamps();


            $table->foreign('mediaContactId')->references('id')->on('media_contacts');
            //$table->foreignUuid('mediaContactId')->references('id')->on('media_contacts');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('professors');
    }
};
