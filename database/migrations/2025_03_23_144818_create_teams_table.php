<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

     /*
class Equipe {
    - int id
    - String email1 
    - String email2
    - String username
    - String password
    - String specialité
    - float moyenne_max
    - Sujet sujet_affecté
    - List<Choix> choix
    + ajouterChoix( Choix c )
    + affecterSujet( Sujet s )
    + calculerMoyenneMax()
}*/
    public function up(): void
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("student1_id") ;
            $table->unsignedBigInteger("student2_id")->nullable() ;
            $table->string("student1_email") ;
            $table->string("student2_email")->nullable() ;
            $table->string("username") ;
            $table->string("password") ;
            $table->unsignedBigInteger("speciality_id") ;
            $table->unsignedBigInteger("assigned_subject")->nullable() ;
            $table->decimal("max_average",4,2) ;
            
            $table->timestamp('student1_email_verified_at')->nullable();
            $table->timestamp('student2_email_verified_at')->nullable();

            
            $table->rememberToken();

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
        Schema::dropIfExists('teams');
    }
};
