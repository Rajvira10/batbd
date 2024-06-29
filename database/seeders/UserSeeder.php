<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    //$table->id();
            // $table->string('full_name');
            // $table->string('preferred_name');
            // $table->string('email')->unique();
            // $table->string('mobile_number')->unique();
            // $table->timestamp('email_verified_at')->nullable();
            // $table->string('password');
            // $table->date('date_of_birth');
            // $table->enum('gender', ['male', 'female']);
            // $table->date('date_of_joining');
            // $table->date('date_of_leaving');
            // $table->string('function');
            // $table->date('anniversary')->nullable();
            // $table->string('blood_group')->nullable();
            // $table->string('other_functions')->nullable();
            // $table->foreignId('country_id')->nullable()->constrained();
            // $table->string('facebook_profile')->nullable();
            // $table->string('whatsapp_number')->nullable();
            // $table->date('spouse_dob')->nullable();
            // $table->string('first_child_name')->nullable();
            // $table->string('second_child_name')->nullable();
            // $table->string('third_child_name')->nullable();
            // $table->text("fun_fact_about_you")->nullable();
            // $table->string("profile_image")->nullable();
            // $table->string("cover_image")->nullable();
            // $table->rememberToken();
            // $table->timestamps();
    public function run(): void
    {
        //create 10 users using faker according to the schema
        for($i = 0; $i < 10; $i++){
            User::create([
                'full_name' => $this->faker->name(),
                'preferred_name' => $this->faker->name(),
                'email' => $this->faker->unique()->safeEmail(),
                'mobile_number' => $this->faker->phoneNumber(),
                'email_verified_at' => now(),
                'password' => $this->faker->password(),
                'date_of_birth' => $this->faker->date(),
                'gender' => 'Male',
                'date_of_joining' => $this->faker->date(),
                'date_of_leaving' => $this->faker->date(),
                'function' => $this->faker->jobTitle(),
                'anniversary' => $this->faker->date(),
                'blood_group' => $this->faker->randomElement(['A+', 'B+', 'AB+', 'O+', 'A-', 'B-', 'AB-', 'O-']),
                'other_functions' => $this->faker->jobTitle(),
                'country_id' => $this->faker->numberBetween(1, 10),
                'facebook_profile' => $this->faker->url(),
                'whatsapp_number' => $this->faker->phoneNumber(),
                'spouse_dob' => $this->faker->date(),
                'first_child_name' => $this->faker->name(),
                'profile_image' => $this->faker->imageUrl(),
                'cover_image' => $this->faker->imageUrl(),
            ]);


                
        }
    }

    public function __construct()
    {
        $this->faker = \Faker\Factory::create();
    }
}
