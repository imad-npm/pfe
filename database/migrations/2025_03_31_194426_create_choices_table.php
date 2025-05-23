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
        Schema::create('choices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("team_id")->unique();
            $table->unsignedBigInteger("subject1_id") ;
            $table->unsignedBigInteger("subject2_id") ;
            $table->unsignedBigInteger("subject3_id") ;
            $table->unsignedBigInteger("subject4_id") ;
            $table->unsignedBigInteger("subject5_id") ;
            $table->unsignedBigInteger("subject6_id") ;
            $table->unsignedBigInteger("subject7_id") ;
            $table->unsignedBigInteger("subject8_id") ;
            $table->unsignedBigInteger("subject9_id") ;
            $table->unsignedBigInteger("subject10_id") ;
            $table->timestamps();

            $table->foreign('team_id')->references('id')
            ->on('teams')->onDelete('cascade') ;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('choices');
    }
};
