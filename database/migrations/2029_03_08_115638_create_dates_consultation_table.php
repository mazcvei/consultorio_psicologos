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
        Schema::create('dates_consultation', function (Blueprint $table) {
            $table->id();
            $table->foreignId('psychologist_id')->constrained('users')->onDelete('restrict')->onUpdate('restrict');
            $table->date('date')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dates_consultation');
    }
};
