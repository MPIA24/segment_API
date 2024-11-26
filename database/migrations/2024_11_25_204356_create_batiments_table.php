<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batiments', function (Blueprint $table) {
            $table->string('id')->primary(); // ID unique (correspond au champ "id" du JSON)
            $table->string('name'); // Nom du bâtiment
            $table->text('description')->nullable(); // Description
            $table->decimal('latitude', 10, 7); // Latitude
            $table->decimal('longitude', 10, 7); // Longitude
            $table->timestamps(); // Timestamps pour created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('batiments');
    }
};
