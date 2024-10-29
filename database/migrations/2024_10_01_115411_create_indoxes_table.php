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
        Schema::create('indoxes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reciever_id');
            $table->string('reciever_name');
            $table->unsignedBigInteger('sender_id');
            $table->string('sender_name');
            $table->string('message');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indoxes');
    }
};
