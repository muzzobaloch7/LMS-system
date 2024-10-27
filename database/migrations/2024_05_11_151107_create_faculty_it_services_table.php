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
        Schema::create('faculty_it_services', function (Blueprint $table) {
            $table->id();
            $table->string('faculty_name',30);
            $table->string('faculty_designation',30);
            $table->string('department',30);
            $table->string('faculty_status',30);
            $table->string('faculty_id_no',30);
            $table->string('gender',30);
            $table->string('faculty_email',30);
            $table->string('faculty_contact_no',20);
            $table->string('hostel_name',30)->nullable();
            $table->integer('floor_no')->nullable();
            $table->integer('room_no')->nullable();
            $table->string('it_services',100);
            $table->unsignedBigInteger('user_id');
            $table->boolean('accepted')->default(false); // Add this line
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faculty_it_services');
    }
};
