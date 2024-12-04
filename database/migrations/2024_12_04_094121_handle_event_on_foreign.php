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
        Schema::table('batiments',function(Blueprint $table):void
        {
            $table->foreignId('event_id')->nullable()->constrained('events')->nullOnDelete();
        });

        Schema::table('tours',function(Blueprint $table):void
        {
            $table->foreignId('event_id')->nullable()->constrained('events')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
