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
        Schema::create('professors', function (Blueprint $table) {
            $table->id();
            $table->string('lastName', 40);
            $table->string('motherLastName', 40);
            $table->string('firstName', 40);
            $table->date('birthDate');
            $table->char('gender', 1);
            $table->char('nationality', 3);
            $table->char('ubigeoCode', 6);
            $table->unsignedBigInteger('mediaContactId');
            $table->unsignedBigInteger('contractTypeId');
            $table->unsignedBigInteger('academicalWorkExperienceId');
            $table->timestamps();

            $table->foreign('mediaContactId')->references('id')->on('media_contacts');
            $table->foreign('contractTypeId')->references('id')->on('contract_types');
            $table->foreign('academicalWorkExperienceId')->references('id')->on('academical_work_experiences');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professors');
    }
};
