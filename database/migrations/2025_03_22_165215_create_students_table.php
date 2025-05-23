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
            // N°,N° d'inscription,Nom,Prénom,MG,Crédit aquis,Décision
    /*class Etudiant {
    - int matricule
    - String nom
    - String prenom
    - String email
    - float moyenne
}*/
        Schema::create('students', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->string('firstname');
            $table->string('lastname');
            $table->decimal('average', 5, 3);
            $table->integer('credit');
            $table->unsignedBigInteger('speciality_id');

            $table->string('decision');
            $table->timestamps();

            $table->foreign('speciality_id')
            ->references('id') ->on('specialities')->onDelete('cascade') ;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
