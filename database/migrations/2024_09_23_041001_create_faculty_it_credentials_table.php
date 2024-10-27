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
        Schema::create('faculty_it_credentials', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('micro_username');
            $table->string('turnit_username');
            $table->string('password');
            $table->string('micro_password');
            $table->string('turnit_password');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faculty_it_credentials');
    }
};
