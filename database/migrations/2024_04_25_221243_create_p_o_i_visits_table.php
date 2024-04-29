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
        Schema::create('p_o_i_visits', function (Blueprint $table) {
            $table->id();
            $table->integer('poi_id');
            $table->integer('project_id')->nullable();
            $table->text('device')->nullable();
            $table->string('visit_time');
            $table->string('device_type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('p_o_i_visits');
    }
};
