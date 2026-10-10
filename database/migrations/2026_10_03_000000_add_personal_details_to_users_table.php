<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('paterno')->nullable();
            $table->string('materno')->nullable();
            $table->string('direccion')->nullable();
            $table->string('carnet', 50)->nullable()->unique();
            $table->string('telefono', 30)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['carnet']);
            $table->dropColumn(['paterno', 'materno', 'direccion', 'carnet', 'telefono']);
        });
    }
};