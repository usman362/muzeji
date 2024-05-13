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
        Schema::create('p_o_i_media', function (Blueprint $table) {
            $table->id();
            $table->integer('poi_id');
            $table->integer('detail_id');
            $table->enum( 'type', ['image','video','audio','logo','object'] )->default('image');
            $table->string('media_url');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('p_o_i_media');
    }
};
