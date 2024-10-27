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
        Schema::create('result_admins', function (Blueprint $table) {
            $table->id();
            $table->integer('department')->default(0);
            $table->integer('semester')->default(0);
            $table->integer('program')->default(0);
            $table->integer('term')->default(0);
            $table->string('photo')->default('Not Provided');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('result_admins');
    }
};
