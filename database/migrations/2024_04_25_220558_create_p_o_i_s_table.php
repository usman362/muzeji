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
        Schema::create('p_o_i_s', function (Blueprint $table) {
            $table->id();
            $table->integer('exhibition_id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('short_code');
            $table->string('qr_hash');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('p_o_i_s');
    }
};
