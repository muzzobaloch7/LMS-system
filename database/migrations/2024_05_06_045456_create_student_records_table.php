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
        Schema::create('student_records', function (Blueprint $table) {
            $table->id();
            $table->string('student_photo');
            $table->string('student_name',50);
            $table->string('relationship_status',50);
            $table->string('father_husband',50);
            $table->string('department',50);
            $table->string('duration',50);
            $table->string('student_id_no',50);
            $table->string('student_email',50);
            $table->date('student_dob');
            $table->string('student_bg',50)->default('unkown');
            $table->string('student_contact_no',50);
            $table->string('student_emergency_contact_no',56)->default('N/A');
            $table->string('student_address',100);
            $table->string('student_nic_no',30);
            $table->unsignedBigInteger('user_id')->default(0);
            $table->boolean('accepted')->default(false); // Add this line
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_records');
    }
};
