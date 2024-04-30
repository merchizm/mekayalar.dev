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
        Schema::create('claps', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->unsignedBigInteger('clappable_id');
            $table->unique(['clappable_type', 'clappable_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('claps');
    }
};
