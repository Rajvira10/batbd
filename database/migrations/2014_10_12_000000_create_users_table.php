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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('preferred_name');
            $table->string('email')->unique();
            $table->string('mobile_number')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('account_verified_at')->nullable();
            $table->string('password');
            $table->date('date_of_birth');
            $table->enum('gender', ['male', 'female']);
            $table->date('date_of_joining');
            $table->date('date_of_leaving');
            $table->string('function');
            $table->date('anniversary')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('other_functions')->nullable();
            $table->foreignId('country_id')->nullable()->constrained();
            $table->string('facebook_profile')->nullable();
            $table->string('whatsapp_number')->nullable();
            $table->date('spouse_dob')->nullable();
            $table->string('first_child_name')->nullable();
            $table->string('second_child_name')->nullable();
            $table->string('third_child_name')->nullable();
            $table->text("fun_fact_about_you")->nullable();
            $table->string("profile_image")->nullable();
            $table->string("cover_image")->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
