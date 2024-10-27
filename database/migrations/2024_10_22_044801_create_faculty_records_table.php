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
        Schema::create('faculty_records', function (Blueprint $table) {
            $table->id();
            $table->string('staff_photo');
            $table->string('staff_name',50);
            $table->string('relationship_status',50);
            $table->string('father_husband',50);
            $table->string('department',50);
            $table->string('duration',50);
            $table->string('staff_id_no',50);
            $table->string('staff_email',50);
            $table->date('staff_dob');
            $table->string('staff_bg',50)->default('unkown');
            $table->string('staff_contact_no',50);
            $table->string('staff_emergency_contact_no',56)->default('N/A');
            $table->string('staff_address',100);
            $table->string('staff_nic_no',30);
            $table->unsignedBigInteger('user_id')->default(0);
            $table->boolean('accepted')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faculty_records');
    }
};
