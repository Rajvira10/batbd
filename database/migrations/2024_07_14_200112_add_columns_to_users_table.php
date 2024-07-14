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
        Schema::table('users', function (Blueprint $table) {
            $table->string('fourth_child_name')->nullable();
            $table->date('first_child_dob')->nullable();
            $table->date('second_child_dob')->nullable();
            $table->date('third_child_dob')->nullable();
            $table->date('fourth_child_dob')->nullable();
            $table->string('linkedin_profile')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
