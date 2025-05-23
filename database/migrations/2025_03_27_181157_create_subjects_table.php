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
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique() ;
            $table->text('description') ;
            $table->string('tags')->nullable() ;
            $table->unsignedBigInteger("supervisor_id") ;
            $table->unsignedBigInteger("co_supervisor_id")->nullable() ;
            $table->boolean('is_assigned')->nullable() ;
            $table->unsignedBigInteger("speciality1_id") ;
            $table->unsignedBigInteger("speciality2_id")->nullable() ;
            $table->unsignedBigInteger("speciality3_id")->nullable() ;
            $table->timestamps();

            $table->foreign('supervisor_id')->references('id')
            ->on('teachers')->onDelete('cascade') ;
            $table->foreign('co_supervisor_id')->references('id')
            ->on('teachers')->onDelete('cascade') ;

            $table->foreign('speciality1_id')
            ->references('id') ->on('specialities')->onDelete('cascade') ;
            $table->foreign('speciality2_id')
            ->references('id') ->on('specialities')->onDelete('cascade') ;
            $table->foreign('speciality3_id')
            ->references('id') ->on('specialities')->onDelete('cascade') ;
        });

        Schema::table("subjects",function (Blueprint $table){
            $table->fullText('description') ;
          
        }) ;
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
