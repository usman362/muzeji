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
        Schema::create('p_o_i_details', function (Blueprint $table) {
            $table->id();
            $table->integer('poi_id');
            $table->string('language');
            $table->string('title');
            $table->text('description')->nullable();
            $table->boolean('use_google_translate')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('p_o_i_details');
    }
};
