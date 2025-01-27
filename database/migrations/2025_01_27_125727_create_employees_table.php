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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id')->unique(); // ID Karyawan
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->text('address');
            $table->date('birth_date');
            $table->enum('gender', ['male', 'female']);
            $table->string('department');
            $table->string('position');
            $table->date('join_date');
            $table->enum('status', ['active', 'probation', 'terminated']);
            $table->decimal('base_salary', 12, 2);
            $table->string('bank_name');
            $table->string('bank_account');
            $table->string('npwp');
            $table->string('bpjs_tk'); // BPJS Ketenagakerjaan
            $table->string('bpjs_kes'); // BPJS Kesehatan
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
