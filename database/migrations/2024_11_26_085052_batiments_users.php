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
        Schema::create('batiments_users', function(Blueprint $table){
            $table->id();
            $table->string('batiment_id');
            $table->string('user_id');
            $table->timestamp('visited_at');
            $table->foreign('batiment_id')->references('id')->on('batiments')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('batiments_users');
    }
};
