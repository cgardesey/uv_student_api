<?php

use App\Assignment;
use App\Attendance;
use App\Audio;
use App\Chat;
use App\Course;
use App\Institution;
use App\Instructor;
use App\InstructorCourse;
use App\Notification;
use App\Payment;
use App\RecommendedDoc;
use App\Student;
use App\SubmittedAssignment;
use App\Timetable;
use App\Period;
use App\User;

use Faker\Generator as Faker;
use Illuminate\Database\QueryException;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @param Faker $faker
     * @return void
     */
    public function run(Faker $faker)
    {
        ini_set('memory_limit', '-1');//allocate memory
        DB::disableQueryLog();//disable log

        DB::table('users')->insert([
            [
                'userid' => 'studentLNTwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ1',
                'phonenumber' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'confirmation_token' => Str::random(40),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role' => 'student',
                'api_token' => Str::uuid(),
                'email_verified' => $faker->boolean(),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'userid' => 'studentLNTwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ2',
                'phonenumber' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'confirmation_token' => Str::random(40),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role' => $faker->randomElement(['student', 'instructor', 'admin']),
                'api_token' => Str::uuid(),
                'email_verified' => $faker->boolean(),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'userid' => 'studentLNTwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ3',
                'phonenumber' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'confirmation_token' => Str::random(40),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role' => $faker->randomElement(['student', 'instructor', 'admin']),
                'api_token' => Str::uuid(),
                'email_verified' => $faker->boolean(),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'userid' => 'studentLNTwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ4',
                'phonenumber' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'confirmation_token' => Str::random(40),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role' => $faker->randomElement(['student', 'instructor', 'admin']),
                'api_token' => Str::uuid(),
                'email_verified' => $faker->boolean(),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'userid' => 'studentLNTwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ5',
                'phonenumber' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'confirmation_token' => Str::random(40),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role' => $faker->randomElement(['student', 'instructor', 'admin']),
                'api_token' => Str::uuid(),
                'email_verified' => $faker->boolean(),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'userid' => 'studentLNTwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ6',
                'phonenumber' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'confirmation_token' => Str::random(40),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role' => $faker->randomElement(['student', 'instructor', 'admin']),
                'api_token' => Str::uuid(),
                'email_verified' => $faker->boolean(),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'userid' => 'studentLNTwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ7',
                'phonenumber' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'confirmation_token' => Str::random(40),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role' => $faker->randomElement(['student', 'instructor', 'admin']),
                'api_token' => Str::uuid(),
                'email_verified' => $faker->boolean(),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'userid' => 'studentLNTwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ8',
                'phonenumber' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'confirmation_token' => Str::random(40),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role' => $faker->randomElement(['student', 'instructor', 'admin']),
                'api_token' => Str::uuid(),
                'email_verified' => $faker->boolean(),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'userid' => 'studentLNTwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ9',
                'phonenumber' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'confirmation_token' => Str::random(40),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role' => $faker->randomElement(['student', 'instructor', 'admin']),
                'api_token' => Str::uuid(),
                'email_verified' => $faker->boolean(),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'userid' => 'studentLNTwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc10',
                'phonenumber' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'confirmation_token' => Str::random(40),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role' => $faker->randomElement(['student', 'instructor', 'admin']),
                'api_token' => Str::uuid(),
                'email_verified' => $faker->boolean(),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'userid' => 'studentLNTwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc11',
                'phonenumber' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'confirmation_token' => Str::random(40),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role' => $faker->randomElement(['student', 'instructor', 'admin']),
                'api_token' => Str::uuid(),
                'email_verified' => $faker->boolean(),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'userid' => 'studentLNTwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc12',
                'phonenumber' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'confirmation_token' => Str::random(40),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role' => $faker->randomElement(['student', 'instructor', 'admin']),
                'api_token' => Str::uuid(),
                'email_verified' => $faker->boolean(),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'userid' => 'studentLNTwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc13',
                'phonenumber' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'confirmation_token' => Str::random(40),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role' => $faker->randomElement(['student', 'instructor', 'admin']),
                'api_token' => Str::uuid(),
                'email_verified' => $faker->boolean(),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'userid' => 'studentLNTwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc14',
                'phonenumber' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'confirmation_token' => Str::random(40),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role' => $faker->randomElement(['student', 'instructor', 'admin']),
                'api_token' => Str::uuid(),
                'email_verified' => $faker->boolean(),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'userid' => 'studentLNTwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc15',
                'phonenumber' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'confirmation_token' => Str::random(40),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role' => $faker->randomElement(['student', 'instructor', 'admin']),
                'api_token' => Str::uuid(),
                'email_verified' => $faker->boolean(),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'userid' => 'studentLNTwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc16',
                'phonenumber' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'confirmation_token' => Str::random(40),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role' => $faker->randomElement(['student', 'instructor', 'admin']),
                'api_token' => Str::uuid(),
                'email_verified' => $faker->boolean(),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'userid' => 'studentLNTwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc17',
                'phonenumber' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'confirmation_token' => Str::random(40),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role' => $faker->randomElement(['student', 'instructor', 'admin']),
                'api_token' => Str::uuid(),
                'email_verified' => $faker->boolean(),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'userid' => 'studentLNTwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc18',
                'phonenumber' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'confirmation_token' => Str::random(40),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role' => $faker->randomElement(['student', 'instructor', 'admin']),
                'api_token' => Str::uuid(),
                'email_verified' => $faker->boolean(),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'userid' => 'studentLNTwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc19',
                'phonenumber' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'confirmation_token' => Str::random(40),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role' => $faker->randomElement(['student', 'instructor', 'admin']),
                'api_token' => Str::uuid(),
                'email_verified' => $faker->boolean(),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'userid' => 'studentLNTwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc20',
                'phonenumber' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'confirmation_token' => Str::random(40),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role' => $faker->randomElement(['student', 'instructor', 'admin']),
                'api_token' => Str::uuid(),
                'email_verified' => $faker->boolean(),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'userid' => 'instructorwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ1',
                'phonenumber' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'confirmation_token' => Str::random(40),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role' => $faker->randomElement(['student', 'instructor', 'admin']),
                'api_token' => Str::uuid(),
                'email_verified' => $faker->boolean(),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'userid' => 'instructorwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ2',
                'phonenumber' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'confirmation_token' => Str::random(40),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role' => $faker->randomElement(['student', 'instructor', 'admin']),
                'api_token' => Str::uuid(),
                'email_verified' => $faker->boolean(),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'userid' => 'instructorwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ3',
                'phonenumber' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'confirmation_token' => Str::random(40),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role' => $faker->randomElement(['student', 'instructor', 'admin']),
                'api_token' => Str::uuid(),
                'email_verified' => $faker->boolean(),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'userid' => 'instructorwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ4',
                'phonenumber' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'confirmation_token' => Str::random(40),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role' => $faker->randomElement(['student', 'instructor', 'admin']),
                'api_token' => Str::uuid(),
                'email_verified' => $faker->boolean(),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'userid' => 'instructorwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ5',
                'phonenumber' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'confirmation_token' => Str::random(40),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role' => $faker->randomElement(['student', 'instructor', 'admin']),
                'api_token' => Str::uuid(),
                'email_verified' => $faker->boolean(),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'userid' => 'instructorwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ6',
                'phonenumber' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'confirmation_token' => Str::random(40),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role' => $faker->randomElement(['student', 'instructor', 'admin']),
                'api_token' => Str::uuid(),
                'email_verified' => $faker->boolean(),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'userid' => 'instructorwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ7',
                'phonenumber' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'confirmation_token' => Str::random(40),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role' => $faker->randomElement(['student', 'instructor', 'admin']),
                'api_token' => Str::uuid(),
                'email_verified' => $faker->boolean(),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'userid' => 'instructorwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ8',
                'phonenumber' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'confirmation_token' => Str::random(40),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role' => $faker->randomElement(['student', 'instructor', 'admin']),
                'api_token' => Str::uuid(),
                'email_verified' => $faker->boolean(),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'userid' => 'instructorwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ9',
                'phonenumber' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'confirmation_token' => Str::random(40),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role' => $faker->randomElement(['student', 'instructor', 'admin']),
                'api_token' => Str::uuid(),
                'email_verified' => $faker->boolean(),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'userid' => 'instructorwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc10',
                'phonenumber' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'confirmation_token' => Str::random(40),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role' => $faker->randomElement(['student', 'instructor', 'admin']),
                'api_token' => Str::uuid(),
                'email_verified' => $faker->boolean(),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'userid' => 'instructorwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc11',
                'phonenumber' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'confirmation_token' => Str::random(40),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role' => $faker->randomElement(['student', 'instructor', 'admin']),
                'api_token' => Str::uuid(),
                'email_verified' => $faker->boolean(),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'userid' => 'instructorwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc12',
                'phonenumber' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'confirmation_token' => Str::random(40),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role' => $faker->randomElement(['student', 'instructor', 'admin']),
                'api_token' => Str::uuid(),
                'email_verified' => $faker->boolean(),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'userid' => 'instructorwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc13',
                'phonenumber' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'confirmation_token' => Str::random(40),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role' => $faker->randomElement(['student', 'instructor', 'admin']),
                'api_token' => Str::uuid(),
                'email_verified' => $faker->boolean(),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'userid' => 'instructorwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc14',
                'phonenumber' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'confirmation_token' => Str::random(40),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role' => $faker->randomElement(['student', 'instructor', 'admin']),
                'api_token' => Str::uuid(),
                'email_verified' => $faker->boolean(),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'userid' => 'instructorwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc15',
                'phonenumber' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'confirmation_token' => Str::random(40),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role' => $faker->randomElement(['student', 'instructor', 'admin']),
                'api_token' => Str::uuid(),
                'email_verified' => $faker->boolean(),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'userid' => 'instructorwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc16',
                'phonenumber' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'confirmation_token' => Str::random(40),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role' => $faker->randomElement(['student', 'instructor', 'admin']),
                'api_token' => Str::uuid(),
                'email_verified' => $faker->boolean(),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'userid' => 'instructorwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc17',
                'phonenumber' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'confirmation_token' => Str::random(40),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role' => $faker->randomElement(['student', 'instructor', 'admin']),
                'api_token' => Str::uuid(),
                'email_verified' => $faker->boolean(),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'userid' => 'instructorwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc18',
                'phonenumber' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'confirmation_token' => Str::random(40),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role' => $faker->randomElement(['student', 'instructor', 'admin']),
                'api_token' => Str::uuid(),
                'email_verified' => $faker->boolean(),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'userid' => 'instructorwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc19',
                'phonenumber' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'confirmation_token' => Str::random(40),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role' => $faker->randomElement(['student', 'instructor', 'admin']),
                'api_token' => Str::uuid(),
                'email_verified' => $faker->boolean(),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'userid' => 'instructorwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc20',
                'phonenumber' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'confirmation_token' => Str::random(40),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role' => $faker->randomElement(['student', 'instructor', 'admin']),
                'api_token' => Str::uuid(),
                'email_verified' => $faker->boolean(),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
        DB::table('students')->insert([
            [
                'infoid' => 'studentLNTwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ1',
                'profilepicurl' => $faker->randomElement([
                    '/uploads/user-profile-pics/101.jpg',
                    '/uploads/user-profile-pics/102.jpg',
                    '/uploads/user-profile-pics/103.jpg',
                    '/uploads/user-profile-pics/104.jpg',
                    '/uploads/user-profile-pics/105.jpg',
                    '/uploads/user-profile-pics/106.jpg',
                    '/uploads/user-profile-pics/107.jpg',
                    '/uploads/user-profile-pics/108.jpg',
                    '/uploads/user-profile-pics/109.jpg',
                    '/uploads/user-profile-pics/110.jpg',
                    '/uploads/user-profile-pics/111.jpg',
                    '/uploads/user-profile-pics/113.jpg'
                ]),
                'title' => $faker->randomElement(['Prof.', 'Dr.', 'Mrs.', 'Miss']),
                'firstname' => $faker->firstName($faker->randomElement(['Male', 'Female'])),
                'lastname' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'othername' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'gender' => $faker->randomElement(['Male', 'Female']),
                'dob' => $faker->dateTimeBetween('1990-01-01', '2002-12-31')->format('d/m/Y'),
                'homeaddress' => $faker->address,
                'maritalstatus' => $faker->randomElement([
                    'Single',
                    'Married',
                    'Divorced',
                    'Widowed',
                ]),
                'primarycontact' => $faker->phoneNumber,
                'auxiliarycontact' => $faker->phoneNumber,
                'highestedulevel' => $faker->randomElement([
                    'Basic',
                    'Secondary',
                    'Vocational/Technical',
                    'Bachelors Degree',
                    'Post Graduate'

                ]),
                'highesteduinstitutionname' => $faker->randomElement(['KNUST', 'UCC', 'UG', 'UDS', 'UEW']),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'infoid' => 'studentLNTwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ2',
                'profilepicurl' => $faker->randomElement([
                    '/uploads/user-profile-pics/101.jpg',
                    '/uploads/user-profile-pics/102.jpg',
                    '/uploads/user-profile-pics/103.jpg',
                    '/uploads/user-profile-pics/104.jpg',
                    '/uploads/user-profile-pics/105.jpg',
                    '/uploads/user-profile-pics/106.jpg',
                    '/uploads/user-profile-pics/107.jpg',
                    '/uploads/user-profile-pics/108.jpg',
                    '/uploads/user-profile-pics/109.jpg',
                    '/uploads/user-profile-pics/110.jpg',
                    '/uploads/user-profile-pics/111.jpg',
                    '/uploads/user-profile-pics/113.jpg'
                ]),
                'title' => $faker->randomElement(['Prof.', 'Dr.', 'Mrs.', 'Miss']),
                'firstname' => $faker->firstName($faker->randomElement(['Male', 'Female'])),
                'lastname' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'othername' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'gender' => $faker->randomElement(['Male', 'Female']),
                'dob' => $faker->dateTimeBetween('1990-01-01', '2002-12-31')->format('d/m/Y'),
                'homeaddress' => $faker->address,
                'maritalstatus' => $faker->randomElement([
                    'Single',
                    'Married',
                    'Divorced',
                    'Widowed',
                ]),
                'primarycontact' => $faker->phoneNumber,
                'auxiliarycontact' => $faker->phoneNumber,
                'highestedulevel' => $faker->randomElement([
                    'Basic',
                    'Secondary',
                    'Vocational/Technical',
                    'Bachelors Degree',
                    'Post Graduate'

                ]),
                'highesteduinstitutionname' => $faker->randomElement(['KNUST', 'UCC', 'UG', 'UDS', 'UEW']),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'infoid' => 'studentLNTwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ3',
                'profilepicurl' => $faker->randomElement([
                    '/uploads/user-profile-pics/101.jpg',
                    '/uploads/user-profile-pics/102.jpg',
                    '/uploads/user-profile-pics/103.jpg',
                    '/uploads/user-profile-pics/104.jpg',
                    '/uploads/user-profile-pics/105.jpg',
                    '/uploads/user-profile-pics/106.jpg',
                    '/uploads/user-profile-pics/107.jpg',
                    '/uploads/user-profile-pics/108.jpg',
                    '/uploads/user-profile-pics/109.jpg',
                    '/uploads/user-profile-pics/110.jpg',
                    '/uploads/user-profile-pics/111.jpg',
                    '/uploads/user-profile-pics/113.jpg'
                ]),
                'title' => $faker->randomElement(['Prof.', 'Dr.', 'Mrs.', 'Miss']),
                'firstname' => $faker->firstName($faker->randomElement(['Male', 'Female'])),
                'lastname' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'othername' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'gender' => $faker->randomElement(['Male', 'Female']),
                'dob' => $faker->dateTimeBetween('1990-01-01', '2002-12-31')->format('d/m/Y'),
                'homeaddress' => $faker->address,
                'maritalstatus' => $faker->randomElement([
                    'Single',
                    'Married',
                    'Divorced',
                    'Widowed',
                ]),
                'primarycontact' => $faker->phoneNumber,
                'auxiliarycontact' => $faker->phoneNumber,
                'highestedulevel' => $faker->randomElement([
                    'Basic',
                    'Secondary',
                    'Vocational/Technical',
                    'Bachelors Degree',
                    'Post Graduate'

                ]),
                'highesteduinstitutionname' => $faker->randomElement(['KNUST', 'UCC', 'UG', 'UDS', 'UEW']),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'infoid' => 'studentLNTwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ4',
                'profilepicurl' => $faker->randomElement([
                    '/uploads/user-profile-pics/101.jpg',
                    '/uploads/user-profile-pics/102.jpg',
                    '/uploads/user-profile-pics/103.jpg',
                    '/uploads/user-profile-pics/104.jpg',
                    '/uploads/user-profile-pics/105.jpg',
                    '/uploads/user-profile-pics/106.jpg',
                    '/uploads/user-profile-pics/107.jpg',
                    '/uploads/user-profile-pics/108.jpg',
                    '/uploads/user-profile-pics/109.jpg',
                    '/uploads/user-profile-pics/110.jpg',
                    '/uploads/user-profile-pics/111.jpg',
                    '/uploads/user-profile-pics/113.jpg'
                ]),
                'title' => $faker->randomElement(['Prof.', 'Dr.', 'Mrs.', 'Miss']),
                'firstname' => $faker->firstName($faker->randomElement(['Male', 'Female'])),
                'lastname' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'othername' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'gender' => $faker->randomElement(['Male', 'Female']),
                'dob' => $faker->dateTimeBetween('1990-01-01', '2002-12-31')->format('d/m/Y'),
                'homeaddress' => $faker->address,
                'maritalstatus' => $faker->randomElement([
                    'Single',
                    'Married',
                    'Divorced',
                    'Widowed',
                ]),
                'primarycontact' => $faker->phoneNumber,
                'auxiliarycontact' => $faker->phoneNumber,
                'highestedulevel' => $faker->randomElement([
                    'Basic',
                    'Secondary',
                    'Vocational/Technical',
                    'Bachelors Degree',
                    'Post Graduate'

                ]),
                'highesteduinstitutionname' => $faker->randomElement(['KNUST', 'UCC', 'UG', 'UDS', 'UEW']),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'infoid' => 'studentLNTwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ5',
                'profilepicurl' => $faker->randomElement([
                    '/uploads/user-profile-pics/101.jpg',
                    '/uploads/user-profile-pics/102.jpg',
                    '/uploads/user-profile-pics/103.jpg',
                    '/uploads/user-profile-pics/104.jpg',
                    '/uploads/user-profile-pics/105.jpg',
                    '/uploads/user-profile-pics/106.jpg',
                    '/uploads/user-profile-pics/107.jpg',
                    '/uploads/user-profile-pics/108.jpg',
                    '/uploads/user-profile-pics/109.jpg',
                    '/uploads/user-profile-pics/110.jpg',
                    '/uploads/user-profile-pics/111.jpg',
                    '/uploads/user-profile-pics/113.jpg'
                ]),
                'title' => $faker->randomElement(['Prof.', 'Dr.', 'Mrs.', 'Miss']),
                'firstname' => $faker->firstName($faker->randomElement(['Male', 'Female'])),
                'lastname' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'othername' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'gender' => $faker->randomElement(['Male', 'Female']),
                'dob' => $faker->dateTimeBetween('1990-01-01', '2002-12-31')->format('d/m/Y'),
                'homeaddress' => $faker->address,
                'maritalstatus' => $faker->randomElement([
                    'Single',
                    'Married',
                    'Divorced',
                    'Widowed',
                ]),
                'primarycontact' => $faker->phoneNumber,
                'auxiliarycontact' => $faker->phoneNumber,
                'highestedulevel' => $faker->randomElement([
                    'Basic',
                    'Secondary',
                    'Vocational/Technical',
                    'Bachelors Degree',
                    'Post Graduate'

                ]),
                'highesteduinstitutionname' => $faker->randomElement(['KNUST', 'UCC', 'UG', 'UDS', 'UEW']),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'infoid' => 'studentLNTwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ6',
                'profilepicurl' => $faker->randomElement([
                    '/uploads/user-profile-pics/101.jpg',
                    '/uploads/user-profile-pics/102.jpg',
                    '/uploads/user-profile-pics/103.jpg',
                    '/uploads/user-profile-pics/104.jpg',
                    '/uploads/user-profile-pics/105.jpg',
                    '/uploads/user-profile-pics/106.jpg',
                    '/uploads/user-profile-pics/107.jpg',
                    '/uploads/user-profile-pics/108.jpg',
                    '/uploads/user-profile-pics/109.jpg',
                    '/uploads/user-profile-pics/110.jpg',
                    '/uploads/user-profile-pics/111.jpg',
                    '/uploads/user-profile-pics/113.jpg'
                ]),
                'title' => $faker->randomElement(['Prof.', 'Dr.', 'Mrs.', 'Miss']),
                'firstname' => $faker->firstName($faker->randomElement(['Male', 'Female'])),
                'lastname' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'othername' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'gender' => $faker->randomElement(['Male', 'Female']),
                'dob' => $faker->dateTimeBetween('1990-01-01', '2002-12-31')->format('d/m/Y'),
                'homeaddress' => $faker->address,
                'maritalstatus' => $faker->randomElement([
                    'Single',
                    'Married',
                    'Divorced',
                    'Widowed',
                ]),
                'primarycontact' => $faker->phoneNumber,
                'auxiliarycontact' => $faker->phoneNumber,
                'highestedulevel' => $faker->randomElement([
                    'Basic',
                    'Secondary',
                    'Vocational/Technical',
                    'Bachelors Degree',
                    'Post Graduate'

                ]),
                'highesteduinstitutionname' => $faker->randomElement(['KNUST', 'UCC', 'UG', 'UDS', 'UEW']),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'infoid' => 'studentLNTwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ7',
                'profilepicurl' => $faker->randomElement([
                    '/uploads/user-profile-pics/101.jpg',
                    '/uploads/user-profile-pics/102.jpg',
                    '/uploads/user-profile-pics/103.jpg',
                    '/uploads/user-profile-pics/104.jpg',
                    '/uploads/user-profile-pics/105.jpg',
                    '/uploads/user-profile-pics/106.jpg',
                    '/uploads/user-profile-pics/107.jpg',
                    '/uploads/user-profile-pics/108.jpg',
                    '/uploads/user-profile-pics/109.jpg',
                    '/uploads/user-profile-pics/110.jpg',
                    '/uploads/user-profile-pics/111.jpg',
                    '/uploads/user-profile-pics/113.jpg'
                ]),
                'title' => $faker->randomElement(['Prof.', 'Dr.', 'Mrs.', 'Miss']),
                'firstname' => $faker->firstName($faker->randomElement(['Male', 'Female'])),
                'lastname' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'othername' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'gender' => $faker->randomElement(['Male', 'Female']),
                'dob' => $faker->dateTimeBetween('1990-01-01', '2002-12-31')->format('d/m/Y'),
                'homeaddress' => $faker->address,
                'maritalstatus' => $faker->randomElement([
                    'Single',
                    'Married',
                    'Divorced',
                    'Widowed',
                ]),
                'primarycontact' => $faker->phoneNumber,
                'auxiliarycontact' => $faker->phoneNumber,
                'highestedulevel' => $faker->randomElement([
                    'Basic',
                    'Secondary',
                    'Vocational/Technical',
                    'Bachelors Degree',
                    'Post Graduate'

                ]),
                'highesteduinstitutionname' => $faker->randomElement(['KNUST', 'UCC', 'UG', 'UDS', 'UEW']),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'infoid' => 'studentLNTwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ8',
                'profilepicurl' => $faker->randomElement([
                    '/uploads/user-profile-pics/101.jpg',
                    '/uploads/user-profile-pics/102.jpg',
                    '/uploads/user-profile-pics/103.jpg',
                    '/uploads/user-profile-pics/104.jpg',
                    '/uploads/user-profile-pics/105.jpg',
                    '/uploads/user-profile-pics/106.jpg',
                    '/uploads/user-profile-pics/107.jpg',
                    '/uploads/user-profile-pics/108.jpg',
                    '/uploads/user-profile-pics/109.jpg',
                    '/uploads/user-profile-pics/110.jpg',
                    '/uploads/user-profile-pics/111.jpg',
                    '/uploads/user-profile-pics/113.jpg'
                ]),
                'title' => $faker->randomElement(['Prof.', 'Dr.', 'Mrs.', 'Miss']),
                'firstname' => $faker->firstName($faker->randomElement(['Male', 'Female'])),
                'lastname' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'othername' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'gender' => $faker->randomElement(['Male', 'Female']),
                'dob' => $faker->dateTimeBetween('1990-01-01', '2002-12-31')->format('d/m/Y'),
                'homeaddress' => $faker->address,
                'maritalstatus' => $faker->randomElement([
                    'Single',
                    'Married',
                    'Divorced',
                    'Widowed',
                ]),
                'primarycontact' => $faker->phoneNumber,
                'auxiliarycontact' => $faker->phoneNumber,
                'highestedulevel' => $faker->randomElement([
                    'Basic',
                    'Secondary',
                    'Vocational/Technical',
                    'Bachelors Degree',
                    'Post Graduate'

                ]),
                'highesteduinstitutionname' => $faker->randomElement(['KNUST', 'UCC', 'UG', 'UDS', 'UEW']),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'infoid' => 'studentLNTwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ9',
                'profilepicurl' => $faker->randomElement([
                    '/uploads/user-profile-pics/101.jpg',
                    '/uploads/user-profile-pics/102.jpg',
                    '/uploads/user-profile-pics/103.jpg',
                    '/uploads/user-profile-pics/104.jpg',
                    '/uploads/user-profile-pics/105.jpg',
                    '/uploads/user-profile-pics/106.jpg',
                    '/uploads/user-profile-pics/107.jpg',
                    '/uploads/user-profile-pics/108.jpg',
                    '/uploads/user-profile-pics/109.jpg',
                    '/uploads/user-profile-pics/110.jpg',
                    '/uploads/user-profile-pics/111.jpg',
                    '/uploads/user-profile-pics/113.jpg'
                ]),
                'title' => $faker->randomElement(['Prof.', 'Dr.', 'Mrs.', 'Miss']),
                'firstname' => $faker->firstName($faker->randomElement(['Male', 'Female'])),
                'lastname' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'othername' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'gender' => $faker->randomElement(['Male', 'Female']),
                'dob' => $faker->dateTimeBetween('1990-01-01', '2002-12-31')->format('d/m/Y'),
                'homeaddress' => $faker->address,
                'maritalstatus' => $faker->randomElement([
                    'Single',
                    'Married',
                    'Divorced',
                    'Widowed',
                ]),
                'primarycontact' => $faker->phoneNumber,
                'auxiliarycontact' => $faker->phoneNumber,
                'highestedulevel' => $faker->randomElement([
                    'Basic',
                    'Secondary',
                    'Vocational/Technical',
                    'Bachelors Degree',
                    'Post Graduate'

                ]),
                'highesteduinstitutionname' => $faker->randomElement(['KNUST', 'UCC', 'UG', 'UDS', 'UEW']),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'infoid' => 'studentLNTwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc10',
                'profilepicurl' => $faker->randomElement([
                    '/uploads/user-profile-pics/101.jpg',
                    '/uploads/user-profile-pics/102.jpg',
                    '/uploads/user-profile-pics/103.jpg',
                    '/uploads/user-profile-pics/104.jpg',
                    '/uploads/user-profile-pics/105.jpg',
                    '/uploads/user-profile-pics/106.jpg',
                    '/uploads/user-profile-pics/107.jpg',
                    '/uploads/user-profile-pics/108.jpg',
                    '/uploads/user-profile-pics/109.jpg',
                    '/uploads/user-profile-pics/110.jpg',
                    '/uploads/user-profile-pics/111.jpg',
                    '/uploads/user-profile-pics/113.jpg'
                ]),
                'title' => $faker->randomElement(['Prof.', 'Dr.', 'Mrs.', 'Miss']),
                'firstname' => $faker->firstName($faker->randomElement(['Male', 'Female'])),
                'lastname' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'othername' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'gender' => $faker->randomElement(['Male', 'Female']),
                'dob' => $faker->dateTimeBetween('1990-01-01', '2002-12-31')->format('d/m/Y'),
                'homeaddress' => $faker->address,
                'maritalstatus' => $faker->randomElement([
                    'Single',
                    'Married',
                    'Divorced',
                    'Widowed',
                ]),
                'primarycontact' => $faker->phoneNumber,
                'auxiliarycontact' => $faker->phoneNumber,
                'highestedulevel' => $faker->randomElement([
                    'Basic',
                    'Secondary',
                    'Vocational/Technical',
                    'Bachelors Degree',
                    'Post Graduate'

                ]),
                'highesteduinstitutionname' => $faker->randomElement(['KNUST', 'UCC', 'UG', 'UDS', 'UEW']),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'infoid' => 'studentLNTwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc11',
                'profilepicurl' => $faker->randomElement([
                    '/uploads/user-profile-pics/101.jpg',
                    '/uploads/user-profile-pics/102.jpg',
                    '/uploads/user-profile-pics/103.jpg',
                    '/uploads/user-profile-pics/104.jpg',
                    '/uploads/user-profile-pics/105.jpg',
                    '/uploads/user-profile-pics/106.jpg',
                    '/uploads/user-profile-pics/107.jpg',
                    '/uploads/user-profile-pics/108.jpg',
                    '/uploads/user-profile-pics/109.jpg',
                    '/uploads/user-profile-pics/110.jpg',
                    '/uploads/user-profile-pics/111.jpg',
                    '/uploads/user-profile-pics/113.jpg'
                ]),
                'title' => $faker->randomElement(['Prof.', 'Dr.', 'Mrs.', 'Miss']),
                'firstname' => $faker->firstName($faker->randomElement(['Male', 'Female'])),
                'lastname' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'othername' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'gender' => $faker->randomElement(['Male', 'Female']),
                'dob' => $faker->dateTimeBetween('1990-01-01', '2002-12-31')->format('d/m/Y'),
                'homeaddress' => $faker->address,
                'maritalstatus' => $faker->randomElement([
                    'Single',
                    'Married',
                    'Divorced',
                    'Widowed',
                ]),
                'primarycontact' => $faker->phoneNumber,
                'auxiliarycontact' => $faker->phoneNumber,
                'highestedulevel' => $faker->randomElement([
                    'Basic',
                    'Secondary',
                    'Vocational/Technical',
                    'Bachelors Degree',
                    'Post Graduate'

                ]),
                'highesteduinstitutionname' => $faker->randomElement(['KNUST', 'UCC', 'UG', 'UDS', 'UEW']),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'infoid' => 'studentLNTwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc12',
                'profilepicurl' => $faker->randomElement([
                    '/uploads/user-profile-pics/101.jpg',
                    '/uploads/user-profile-pics/102.jpg',
                    '/uploads/user-profile-pics/103.jpg',
                    '/uploads/user-profile-pics/104.jpg',
                    '/uploads/user-profile-pics/105.jpg',
                    '/uploads/user-profile-pics/106.jpg',
                    '/uploads/user-profile-pics/107.jpg',
                    '/uploads/user-profile-pics/108.jpg',
                    '/uploads/user-profile-pics/109.jpg',
                    '/uploads/user-profile-pics/110.jpg',
                    '/uploads/user-profile-pics/111.jpg',
                    '/uploads/user-profile-pics/113.jpg'
                ]),
                'title' => $faker->randomElement(['Prof.', 'Dr.', 'Mrs.', 'Miss']),
                'firstname' => $faker->firstName($faker->randomElement(['Male', 'Female'])),
                'lastname' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'othername' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'gender' => $faker->randomElement(['Male', 'Female']),
                'dob' => $faker->dateTimeBetween('1990-01-01', '2002-12-31')->format('d/m/Y'),
                'homeaddress' => $faker->address,
                'maritalstatus' => $faker->randomElement([
                    'Single',
                    'Married',
                    'Divorced',
                    'Widowed',
                ]),
                'primarycontact' => $faker->phoneNumber,
                'auxiliarycontact' => $faker->phoneNumber,
                'highestedulevel' => $faker->randomElement([
                    'Basic',
                    'Secondary',
                    'Vocational/Technical',
                    'Bachelors Degree',
                    'Post Graduate'

                ]),
                'highesteduinstitutionname' => $faker->randomElement(['KNUST', 'UCC', 'UG', 'UDS', 'UEW']),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'infoid' => 'studentLNTwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc13',
                'profilepicurl' => $faker->randomElement([
                    '/uploads/user-profile-pics/101.jpg',
                    '/uploads/user-profile-pics/102.jpg',
                    '/uploads/user-profile-pics/103.jpg',
                    '/uploads/user-profile-pics/104.jpg',
                    '/uploads/user-profile-pics/105.jpg',
                    '/uploads/user-profile-pics/106.jpg',
                    '/uploads/user-profile-pics/107.jpg',
                    '/uploads/user-profile-pics/108.jpg',
                    '/uploads/user-profile-pics/109.jpg',
                    '/uploads/user-profile-pics/110.jpg',
                    '/uploads/user-profile-pics/111.jpg',
                    '/uploads/user-profile-pics/113.jpg'
                ]),
                'title' => $faker->randomElement(['Prof.', 'Dr.', 'Mrs.', 'Miss']),
                'firstname' => $faker->firstName($faker->randomElement(['Male', 'Female'])),
                'lastname' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'othername' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'gender' => $faker->randomElement(['Male', 'Female']),
                'dob' => $faker->dateTimeBetween('1990-01-01', '2002-12-31')->format('d/m/Y'),
                'homeaddress' => $faker->address,
                'maritalstatus' => $faker->randomElement([
                    'Single',
                    'Married',
                    'Divorced',
                    'Widowed',
                ]),
                'primarycontact' => $faker->phoneNumber,
                'auxiliarycontact' => $faker->phoneNumber,
                'highestedulevel' => $faker->randomElement([
                    'Basic',
                    'Secondary',
                    'Vocational/Technical',
                    'Bachelors Degree',
                    'Post Graduate'

                ]),
                'highesteduinstitutionname' => $faker->randomElement(['KNUST', 'UCC', 'UG', 'UDS', 'UEW']),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'infoid' => 'studentLNTwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc14',
                'profilepicurl' => $faker->randomElement([
                    '/uploads/user-profile-pics/101.jpg',
                    '/uploads/user-profile-pics/102.jpg',
                    '/uploads/user-profile-pics/103.jpg',
                    '/uploads/user-profile-pics/104.jpg',
                    '/uploads/user-profile-pics/105.jpg',
                    '/uploads/user-profile-pics/106.jpg',
                    '/uploads/user-profile-pics/107.jpg',
                    '/uploads/user-profile-pics/108.jpg',
                    '/uploads/user-profile-pics/109.jpg',
                    '/uploads/user-profile-pics/110.jpg',
                    '/uploads/user-profile-pics/111.jpg',
                    '/uploads/user-profile-pics/113.jpg'
                ]),
                'title' => $faker->randomElement(['Prof.', 'Dr.', 'Mrs.', 'Miss']),
                'firstname' => $faker->firstName($faker->randomElement(['Male', 'Female'])),
                'lastname' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'othername' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'gender' => $faker->randomElement(['Male', 'Female']),
                'dob' => $faker->dateTimeBetween('1990-01-01', '2002-12-31')->format('d/m/Y'),
                'homeaddress' => $faker->address,
                'maritalstatus' => $faker->randomElement([
                    'Single',
                    'Married',
                    'Divorced',
                    'Widowed',
                ]),
                'primarycontact' => $faker->phoneNumber,
                'auxiliarycontact' => $faker->phoneNumber,
                'highestedulevel' => $faker->randomElement([
                    'Basic',
                    'Secondary',
                    'Vocational/Technical',
                    'Bachelors Degree',
                    'Post Graduate'

                ]),
                'highesteduinstitutionname' => $faker->randomElement(['KNUST', 'UCC', 'UG', 'UDS', 'UEW']),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'infoid' => 'studentLNTwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc15',
                'profilepicurl' => $faker->randomElement([
                    '/uploads/user-profile-pics/101.jpg',
                    '/uploads/user-profile-pics/102.jpg',
                    '/uploads/user-profile-pics/103.jpg',
                    '/uploads/user-profile-pics/104.jpg',
                    '/uploads/user-profile-pics/105.jpg',
                    '/uploads/user-profile-pics/106.jpg',
                    '/uploads/user-profile-pics/107.jpg',
                    '/uploads/user-profile-pics/108.jpg',
                    '/uploads/user-profile-pics/109.jpg',
                    '/uploads/user-profile-pics/110.jpg',
                    '/uploads/user-profile-pics/111.jpg',
                    '/uploads/user-profile-pics/113.jpg'
                ]),
                'title' => $faker->randomElement(['Prof.', 'Dr.', 'Mrs.', 'Miss']),
                'firstname' => $faker->firstName($faker->randomElement(['Male', 'Female'])),
                'lastname' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'othername' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'gender' => $faker->randomElement(['Male', 'Female']),
                'dob' => $faker->dateTimeBetween('1990-01-01', '2002-12-31')->format('d/m/Y'),
                'homeaddress' => $faker->address,
                'maritalstatus' => $faker->randomElement([
                    'Single',
                    'Married',
                    'Divorced',
                    'Widowed',
                ]),
                'primarycontact' => $faker->phoneNumber,
                'auxiliarycontact' => $faker->phoneNumber,
                'highestedulevel' => $faker->randomElement([
                    'Basic',
                    'Secondary',
                    'Vocational/Technical',
                    'Bachelors Degree',
                    'Post Graduate'

                ]),
                'highesteduinstitutionname' => $faker->randomElement(['KNUST', 'UCC', 'UG', 'UDS', 'UEW']),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'infoid' => 'studentLNTwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc16',
                'profilepicurl' => $faker->randomElement([
                    '/uploads/user-profile-pics/101.jpg',
                    '/uploads/user-profile-pics/102.jpg',
                    '/uploads/user-profile-pics/103.jpg',
                    '/uploads/user-profile-pics/104.jpg',
                    '/uploads/user-profile-pics/105.jpg',
                    '/uploads/user-profile-pics/106.jpg',
                    '/uploads/user-profile-pics/107.jpg',
                    '/uploads/user-profile-pics/108.jpg',
                    '/uploads/user-profile-pics/109.jpg',
                    '/uploads/user-profile-pics/110.jpg',
                    '/uploads/user-profile-pics/111.jpg',
                    '/uploads/user-profile-pics/113.jpg'
                ]),
                'title' => $faker->randomElement(['Prof.', 'Dr.', 'Mrs.', 'Miss']),
                'firstname' => $faker->firstName($faker->randomElement(['Male', 'Female'])),
                'lastname' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'othername' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'gender' => $faker->randomElement(['Male', 'Female']),
                'dob' => $faker->dateTimeBetween('1990-01-01', '2002-12-31')->format('d/m/Y'),
                'homeaddress' => $faker->address,
                'maritalstatus' => $faker->randomElement([
                    'Single',
                    'Married',
                    'Divorced',
                    'Widowed',
                ]),
                'primarycontact' => $faker->phoneNumber,
                'auxiliarycontact' => $faker->phoneNumber,
                'highestedulevel' => $faker->randomElement([
                    'Basic',
                    'Secondary',
                    'Vocational/Technical',
                    'Bachelors Degree',
                    'Post Graduate'

                ]),
                'highesteduinstitutionname' => $faker->randomElement(['KNUST', 'UCC', 'UG', 'UDS', 'UEW']),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'infoid' => 'studentLNTwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc17',
                'profilepicurl' => $faker->randomElement([
                    '/uploads/user-profile-pics/101.jpg',
                    '/uploads/user-profile-pics/102.jpg',
                    '/uploads/user-profile-pics/103.jpg',
                    '/uploads/user-profile-pics/104.jpg',
                    '/uploads/user-profile-pics/105.jpg',
                    '/uploads/user-profile-pics/106.jpg',
                    '/uploads/user-profile-pics/107.jpg',
                    '/uploads/user-profile-pics/108.jpg',
                    '/uploads/user-profile-pics/109.jpg',
                    '/uploads/user-profile-pics/110.jpg',
                    '/uploads/user-profile-pics/111.jpg',
                    '/uploads/user-profile-pics/113.jpg'
                ]),
                'title' => $faker->randomElement(['Prof.', 'Dr.', 'Mrs.', 'Miss']),
                'firstname' => $faker->firstName($faker->randomElement(['Male', 'Female'])),
                'lastname' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'othername' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'gender' => $faker->randomElement(['Male', 'Female']),
                'dob' => $faker->dateTimeBetween('1990-01-01', '2002-12-31')->format('d/m/Y'),
                'homeaddress' => $faker->address,
                'maritalstatus' => $faker->randomElement([
                    'Single',
                    'Married',
                    'Divorced',
                    'Widowed',
                ]),
                'primarycontact' => $faker->phoneNumber,
                'auxiliarycontact' => $faker->phoneNumber,
                'highestedulevel' => $faker->randomElement([
                    'Basic',
                    'Secondary',
                    'Vocational/Technical',
                    'Bachelors Degree',
                    'Post Graduate'

                ]),
                'highesteduinstitutionname' => $faker->randomElement(['KNUST', 'UCC', 'UG', 'UDS', 'UEW']),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'infoid' => 'studentLNTwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc18',
                'profilepicurl' => $faker->randomElement([
                    '/uploads/user-profile-pics/101.jpg',
                    '/uploads/user-profile-pics/102.jpg',
                    '/uploads/user-profile-pics/103.jpg',
                    '/uploads/user-profile-pics/104.jpg',
                    '/uploads/user-profile-pics/105.jpg',
                    '/uploads/user-profile-pics/106.jpg',
                    '/uploads/user-profile-pics/107.jpg',
                    '/uploads/user-profile-pics/108.jpg',
                    '/uploads/user-profile-pics/109.jpg',
                    '/uploads/user-profile-pics/110.jpg',
                    '/uploads/user-profile-pics/111.jpg',
                    '/uploads/user-profile-pics/113.jpg'
                ]),
                'title' => $faker->randomElement(['Prof.', 'Dr.', 'Mrs.', 'Miss']),
                'firstname' => $faker->firstName($faker->randomElement(['Male', 'Female'])),
                'lastname' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'othername' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'gender' => $faker->randomElement(['Male', 'Female']),
                'dob' => $faker->dateTimeBetween('1990-01-01', '2002-12-31')->format('d/m/Y'),
                'homeaddress' => $faker->address,
                'maritalstatus' => $faker->randomElement([
                    'Single',
                    'Married',
                    'Divorced',
                    'Widowed',
                ]),
                'primarycontact' => $faker->phoneNumber,
                'auxiliarycontact' => $faker->phoneNumber,
                'highestedulevel' => $faker->randomElement([
                    'Basic',
                    'Secondary',
                    'Vocational/Technical',
                    'Bachelors Degree',
                    'Post Graduate'

                ]),
                'highesteduinstitutionname' => $faker->randomElement(['KNUST', 'UCC', 'UG', 'UDS', 'UEW']),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'infoid' => 'studentLNTwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc19',
                'profilepicurl' => $faker->randomElement([
                    '/uploads/user-profile-pics/101.jpg',
                    '/uploads/user-profile-pics/102.jpg',
                    '/uploads/user-profile-pics/103.jpg',
                    '/uploads/user-profile-pics/104.jpg',
                    '/uploads/user-profile-pics/105.jpg',
                    '/uploads/user-profile-pics/106.jpg',
                    '/uploads/user-profile-pics/107.jpg',
                    '/uploads/user-profile-pics/108.jpg',
                    '/uploads/user-profile-pics/109.jpg',
                    '/uploads/user-profile-pics/110.jpg',
                    '/uploads/user-profile-pics/111.jpg',
                    '/uploads/user-profile-pics/113.jpg'
                ]),
                'title' => $faker->randomElement(['Prof.', 'Dr.', 'Mrs.', 'Miss']),
                'firstname' => $faker->firstName($faker->randomElement(['Male', 'Female'])),
                'lastname' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'othername' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'gender' => $faker->randomElement(['Male', 'Female']),
                'dob' => $faker->dateTimeBetween('1990-01-01', '2002-12-31')->format('d/m/Y'),
                'homeaddress' => $faker->address,
                'maritalstatus' => $faker->randomElement([
                    'Single',
                    'Married',
                    'Divorced',
                    'Widowed',
                ]),
                'primarycontact' => $faker->phoneNumber,
                'auxiliarycontact' => $faker->phoneNumber,
                'highestedulevel' => $faker->randomElement([
                    'Basic',
                    'Secondary',
                    'Vocational/Technical',
                    'Bachelors Degree',
                    'Post Graduate'

                ]),
                'highesteduinstitutionname' => $faker->randomElement(['KNUST', 'UCC', 'UG', 'UDS', 'UEW']),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'infoid' => 'studentLNTwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc20',
                'profilepicurl' => $faker->randomElement([
                    '/uploads/user-profile-pics/101.jpg',
                    '/uploads/user-profile-pics/102.jpg',
                    '/uploads/user-profile-pics/103.jpg',
                    '/uploads/user-profile-pics/104.jpg',
                    '/uploads/user-profile-pics/105.jpg',
                    '/uploads/user-profile-pics/106.jpg',
                    '/uploads/user-profile-pics/107.jpg',
                    '/uploads/user-profile-pics/108.jpg',
                    '/uploads/user-profile-pics/109.jpg',
                    '/uploads/user-profile-pics/110.jpg',
                    '/uploads/user-profile-pics/111.jpg',
                    '/uploads/user-profile-pics/113.jpg'
                ]),
                'title' => $faker->randomElement(['Prof.', 'Dr.', 'Mrs.', 'Miss']),
                'firstname' => $faker->firstName($faker->randomElement(['Male', 'Female'])),
                'lastname' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'othername' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'gender' => $faker->randomElement(['Male', 'Female']),
                'dob' => $faker->dateTimeBetween('1990-01-01', '2002-12-31')->format('d/m/Y'),
                'homeaddress' => $faker->address,
                'maritalstatus' => $faker->randomElement([
                    'Single',
                    'Married',
                    'Divorced',
                    'Widowed',
                ]),
                'primarycontact' => $faker->phoneNumber,
                'auxiliarycontact' => $faker->phoneNumber,
                'highestedulevel' => $faker->randomElement([
                    'Basic',
                    'Secondary',
                    'Vocational/Technical',
                    'Bachelors Degree',
                    'Post Graduate'

                ]),
                'highesteduinstitutionname' => $faker->randomElement(['KNUST', 'UCC', 'UG', 'UDS', 'UEW']),
                'created_at' => now(),
                'updated_at' => now()
            ],

        ]);
        DB::table('instructors')->insert([
            [
                'infoid' => 'instructorwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ1',
                'profilepicurl' => $faker->randomElement([
                    '/uploads/user-profile-pics/101.jpg',
                    '/uploads/user-profile-pics/102.jpg',
                    '/uploads/user-profile-pics/103.jpg',
                    '/uploads/user-profile-pics/104.jpg',
                    '/uploads/user-profile-pics/105.jpg',
                    '/uploads/user-profile-pics/106.jpg',
                    '/uploads/user-profile-pics/107.jpg',
                    '/uploads/user-profile-pics/108.jpg',
                    '/uploads/user-profile-pics/109.jpg',
                    '/uploads/user-profile-pics/110.jpg',
                    '/uploads/user-profile-pics/111.jpg',
                    '/uploads/user-profile-pics/113.jpg'
                ]),
                'title' => $faker->randomElement(['Prof.', 'Dr.', 'Mrs.', 'Miss']),
                'firstname' => $faker->firstName($faker->randomElement(['Male', 'Female'])),
                'lastname' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'othername' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'gender' => $faker->randomElement(['Male', 'Female']),
                'dob' => $faker->dateTimeBetween('1990-01-01', '2002-12-31')->format('dd/MM/yyyy'),
                'homeaddress' => $faker->address,
                'maritalstatus' => $faker->randomElement([
                    'Single',
                    'Married',
                    'Divorced',
                    'Widowed',
                ]),
                'primarycontact' => $faker->phoneNumber,
                'auxiliarycontact' => $faker->phoneNumber,
                'edubackground' => $faker->text(30),
                'about' => $faker->text(100),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'infoid' => 'instructorwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ2',
                'profilepicurl' => $faker->randomElement([
                    '/uploads/user-profile-pics/101.jpg',
                    '/uploads/user-profile-pics/102.jpg',
                    '/uploads/user-profile-pics/103.jpg',
                    '/uploads/user-profile-pics/104.jpg',
                    '/uploads/user-profile-pics/105.jpg',
                    '/uploads/user-profile-pics/106.jpg',
                    '/uploads/user-profile-pics/107.jpg',
                    '/uploads/user-profile-pics/108.jpg',
                    '/uploads/user-profile-pics/109.jpg',
                    '/uploads/user-profile-pics/110.jpg',
                    '/uploads/user-profile-pics/111.jpg',
                    '/uploads/user-profile-pics/113.jpg'
                ]),
                'title' => $faker->randomElement(['Prof.', 'Dr.', 'Mrs.', 'Miss']),
                'firstname' => $faker->firstName($faker->randomElement(['Male', 'Female'])),
                'lastname' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'othername' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'gender' => $faker->randomElement(['Male', 'Female']),
                'dob' => $faker->dateTimeBetween('1990-01-01', '2002-12-31')->format('dd/MM/yyyy'),
                'homeaddress' => $faker->address,
                'maritalstatus' => $faker->randomElement([
                    'Single',
                    'Married',
                    'Divorced',
                    'Widowed',
                ]),
                'primarycontact' => $faker->phoneNumber,
                'auxiliarycontact' => $faker->phoneNumber,
                'edubackground' => $faker->text(30),
                'about' => $faker->text(100),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'infoid' => 'instructorwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ3',
                'profilepicurl' => $faker->randomElement([
                    '/uploads/user-profile-pics/101.jpg',
                    '/uploads/user-profile-pics/102.jpg',
                    '/uploads/user-profile-pics/103.jpg',
                    '/uploads/user-profile-pics/104.jpg',
                    '/uploads/user-profile-pics/105.jpg',
                    '/uploads/user-profile-pics/106.jpg',
                    '/uploads/user-profile-pics/107.jpg',
                    '/uploads/user-profile-pics/108.jpg',
                    '/uploads/user-profile-pics/109.jpg',
                    '/uploads/user-profile-pics/110.jpg',
                    '/uploads/user-profile-pics/111.jpg',
                    '/uploads/user-profile-pics/113.jpg'
                ]),
                'title' => $faker->randomElement(['Prof.', 'Dr.', 'Mrs.', 'Miss']),
                'firstname' => $faker->firstName($faker->randomElement(['Male', 'Female'])),
                'lastname' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'othername' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'gender' => $faker->randomElement(['Male', 'Female']),
                'dob' => $faker->dateTimeBetween('1990-01-01', '2002-12-31')->format('dd/MM/yyyy'),
                'homeaddress' => $faker->address,
                'maritalstatus' => $faker->randomElement([
                    'Single',
                    'Married',
                    'Divorced',
                    'Widowed',
                ]),
                'primarycontact' => $faker->phoneNumber,
                'auxiliarycontact' => $faker->phoneNumber,
                'edubackground' => $faker->text(30),
                'about' => $faker->text(100),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'infoid' => 'instructorwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ4',
                'profilepicurl' => $faker->randomElement([
                    '/uploads/user-profile-pics/101.jpg',
                    '/uploads/user-profile-pics/102.jpg',
                    '/uploads/user-profile-pics/103.jpg',
                    '/uploads/user-profile-pics/104.jpg',
                    '/uploads/user-profile-pics/105.jpg',
                    '/uploads/user-profile-pics/106.jpg',
                    '/uploads/user-profile-pics/107.jpg',
                    '/uploads/user-profile-pics/108.jpg',
                    '/uploads/user-profile-pics/109.jpg',
                    '/uploads/user-profile-pics/110.jpg',
                    '/uploads/user-profile-pics/111.jpg',
                    '/uploads/user-profile-pics/113.jpg'
                ]),
                'title' => $faker->randomElement(['Prof.', 'Dr.', 'Mrs.', 'Miss']),
                'firstname' => $faker->firstName($faker->randomElement(['Male', 'Female'])),
                'lastname' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'othername' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'gender' => $faker->randomElement(['Male', 'Female']),
                'dob' => $faker->dateTimeBetween('1990-01-01', '2002-12-31')->format('dd/MM/yyyy'),
                'homeaddress' => $faker->address,
                'maritalstatus' => $faker->randomElement([
                    'Single',
                    'Married',
                    'Divorced',
                    'Widowed',
                ]),
                'primarycontact' => $faker->phoneNumber,
                'auxiliarycontact' => $faker->phoneNumber,
                'edubackground' => $faker->text(30),
                'about' => $faker->text(100),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'infoid' => 'instructorwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ5',
                'profilepicurl' => $faker->randomElement([
                    '/uploads/user-profile-pics/101.jpg',
                    '/uploads/user-profile-pics/102.jpg',
                    '/uploads/user-profile-pics/103.jpg',
                    '/uploads/user-profile-pics/104.jpg',
                    '/uploads/user-profile-pics/105.jpg',
                    '/uploads/user-profile-pics/106.jpg',
                    '/uploads/user-profile-pics/107.jpg',
                    '/uploads/user-profile-pics/108.jpg',
                    '/uploads/user-profile-pics/109.jpg',
                    '/uploads/user-profile-pics/110.jpg',
                    '/uploads/user-profile-pics/111.jpg',
                    '/uploads/user-profile-pics/113.jpg'
                ]),
                'title' => $faker->randomElement(['Prof.', 'Dr.', 'Mrs.', 'Miss']),
                'firstname' => $faker->firstName($faker->randomElement(['Male', 'Female'])),
                'lastname' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'othername' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'gender' => $faker->randomElement(['Male', 'Female']),
                'dob' => $faker->dateTimeBetween('1990-01-01', '2002-12-31')->format('dd/MM/yyyy'),
                'homeaddress' => $faker->address,
                'maritalstatus' => $faker->randomElement([
                    'Single',
                    'Married',
                    'Divorced',
                    'Widowed',
                ]),
                'primarycontact' => $faker->phoneNumber,
                'auxiliarycontact' => $faker->phoneNumber,
                'edubackground' => $faker->text(30),
                'about' => $faker->text(100),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'infoid' => 'instructorwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ6',
                'profilepicurl' => $faker->randomElement([
                    '/uploads/user-profile-pics/101.jpg',
                    '/uploads/user-profile-pics/102.jpg',
                    '/uploads/user-profile-pics/103.jpg',
                    '/uploads/user-profile-pics/104.jpg',
                    '/uploads/user-profile-pics/105.jpg',
                    '/uploads/user-profile-pics/106.jpg',
                    '/uploads/user-profile-pics/107.jpg',
                    '/uploads/user-profile-pics/108.jpg',
                    '/uploads/user-profile-pics/109.jpg',
                    '/uploads/user-profile-pics/110.jpg',
                    '/uploads/user-profile-pics/111.jpg',
                    '/uploads/user-profile-pics/113.jpg'
                ]),
                'title' => $faker->randomElement(['Prof.', 'Dr.', 'Mrs.', 'Miss']),
                'firstname' => $faker->firstName($faker->randomElement(['Male', 'Female'])),
                'lastname' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'othername' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'gender' => $faker->randomElement(['Male', 'Female']),
                'dob' => $faker->dateTimeBetween('1990-01-01', '2002-12-31')->format('dd/MM/yyyy'),
                'homeaddress' => $faker->address,
                'maritalstatus' => $faker->randomElement([
                    'Single',
                    'Married',
                    'Divorced',
                    'Widowed',
                ]),
                'primarycontact' => $faker->phoneNumber,
                'auxiliarycontact' => $faker->phoneNumber,
                'edubackground' => $faker->text(30),
                'about' => $faker->text(100),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'infoid' => 'instructorwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ7',
                'profilepicurl' => $faker->randomElement([
                    '/uploads/user-profile-pics/101.jpg',
                    '/uploads/user-profile-pics/102.jpg',
                    '/uploads/user-profile-pics/103.jpg',
                    '/uploads/user-profile-pics/104.jpg',
                    '/uploads/user-profile-pics/105.jpg',
                    '/uploads/user-profile-pics/106.jpg',
                    '/uploads/user-profile-pics/107.jpg',
                    '/uploads/user-profile-pics/108.jpg',
                    '/uploads/user-profile-pics/109.jpg',
                    '/uploads/user-profile-pics/110.jpg',
                    '/uploads/user-profile-pics/111.jpg',
                    '/uploads/user-profile-pics/113.jpg'
                ]),
                'title' => $faker->randomElement(['Prof.', 'Dr.', 'Mrs.', 'Miss']),
                'firstname' => $faker->firstName($faker->randomElement(['Male', 'Female'])),
                'lastname' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'othername' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'gender' => $faker->randomElement(['Male', 'Female']),
                'dob' => $faker->dateTimeBetween('1990-01-01', '2002-12-31')->format('dd/MM/yyyy'),
                'homeaddress' => $faker->address,
                'maritalstatus' => $faker->randomElement([
                    'Single',
                    'Married',
                    'Divorced',
                    'Widowed',
                ]),
                'primarycontact' => $faker->phoneNumber,
                'auxiliarycontact' => $faker->phoneNumber,
                'edubackground' => $faker->text(30),
                'about' => $faker->text(100),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'infoid' => 'instructorwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ8',
                'profilepicurl' => $faker->randomElement([
                    '/uploads/user-profile-pics/101.jpg',
                    '/uploads/user-profile-pics/102.jpg',
                    '/uploads/user-profile-pics/103.jpg',
                    '/uploads/user-profile-pics/104.jpg',
                    '/uploads/user-profile-pics/105.jpg',
                    '/uploads/user-profile-pics/106.jpg',
                    '/uploads/user-profile-pics/107.jpg',
                    '/uploads/user-profile-pics/108.jpg',
                    '/uploads/user-profile-pics/109.jpg',
                    '/uploads/user-profile-pics/110.jpg',
                    '/uploads/user-profile-pics/111.jpg',
                    '/uploads/user-profile-pics/113.jpg'
                ]),
                'title' => $faker->randomElement(['Prof.', 'Dr.', 'Mrs.', 'Miss']),
                'firstname' => $faker->firstName($faker->randomElement(['Male', 'Female'])),
                'lastname' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'othername' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'gender' => $faker->randomElement(['Male', 'Female']),
                'dob' => $faker->dateTimeBetween('1990-01-01', '2002-12-31')->format('dd/MM/yyyy'),
                'homeaddress' => $faker->address,
                'maritalstatus' => $faker->randomElement([
                    'Single',
                    'Married',
                    'Divorced',
                    'Widowed',
                ]),
                'primarycontact' => $faker->phoneNumber,
                'auxiliarycontact' => $faker->phoneNumber,
                'edubackground' => $faker->text(30),
                'about' => $faker->text(100),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'infoid' => 'instructorwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ9',
                'profilepicurl' => $faker->randomElement([
                    '/uploads/user-profile-pics/101.jpg',
                    '/uploads/user-profile-pics/102.jpg',
                    '/uploads/user-profile-pics/103.jpg',
                    '/uploads/user-profile-pics/104.jpg',
                    '/uploads/user-profile-pics/105.jpg',
                    '/uploads/user-profile-pics/106.jpg',
                    '/uploads/user-profile-pics/107.jpg',
                    '/uploads/user-profile-pics/108.jpg',
                    '/uploads/user-profile-pics/109.jpg',
                    '/uploads/user-profile-pics/110.jpg',
                    '/uploads/user-profile-pics/111.jpg',
                    '/uploads/user-profile-pics/113.jpg'
                ]),
                'title' => $faker->randomElement(['Prof.', 'Dr.', 'Mrs.', 'Miss']),
                'firstname' => $faker->firstName($faker->randomElement(['Male', 'Female'])),
                'lastname' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'othername' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'gender' => $faker->randomElement(['Male', 'Female']),
                'dob' => $faker->dateTimeBetween('1990-01-01', '2002-12-31')->format('dd/MM/yyyy'),
                'homeaddress' => $faker->address,
                'maritalstatus' => $faker->randomElement([
                    'Single',
                    'Married',
                    'Divorced',
                    'Widowed',
                ]),
                'primarycontact' => $faker->phoneNumber,
                'auxiliarycontact' => $faker->phoneNumber,
                'edubackground' => $faker->text(30),
                'about' => $faker->text(100),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'infoid' => 'instructorwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc10',
                'profilepicurl' => $faker->randomElement([
                    '/uploads/user-profile-pics/101.jpg',
                    '/uploads/user-profile-pics/102.jpg',
                    '/uploads/user-profile-pics/103.jpg',
                    '/uploads/user-profile-pics/104.jpg',
                    '/uploads/user-profile-pics/105.jpg',
                    '/uploads/user-profile-pics/106.jpg',
                    '/uploads/user-profile-pics/107.jpg',
                    '/uploads/user-profile-pics/108.jpg',
                    '/uploads/user-profile-pics/109.jpg',
                    '/uploads/user-profile-pics/110.jpg',
                    '/uploads/user-profile-pics/111.jpg',
                    '/uploads/user-profile-pics/113.jpg'
                ]),
                'title' => $faker->randomElement(['Prof.', 'Dr.', 'Mrs.', 'Miss']),
                'firstname' => $faker->firstName($faker->randomElement(['Male', 'Female'])),
                'lastname' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'othername' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'gender' => $faker->randomElement(['Male', 'Female']),
                'dob' => $faker->dateTimeBetween('1990-01-01', '2002-12-31')->format('dd/MM/yyyy'),
                'homeaddress' => $faker->address,
                'maritalstatus' => $faker->randomElement([
                    'Single',
                    'Married',
                    'Divorced',
                    'Widowed',
                ]),
                'primarycontact' => $faker->phoneNumber,
                'auxiliarycontact' => $faker->phoneNumber,
                'edubackground' => $faker->text(30),
                'about' => $faker->text(100),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'infoid' => 'instructorwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc11',
                'profilepicurl' => $faker->randomElement([
                    '/uploads/user-profile-pics/101.jpg',
                    '/uploads/user-profile-pics/102.jpg',
                    '/uploads/user-profile-pics/103.jpg',
                    '/uploads/user-profile-pics/104.jpg',
                    '/uploads/user-profile-pics/105.jpg',
                    '/uploads/user-profile-pics/106.jpg',
                    '/uploads/user-profile-pics/107.jpg',
                    '/uploads/user-profile-pics/108.jpg',
                    '/uploads/user-profile-pics/109.jpg',
                    '/uploads/user-profile-pics/110.jpg',
                    '/uploads/user-profile-pics/111.jpg',
                    '/uploads/user-profile-pics/113.jpg'
                ]),
                'title' => $faker->randomElement(['Prof.', 'Dr.', 'Mrs.', 'Miss']),
                'firstname' => $faker->firstName($faker->randomElement(['Male', 'Female'])),
                'lastname' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'othername' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'gender' => $faker->randomElement(['Male', 'Female']),
                'dob' => $faker->dateTimeBetween('1990-01-01', '2002-12-31')->format('dd/MM/yyyy'),
                'homeaddress' => $faker->address,
                'maritalstatus' => $faker->randomElement([
                    'Single',
                    'Married',
                    'Divorced',
                    'Widowed',
                ]),
                'primarycontact' => $faker->phoneNumber,
                'auxiliarycontact' => $faker->phoneNumber,
                'edubackground' => $faker->text(30),
                'about' => $faker->text(100),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'infoid' => 'instructorwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc12',
                'profilepicurl' => $faker->randomElement([
                    '/uploads/user-profile-pics/101.jpg',
                    '/uploads/user-profile-pics/102.jpg',
                    '/uploads/user-profile-pics/103.jpg',
                    '/uploads/user-profile-pics/104.jpg',
                    '/uploads/user-profile-pics/105.jpg',
                    '/uploads/user-profile-pics/106.jpg',
                    '/uploads/user-profile-pics/107.jpg',
                    '/uploads/user-profile-pics/108.jpg',
                    '/uploads/user-profile-pics/109.jpg',
                    '/uploads/user-profile-pics/110.jpg',
                    '/uploads/user-profile-pics/111.jpg',
                    '/uploads/user-profile-pics/113.jpg'
                ]),
                'title' => $faker->randomElement(['Prof.', 'Dr.', 'Mrs.', 'Miss']),
                'firstname' => $faker->firstName($faker->randomElement(['Male', 'Female'])),
                'lastname' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'othername' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'gender' => $faker->randomElement(['Male', 'Female']),
                'dob' => $faker->dateTimeBetween('1990-01-01', '2002-12-31')->format('dd/MM/yyyy'),
                'homeaddress' => $faker->address,
                'maritalstatus' => $faker->randomElement([
                    'Single',
                    'Married',
                    'Divorced',
                    'Widowed',
                ]),
                'primarycontact' => $faker->phoneNumber,
                'auxiliarycontact' => $faker->phoneNumber,
                'edubackground' => $faker->text(30),
                'about' => $faker->text(100),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'infoid' => 'instructorwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc13',
                'profilepicurl' => $faker->randomElement([
                    '/uploads/user-profile-pics/101.jpg',
                    '/uploads/user-profile-pics/102.jpg',
                    '/uploads/user-profile-pics/103.jpg',
                    '/uploads/user-profile-pics/104.jpg',
                    '/uploads/user-profile-pics/105.jpg',
                    '/uploads/user-profile-pics/106.jpg',
                    '/uploads/user-profile-pics/107.jpg',
                    '/uploads/user-profile-pics/108.jpg',
                    '/uploads/user-profile-pics/109.jpg',
                    '/uploads/user-profile-pics/110.jpg',
                    '/uploads/user-profile-pics/111.jpg',
                    '/uploads/user-profile-pics/113.jpg'
                ]),
                'title' => $faker->randomElement(['Prof.', 'Dr.', 'Mrs.', 'Miss']),
                'firstname' => $faker->firstName($faker->randomElement(['Male', 'Female'])),
                'lastname' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'othername' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'gender' => $faker->randomElement(['Male', 'Female']),
                'dob' => $faker->dateTimeBetween('1990-01-01', '2002-12-31')->format('dd/MM/yyyy'),
                'homeaddress' => $faker->address,
                'maritalstatus' => $faker->randomElement([
                    'Single',
                    'Married',
                    'Divorced',
                    'Widowed',
                ]),
                'primarycontact' => $faker->phoneNumber,
                'auxiliarycontact' => $faker->phoneNumber,
                'edubackground' => $faker->text(30),
                'about' => $faker->text(100),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'infoid' => 'instructorwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc14',
                'profilepicurl' => $faker->randomElement([
                    '/uploads/user-profile-pics/101.jpg',
                    '/uploads/user-profile-pics/102.jpg',
                    '/uploads/user-profile-pics/103.jpg',
                    '/uploads/user-profile-pics/104.jpg',
                    '/uploads/user-profile-pics/105.jpg',
                    '/uploads/user-profile-pics/106.jpg',
                    '/uploads/user-profile-pics/107.jpg',
                    '/uploads/user-profile-pics/108.jpg',
                    '/uploads/user-profile-pics/109.jpg',
                    '/uploads/user-profile-pics/110.jpg',
                    '/uploads/user-profile-pics/111.jpg',
                    '/uploads/user-profile-pics/113.jpg'
                ]),
                'title' => $faker->randomElement(['Prof.', 'Dr.', 'Mrs.', 'Miss']),
                'firstname' => $faker->firstName($faker->randomElement(['Male', 'Female'])),
                'lastname' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'othername' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'gender' => $faker->randomElement(['Male', 'Female']),
                'dob' => $faker->dateTimeBetween('1990-01-01', '2002-12-31')->format('dd/MM/yyyy'),
                'homeaddress' => $faker->address,
                'maritalstatus' => $faker->randomElement([
                    'Single',
                    'Married',
                    'Divorced',
                    'Widowed',
                ]),
                'primarycontact' => $faker->phoneNumber,
                'auxiliarycontact' => $faker->phoneNumber,
                'edubackground' => $faker->text(30),
                'about' => $faker->text(100),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'infoid' => 'instructorwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc15',
                'profilepicurl' => $faker->randomElement([
                    '/uploads/user-profile-pics/101.jpg',
                    '/uploads/user-profile-pics/102.jpg',
                    '/uploads/user-profile-pics/103.jpg',
                    '/uploads/user-profile-pics/104.jpg',
                    '/uploads/user-profile-pics/105.jpg',
                    '/uploads/user-profile-pics/106.jpg',
                    '/uploads/user-profile-pics/107.jpg',
                    '/uploads/user-profile-pics/108.jpg',
                    '/uploads/user-profile-pics/109.jpg',
                    '/uploads/user-profile-pics/110.jpg',
                    '/uploads/user-profile-pics/111.jpg',
                    '/uploads/user-profile-pics/113.jpg'
                ]),
                'title' => $faker->randomElement(['Prof.', 'Dr.', 'Mrs.', 'Miss']),
                'firstname' => $faker->firstName($faker->randomElement(['Male', 'Female'])),
                'lastname' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'othername' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'gender' => $faker->randomElement(['Male', 'Female']),
                'dob' => $faker->dateTimeBetween('1990-01-01', '2002-12-31')->format('dd/MM/yyyy'),
                'homeaddress' => $faker->address,
                'maritalstatus' => $faker->randomElement([
                    'Single',
                    'Married',
                    'Divorced',
                    'Widowed',
                ]),
                'primarycontact' => $faker->phoneNumber,
                'auxiliarycontact' => $faker->phoneNumber,
                'edubackground' => $faker->text(30),
                'about' => $faker->text(100),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'infoid' => 'instructorwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc16',
                'profilepicurl' => $faker->randomElement([
                    '/uploads/user-profile-pics/101.jpg',
                    '/uploads/user-profile-pics/102.jpg',
                    '/uploads/user-profile-pics/103.jpg',
                    '/uploads/user-profile-pics/104.jpg',
                    '/uploads/user-profile-pics/105.jpg',
                    '/uploads/user-profile-pics/106.jpg',
                    '/uploads/user-profile-pics/107.jpg',
                    '/uploads/user-profile-pics/108.jpg',
                    '/uploads/user-profile-pics/109.jpg',
                    '/uploads/user-profile-pics/110.jpg',
                    '/uploads/user-profile-pics/111.jpg',
                    '/uploads/user-profile-pics/113.jpg'
                ]),
                'title' => $faker->randomElement(['Prof.', 'Dr.', 'Mrs.', 'Miss']),
                'firstname' => $faker->firstName($faker->randomElement(['Male', 'Female'])),
                'lastname' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'othername' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'gender' => $faker->randomElement(['Male', 'Female']),
                'dob' => $faker->dateTimeBetween('1990-01-01', '2002-12-31')->format('dd/MM/yyyy'),
                'homeaddress' => $faker->address,
                'maritalstatus' => $faker->randomElement([
                    'Single',
                    'Married',
                    'Divorced',
                    'Widowed',
                ]),
                'primarycontact' => $faker->phoneNumber,
                'auxiliarycontact' => $faker->phoneNumber,
                'edubackground' => $faker->text(30),
                'about' => $faker->text(100),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'infoid' => 'instructorwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc17',
                'profilepicurl' => $faker->randomElement([
                    '/uploads/user-profile-pics/101.jpg',
                    '/uploads/user-profile-pics/102.jpg',
                    '/uploads/user-profile-pics/103.jpg',
                    '/uploads/user-profile-pics/104.jpg',
                    '/uploads/user-profile-pics/105.jpg',
                    '/uploads/user-profile-pics/106.jpg',
                    '/uploads/user-profile-pics/107.jpg',
                    '/uploads/user-profile-pics/108.jpg',
                    '/uploads/user-profile-pics/109.jpg',
                    '/uploads/user-profile-pics/110.jpg',
                    '/uploads/user-profile-pics/111.jpg',
                    '/uploads/user-profile-pics/113.jpg'
                ]),
                'title' => $faker->randomElement(['Prof.', 'Dr.', 'Mrs.', 'Miss']),
                'firstname' => $faker->firstName($faker->randomElement(['Male', 'Female'])),
                'lastname' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'othername' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'gender' => $faker->randomElement(['Male', 'Female']),
                'dob' => $faker->dateTimeBetween('1990-01-01', '2002-12-31')->format('dd/MM/yyyy'),
                'homeaddress' => $faker->address,
                'maritalstatus' => $faker->randomElement([
                    'Single',
                    'Married',
                    'Divorced',
                    'Widowed',
                ]),
                'primarycontact' => $faker->phoneNumber,
                'auxiliarycontact' => $faker->phoneNumber,
                'edubackground' => $faker->text(30),
                'about' => $faker->text(100),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'infoid' => 'instructorwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc18',
                'profilepicurl' => $faker->randomElement([
                    '/uploads/user-profile-pics/101.jpg',
                    '/uploads/user-profile-pics/102.jpg',
                    '/uploads/user-profile-pics/103.jpg',
                    '/uploads/user-profile-pics/104.jpg',
                    '/uploads/user-profile-pics/105.jpg',
                    '/uploads/user-profile-pics/106.jpg',
                    '/uploads/user-profile-pics/107.jpg',
                    '/uploads/user-profile-pics/108.jpg',
                    '/uploads/user-profile-pics/109.jpg',
                    '/uploads/user-profile-pics/110.jpg',
                    '/uploads/user-profile-pics/111.jpg',
                    '/uploads/user-profile-pics/113.jpg'
                ]),
                'title' => $faker->randomElement(['Prof.', 'Dr.', 'Mrs.', 'Miss']),
                'firstname' => $faker->firstName($faker->randomElement(['Male', 'Female'])),
                'lastname' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'othername' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'gender' => $faker->randomElement(['Male', 'Female']),
                'dob' => $faker->dateTimeBetween('1990-01-01', '2002-12-31')->format('dd/MM/yyyy'),
                'homeaddress' => $faker->address,
                'maritalstatus' => $faker->randomElement([
                    'Single',
                    'Married',
                    'Divorced',
                    'Widowed',
                ]),
                'primarycontact' => $faker->phoneNumber,
                'auxiliarycontact' => $faker->phoneNumber,
                'edubackground' => $faker->text(30),
                'about' => $faker->text(100),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'infoid' => 'instructorwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc19',
                'profilepicurl' => $faker->randomElement([
                    '/uploads/user-profile-pics/101.jpg',
                    '/uploads/user-profile-pics/102.jpg',
                    '/uploads/user-profile-pics/103.jpg',
                    '/uploads/user-profile-pics/104.jpg',
                    '/uploads/user-profile-pics/105.jpg',
                    '/uploads/user-profile-pics/106.jpg',
                    '/uploads/user-profile-pics/107.jpg',
                    '/uploads/user-profile-pics/108.jpg',
                    '/uploads/user-profile-pics/109.jpg',
                    '/uploads/user-profile-pics/110.jpg',
                    '/uploads/user-profile-pics/111.jpg',
                    '/uploads/user-profile-pics/113.jpg'
                ]),
                'title' => $faker->randomElement(['Prof.', 'Dr.', 'Mrs.', 'Miss']),
                'firstname' => $faker->firstName($faker->randomElement(['Male', 'Female'])),
                'lastname' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'othername' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'gender' => $faker->randomElement(['Male', 'Female']),
                'dob' => $faker->dateTimeBetween('1990-01-01', '2002-12-31')->format('dd/MM/yyyy'),
                'homeaddress' => $faker->address,
                'maritalstatus' => $faker->randomElement([
                    'Single',
                    'Married',
                    'Divorced',
                    'Widowed',
                ]),
                'primarycontact' => $faker->phoneNumber,
                'auxiliarycontact' => $faker->phoneNumber,
                'edubackground' => $faker->text(30),
                'about' => $faker->text(100),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'infoid' => 'instructorwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc20',
                'profilepicurl' => $faker->randomElement([
                    '/uploads/user-profile-pics/101.jpg',
                    '/uploads/user-profile-pics/102.jpg',
                    '/uploads/user-profile-pics/103.jpg',
                    '/uploads/user-profile-pics/104.jpg',
                    '/uploads/user-profile-pics/105.jpg',
                    '/uploads/user-profile-pics/106.jpg',
                    '/uploads/user-profile-pics/107.jpg',
                    '/uploads/user-profile-pics/108.jpg',
                    '/uploads/user-profile-pics/109.jpg',
                    '/uploads/user-profile-pics/110.jpg',
                    '/uploads/user-profile-pics/111.jpg',
                    '/uploads/user-profile-pics/113.jpg'
                ]),
                'title' => $faker->randomElement(['Prof.', 'Dr.', 'Mrs.', 'Miss']),
                'firstname' => $faker->firstName($faker->randomElement(['Male', 'Female'])),
                'lastname' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'othername' => $faker->lastName($faker->randomElement(['Male', 'Female'])),
                'gender' => $faker->randomElement(['Male', 'Female']),
                'dob' => $faker->dateTimeBetween('1990-01-01', '2002-12-31')->format('dd/MM/yyyy'),
                'homeaddress' => $faker->address,
                'maritalstatus' => $faker->randomElement([
                    'Single',
                    'Married',
                    'Divorced',
                    'Widowed',
                ]),
                'primarycontact' => $faker->phoneNumber,
                'auxiliarycontact' => $faker->phoneNumber,
                'edubackground' => $faker->text(30),
                'about' => $faker->text(100),
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        // Set instructor Roles
        $instructors = Instructor::all();
        foreach ($instructors as $instructor) {
            $user = App\User::find($instructor->infoid);
            $user->role = 'instructor';
            $user->save();
        }

        // Set Student Roles
        $students = Student::all();
        foreach ($students as $student) {
            $user = App\User::find($student->infoid);
            $user->role = 'student';
            $user->save();
        }

        DB::table('institutions')->insert([
            [
                'institutionid' => 'jYb4HB5QZAiO92fuDz7Ype7oKLn9tUNz9gO4mmA3t5wuBrwdGq5FUXy06x1FENZVSyqqqXktlksUog07',
                'name' => 'Dolly Memorial Creche and Nursery School',
                'level' => 'Pre-School',
                'address' => 'P. O. Box AN5624, Accra-North',
                'location' => "F35/7, 1st Labone street, Labone-Accra",
                'contact' => $faker->phoneNumber,
                'website' => 'https://dollymemschool.com/',
                'logourl' => '/uploads/institution-profile-pics/dollymemorialsch.jpeg',
                'date_registered' => $faker->dateTimeBetween('2019-01-01', '2020-01-01')->format('d/m/Y'),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'institutionid' => 'p2nRjYmGpSY2dyXSh790uhlFDQeXUNEXB4ZuZbDvc46jshsW7MZBgpwhxBpSYdjXWUPgF0PvHTYdwa8L',
                'name' => 'Jack and Jill School',
                'level' => 'Pre-School',
                'address' => 'P.O. Box 9347, Airport-Accra, Ghana.',
                'location' => "Borstal Avenue, Roman Ridge, Accra- Ghana",
                'contact' => $faker->phoneNumber,
                'website' => 'http://www.jnjschool.org/',
                'logourl' => '/uploads/institution-profile-pics/jackandjill.jpg',
                'date_registered' => $faker->dateTimeBetween('2019-01-01', '2020-01-01')->format('d/m/Y'),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'institutionid' => 'q9lV6UVBaA0hootFzMADuq6o8Bq1Fw2jpBimgwL0mA7al0XI6RWTjoT4aw8geSX7c1k0MYmc70mxgHaq',
                'name' => 'Rosharon Montessori School',
                'level' => 'Primary School',
                'address' => 'P. O. Box CO 2886, Tema',
                'location' => "Tema, C11, Behind State Fishing Flats",
                'contact' => $faker->phoneNumber,
                'website' => 'https://rosharonmontessori.edu.gh/',
                'logourl' => '/uploads/institution-profile-pics/rosharon.jpg',
                'date_registered' => $faker->dateTimeBetween('2019-01-01', '2020-01-01')->format('d/m/Y'),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'institutionid' => 'IWU8oHMGfNjrLoTVUJj4wcrvWROtfFHQCM1Rq8cgxTfjNxIHwEaQWbixCzudFVKFkTBKd3UoIVNpHzKu',
                'name' => 'Galaxy International School',
                'level' => 'Primary School',
                'address' => '',
                'location' => "Boundary Rd, Accra, Gana",
                'contact' => $faker->phoneNumber,
                'website' => 'https://www.galaxy.edu.gh/',
                'logourl' => '/uploads/institution-profile-pics/galaxy.jpg',
                'date_registered' => $faker->dateTimeBetween('2019-01-01', '2020-01-01')->format('d/m/Y'),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'institutionid' => 'RXhGTFHBBllRCEfGRVeuloVR2qWRA1Ds8gybHBatwOfhrEERG1NY8YDA7hrpABfnk5eY5SMnsltRgD7C',
                'name' => 'Morning Star School',
                'level' => 'JHS',
                'address' => 'P.O.Box CT.737 Cantonments, Accra Ghana',
                'location' => "Cantonments Rd, Accra",
                'contact' => $faker->phoneNumber,
                'website' => 'https://www.mostarschool.edu.gh/',
                'logourl' => '/uploads/institution-profile-pics/morningstar.jpg',
                'date_registered' => $faker->dateTimeBetween('2019-01-01', '2020-01-01')->format('d/m/Y'),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'institutionid' => '1GQ8tRidJApPRo0LfAlnd9it1Ucip7JzlTGdtHD9x8PITO7CuK6xk6AaTENvCKNxSpka664YJlhdOSH6',
                'name' => 'Association International School',
                'level' => 'JHS',
                'address' => '',
                'location' => "6 Patrice Lumumba Road, Airport, Residential Area",
                'contact' => $faker->phoneNumber,
                'website' => 'https://associationinternationalschool.org/',
                'logourl' => '/uploads/institution-profile-pics/associationintsch.png',
                'date_registered' => $faker->dateTimeBetween('2019-01-01', '2020-01-01')->format('d/m/Y'),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'institutionid' => 'rF4S5ICuLUKLu9eqRuAFGhxO7H9AQmAD1ZH3D20HThZmZTlsefDP1r76UX8we3P27P6QRotuNp5Wz4OP',
                'name' => 'PRESEC - Legon',
                'level' => 'SHS',
                'address' => 'P.O. Box LG 98, Legon.',
                'location' => "Legon, Mile 9",
                'contact' => $faker->phoneNumber,
                'website' => 'https://preseclegon.edu.gh/',
                'logourl' => '/uploads/institution-profile-pics/PRESEC.jpg',
                'date_registered' => $faker->dateTimeBetween('2019-01-01', '2020-01-01')->format('d/m/Y'),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'institutionid' => '6JT86kVRGyaT0BwJ53wY810rT1KhDRMDhW9BKCqacw21nUFUj0iUeRPMuclNKjXTnq8uTYLu4wDnyGgX',
                'name' => 'OWASS',
                'level' => 'SHS',
                'address' => 'P. O. Box 849. Kumasi · Ghana',
                'location' => "79 Mankessim - Kumasi Rd, Kumasi",
                'contact' => $faker->phoneNumber,
                'website' => 'http://www.akatakyieusa.org/owass.html',
                'logourl' => '/uploads/institution-profile-pics/OWASS.jpg',
                'date_registered' => $faker->dateTimeBetween('2019-01-01', '2020-01-01')->format('d/m/Y'),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'institutionid' => 'HI6ZC1O3DRnRo8P0YiGRYILfNJZrTdLtaAqoy7Wc8LCTBA2e4mILg1iYnWtxUGJwAjx5NKGHJktCvtHr',
                'name' => 'Kwame Nkrumah University of Science and Technology (KNUST)',
                'level' => 'University',
                'address' => 'PMB KNUST, Kumasi',
                'location' => "Accra Rd, Kumasi",
                'contact' => $faker->phoneNumber,
                'website' => 'https://www.knust.edu.gh/',
                'logourl' => '/uploads/institution-profile-pics/KNUST.jpg',
                'date_registered' => $faker->dateTimeBetween('2019-01-01', '2020-01-01')->format('d/m/Y'),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'institutionid' => 'B9knC8ffU0wtRqDuVLwFCc15BEym8p1syVRa9GdR1mo0OhAnnmVDfoUFqzPYNmQb9jmpFNXFH30yURlE',
                'name' => 'University of Ghana (UG)',
                'level' => 'University',
                'address' => 'P.O Box LG 1181, Legon, Accra, Ghana',
                'location' => "Legon Boundary, Accra",
                'contact' => $faker->phoneNumber,
                'website' => 'https://www.ug.edu.gh/',
                'logourl' => '/uploads/institution-profile-pics/UG.jpg',
                'date_registered' => $faker->dateTimeBetween('2019-01-01', '2020-01-01')->format('d/m/Y'),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'institutionid' => 'rkHpat6rtYichDnK6B8SzH7oks3394gAHPwf4GXEOJYPuwND1WrAyYq7Ago7ohz2a7vSaS8gQI4Scmxy',
                'name' => 'University of Cape Coast (UCC)',
                'level' => 'University',
                'address' => 'PMB Cape Coast',
                'location' => " ‎Cape Coast, Central Region, Ghana",
                'contact' => $faker->phoneNumber,
                'website' => 'https://ucc.edu.gh/',
                'logourl' => '/uploads/institution-profile-pics/UCC.jpg',
                'date_registered' => $faker->dateTimeBetween('2019-01-01', '2020-01-01')->format('d/m/Y'),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'institutionid' => 'A2PeouRKRxyzAD8U226gqIKoBg7WElfMvECdW3KtjISnx4aq2OOFrmSiBv193xXZ6V7t4TMexcX4tdMl',
                'name' => 'University of Education (UEW)',
                'level' => 'University',
                'address' => 'Postal Address P. O. Box 25, Winneba, Ghana.',
                'location' => "Winneba, Ghana.",
                'contact' => $faker->phoneNumber,
                'website' => 'https://www.uew.edu.gh/',
                'logourl' => '/uploads/institution-profile-pics/UEW.jpg',
                'date_registered' => $faker->dateTimeBetween('2019-01-01', '2020-01-01')->format('d/m/Y'),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'institutionid' => 'ovBmcwDtMQ7NOj7QyQ3dQXPEqUStGnvpLAAuLjxlJDtl6lMm8UGCG2gkptBTHHnRa5fks7HsnLpzbab7',
                'name' => 'IPMC College of Technology',
                'level' => 'Professional',
                'address' => '',
                'location' => "Accra",
                'contact' => $faker->phoneNumber,
                'website' => 'https://www.ipmcghana.com/service/it-training/',
                'logourl' => '/uploads/institution-profile-pics/IPMC.png',
                'date_registered' => $faker->dateTimeBetween('2019-01-01', '2020-01-01')->format('d/m/Y'),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'institutionid' => 'yAMKElTNDHwghbL7Iciko3yxpb6ZST5hyuy1sqpv7Vz2ydiLIwaSBtjRhwGfEfUpNhajv0fPpPQP3ZDi',
                'name' => 'NIIT Computer School',
                'level' => 'Professional',
                'address' => '',
                'location' => "Tema",
                'contact' => $faker->phoneNumber,
                'website' => 'https://www.niitghana.com/',
                'logourl' => '/uploads/institution-profile-pics/NIIT.png',
                'date_registered' => $faker->dateTimeBetween('2019-01-01', '2020-01-01')->format('d/m/Y'),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'institutionid' => 'cvcX8rggKkHBTB9RjDmP4oGfQ4pikFr5YkizZvqVNho1QUrPBdnV67bnHI6HRGbLHclBkw2ZIrVGvKKS',
                'name' => 'Riohs Originate',
                'level' => 'Vocational',
                'address' => '',
                'location' => "Behind Zooba Shop, Dzorwulu Cres, Accra",
                'contact' => $faker->phoneNumber,
                'website' => 'https://riohs.com/',
                'logourl' => '/uploads/institution-profile-pics/riohs.png',
                'date_registered' => $faker->dateTimeBetween('2019-01-01', '2020-01-01')->format('d/m/Y'),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'institutionid' => 'UWLkmX2Sq5COT07PHwGjtiOpEmJDeuODfjBH8SHufJGOM3TyRE3oyGGzSWH9aREVo12u2d3uIaHlcBLg',
                'name' => 'Gensheila Fashion Academy',
                'level' => 'Vocational',
                'address' => '',
                'location' => "Zone 10, New Rd, Madina",
                'contact' => $faker->phoneNumber,
                'website' => 'http://www.gensheilafashionacademy.com/',
                'logourl' => '/uploads/institution-profile-pics/GSA.jpg',
                'date_registered' => $faker->dateTimeBetween('2019-01-01', '2020-01-01')->format('d/m/Y'),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
        DB::table('courses')->insert([
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'Pre-School >> Mathematics >> Nursery',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'Pre-School >> Mathematics >> kindergarten 1',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'Pre-School >> Mathematics >> kindergarten 2',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'Pre-School >> English >> Nursery',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'Pre-School >> English >> kindergarten 1',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'Pre-School >> English >> kindergarten 2',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'Pre-School >> Science >> Nursery',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'Pre-School >> Science >> kindergarten 1',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'Pre-School >> Science >> kindergarten 2',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'Primary School >> Mathematics >> Primary 1',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'Primary School >> Mathematics >> Primary 2',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'Primary School >> Mathematics >> Primary 3',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'Primary School >> English >> Primary 1',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'Primary School >> English >> Primary 2',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'Primary School >> English >> Primary 3',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'Primary School >> Integrated Science >> Primary 1',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'Primary School >> Integrated Science >> Primary 2',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'Primary School >> Integrated Science >> Primary 3',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'JHS >> English >> JHS 1',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'JHS >> English >> JHS 2',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'JHS >> English >> JHS 3',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'JHS >> Mathematics >> JHS 1',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'JHS >> Mathematics >> JHS 2',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'JHS >> Mathematics >> JHS 3',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'SHS >> Core Mathematics >> SHS 1',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'SHS >> Core Mathematics >> SHS 2',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'SHS >> Core Mathematics >> SHS 3',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'SHS >> English >> SHS 1',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'SHS >> English >> SHS 2',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'SHS >> English >> SHS 3',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'SHS >> Integrated Science >> SHS 1',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'SHS >> Integrated Science >> SHS 2',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'SHS >> Integrated Science >> SHS 3',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'SHS >> Elective Mathematics >> SHS 1',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'SHS >> Elective Mathematics >> SHS 2',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'SHS >> Elective Mathematics >> SHS 3',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'SHS >> Physics >> SHS 1',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'SHS >> Physics >> SHS 2',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'SHS >> Physics >> SHS 3',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'SHS >> Chemistry >> SHS 1',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'SHS >> Chemistry >> SHS 2',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'SHS >> Chemistry >> SHS 3',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'SHS >> Biology >> SHS 1',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'SHS >> Biology >> SHS 2',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'SHS >> Biology >> SHS 3',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'SHS >> Economics >> SHS 1',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'SHS >> Economics >> SHS 2',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'SHS >> Economics >> SHS 3',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'SHS >> Financial Accounting >> SHS 2',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'SHS >> Financial Accounting >> SHS 3',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'SHS >> Cost Accounting >> SHS 1',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'SHS >> Cost Accounting >> SHS 2',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'SHS >> Cost Accounting >> SHS 3',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'SHS >> Government >> SHS 1',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'SHS >> Government >> SHS 2',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'SHS >> Government >> SHS 3',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'SHS >> Literature In English >> SHS 1',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'SHS >> Literature In English >> SHS 2',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'SHS >> Literature In English >> SHS 3',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'Professional >> Computer Hardware and Networking >> Part 1',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'Professional >> Computer Hardware and Networking >> Part 2',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'Professional >> Computer Hardware and Networking >> Part 3',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'Professional >> Software Engineering >> Part 1',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'Professional >> Software Engineering >> Part 2',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'Professional >> Software Engineering >> Part 3',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'Vocational >> Garment Making >> Part 1',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'Vocational >> Garment Making >> Part 2',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'Vocational >> Garment Making >> Part 3',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'Vocational >> Sewing >> Part 1',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'Vocational >> Sewing >> Part 2',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'Vocational >> Sewing >> Part 3',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'Vocational >> Leather >> Part 1',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'Vocational >> Leather >> Part 2',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'courseid' => Str::uuid(),
                'imageurl' => $faker->randomElement([
                    '/uploads/course-profile-pics/biology.jpg',
                    '/uploads/course-profile-pics/chemistry.jpg',
                    '/uploads/course-profile-pics/geography.jpg',
                    '/uploads/course-profile-pics/maths.jpg',
                    '/uploads/course-profile-pics/mechanics.jpg',
                    '/uploads/course-profile-pics/physics.jpg',
                ]),
                'coursecode' => Str::random(4),
                'coursepath' => 'Vocational >> Leather >> Part 3',
                'description' => $faker->text(20),
                'about' => $faker->text(100),
                'active' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);


        // Populate InstructorCourses
        $instructors = Instructor::all();
        $courses = Course::all();
        foreach ($courses as $course) {
            $random_instructorids = $instructors->random(3)->pluck('infoid')->toArray();
            foreach ($random_instructorids as $random_instructorid) {
                $course->instructors()->attach($random_instructorid, ['instructorcourseid' => Str::uuid()]);
            }
        }

        $instructor_courses = InstructorCourse::all();

        // Populate RecommendedDocs
        foreach ($instructor_courses as $instructor_course) {
            $size = rand(1, 3);
            for ($x = 0; $x <= $size; $x++) {
                DB::table('recommended_docs')->insert([
                    [
                        'recommendeddocid' => Str::uuid(),
                        'title' => $faker->title,
                        'url' => $faker->randomElement([
                            '/uploads/recommended-docs/L1.pdf',
                            '/uploads/recommended-docs/L2.pdf',
                            '/uploads/recommended-docs/L3.pdf',
                            '/uploads/recommended-docs/L4.pdf',
                            '/uploads/recommended-docs/L5.pdf',
                            '/uploads/recommended-docs/L6.pdf',
                            '/uploads/recommended-docs/L7.pdf',
                            '/uploads/recommended-docs/L8.pdf',
                            '/uploads/recommended-docs/L9.pdf',
                            '/uploads/recommended-docs/L10.pdf',
                            '/uploads/recommended-docs/L12.pdf',
                            '/uploads/recommended-docs/L13.pdf',
                            '/uploads/recommended-docs/L14.pdf'
                        ]),
                        'instructorcourseid' => $instructor_course->instructorcourseid,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]
                ]);
            }
        }

        // Populate Audio
        foreach ($instructor_courses as $instructor_course) {
            $size = rand(1, 3);
            for ($x = 0; $x <= $size; $x++) {
                DB::table('audio')->insert([
                    [
                        'audioid' => Str::uuid(),
                        'title' => $faker->title,
                        'url' => $faker->randomElement([
                            '/uploads/audio/001.mp4',
                            '/uploads/audio/002.mp4',
                            '/uploads/audio/003.mp4',
                            '/uploads/audio/004.mp4',
                            '/uploads/audio/005.mp4',
                            '/uploads/audio/006.mp4',
                            '/uploads/audio/007.mp4',
                            '/uploads/audio/008.mp4',
                            '/uploads/audio/009.mp4',
                            '/uploads/audio/010.mp4',
                            '/uploads/audio/011.mp4',
                            '/uploads/audio/012.mp4',
                            '/uploads/audio/013.mp4',
                            '/uploads/audio/014.mp4',
                            '/uploads/audio/015.mp4',
                            '/uploads/audio/016.mp4',
                            '/uploads/audio/017.mp4',
                            '/uploads/audio/018.mp4',
                            '/uploads/audio/019.mp4',
                            '/uploads/audio/020.mp4'
                        ]),
                        'instructorcourseid' => $instructor_course->instructorcourseid,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]
                ]);
            }
        }

        // Populate Assignments
        foreach ($instructor_courses as $instructor_course) {
            $size = rand(1, 3);
            for ($x = 0; $x <= $size; $x++) {
                DB::table('assignments')->insert([
                    [
                        'assignmentid' => Str::uuid(),
                        'title' => $faker->sentence(7),
                        'url' => $faker->randomElement([
                            '/uploads/assignments/L1.pdf',
                            '/uploads/assignments/L2.pdf',
                            '/uploads/assignments/L3.pdf',
                            '/uploads/assignments/L4.pdf',
                            '/uploads/assignments/L5.pdf',
                            '/uploads/assignments/L6.pdf',
                            '/uploads/assignments/L7.pdf',
                            '/uploads/assignments/L8.pdf',
                            '/uploads/assignments/L9.pdf',
                            '/uploads/assignments/L10.pdf',
                            '/uploads/assignments/L12.pdf',
                            '/uploads/assignments/L13.pdf',
                            '/uploads/assignments/L14.pdf'
                        ]),
                        'instructorcourseid' => $instructor_course->instructorcourseid,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]
                ]);
            }
        }

        factory(Payment::class, 20)->create();

        /*$institutions = Institution::all();
        foreach ($instructors as $instructor) {
            $random_institutionids = $institutions->random(3)->pluck('institutionid')->toArray();
            foreach ($random_institutionids as $random_institutionid) {
                $instructor->institutions()->attach($random_institutionid, ['instructorinstitutionid' => Str::uuid()]);
            }
        }*/

        // Populate Enrolments
        $student = Student::find('studentLNTwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ1');
        $random_instructor_courses = $instructor_courses->random(20);
        foreach ($random_instructor_courses as $random_instructor_course) {
            $student->instructorCourses()->attach($random_instructor_course->instructorcourseid, [
                'enrolmentid' => Str::uuid(),
                'enrolled' => rand(0, 1) == 1,
                'percentagecompleted' => rand(0, 100)
            ]);
        }

        DB::table('periods')->insert([
            [
                'starttime' => new Carbon('09:00:00'),
                'endtime' => new Carbon('09:40:00'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'starttime' => new Carbon('10:00:00'),
                'endtime' => new Carbon('10:40:00'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'starttime' => new Carbon('11:00:00'),
                'endtime' => new Carbon('11:40:00'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'starttime' => new Carbon('12:00:00'),
                'endtime' => new Carbon('12:40:00'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'starttime' => new Carbon('13:00:00'),
                'endtime' => new Carbon('13:40:00'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'starttime' => new Carbon('14:00:00'),
                'endtime' => new Carbon('14:40:00'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'starttime' => new Carbon('15:00:00'),
                'endtime' => new Carbon('15:40:00'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'starttime' => new Carbon('16:00:00'),
                'endtime' => new Carbon('16:40:00'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'starttime' => new Carbon('17:00:00'),
                'endtime' => new Carbon('17:40:00'),
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);


        foreach ($instructor_courses as $instructor_course) {
            $random_periodids = Period::all()->random(rand(1, 3))->pluck('id')->toArray();

            foreach ($random_periodids as $random_periodid) {
                DB::table('timetables')->insert
                ([
                    [
                        'timetableid' => Str::uuid(),
                        'dow' => $faker->dayOfWeek(),
                        'period_id' => $random_periodid,
                        'instructorcourseid' => $instructor_course->instructorcourseid
                    ]
                ]);
            }
        }
    }
}
