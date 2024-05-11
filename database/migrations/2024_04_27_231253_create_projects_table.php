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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('logo')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('bg_color')->nullable();
            $table->string('head_color')->nullable();
            $table->string('splash_color')->nullable();
            $table->string('splash')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
