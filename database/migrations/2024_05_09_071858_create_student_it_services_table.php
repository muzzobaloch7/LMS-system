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
        Schema::create('student_it_services', function (Blueprint $table) {
            $table->id();
            $table->string('registration_no',30)->nullable();
            $table->string('student_name',30);
            $table->string('student_id_no',30);
            $table->string('department',30);
            $table->string('degree_program',30);
            $table->integer('current_semester');
            $table->string('duration',30);
            $table->string('gender',30);
            $table->string('student_email',30);
            $table->string('student_contact_no',20);
            $table->string('hostel_name',30)->nullable();
            $table->integer('floor_no')->nullable();
            $table->integer('room_no')->nullable();
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
        Schema::dropIfExists('student_it_services');
    }
};
