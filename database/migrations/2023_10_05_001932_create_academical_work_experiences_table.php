<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('academical_work_experiences', function (Blueprint $table) {
            $table->id();
            $table->string('institution', 256);
            $table->char('typeInstitution', 3)->nullable();
            $table->string('position', 64);
            $table->char('typePosition', 3)->nullable();
            $table->dateTime('startedAt');
            $table->dateTime('endedAt');
            $table->unsignedBigInteger('contractTypeId');
            $table->unsignedBigInteger('professorId');
            $table->timestamps();

            $table->foreign('contractTypeId')->references('id')->on('contract_types');
            $table->foreign('professorId')->references('id')->on('professors');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('academical_work_experiences');
    }
};
