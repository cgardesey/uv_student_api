<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Student;
use Faker\Generator as Faker;

$factory->define(Student::class, function (Faker $faker) {
    $infoid = $faker->unique()->randomElement([
        'studentLNTwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ1',
        'studentLNTwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ2',
        'studentLNTwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ3',
        'studentLNTwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ4',
        'studentLNTwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ5',
        'studentLNTwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ6',
        'studentLNTwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ7',
        'studentLNTwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ8',
        'studentLNTwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ9',
        'studentLNTwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc10',
        'studentLNTwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc11',
        'studentLNTwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc12',
        'studentLNTwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc13',
        'studentLNTwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc14',
        'studentLNTwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc15',
        'studentLNTwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc16',
        'studentLNTwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc17',
        'studentLNTwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc18',
        'studentLNTwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc19',
        'studentLNTwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc20'
    ]);
    $picture = $faker->randomElement([
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
    ]);
    $title = $faker->randomElement(['Prof.', 'Dr.', 'Mrs.', 'Miss']);
    $gender = $faker->randomElement(['Male', 'Female']);
    $maritalstatus = $faker->randomElement([
        'Single',
        'Married',
        'Divorced',
        'Widowed',
    ]);
    $edulevel = $faker->randomElement([
        'Basic',
        'Secondary',
        'Vocational/Technical',
        'Bachelors Degree',
        'Post Graduate'

    ]);
    $institutionname = $faker->randomElement(['KNUST', 'UCC', 'UG', 'UDS', 'UEW']);

    return [
        'infoid' => $infoid,
        'picture' => $picture,
        'title' => $title,
        'firstname' => $faker->firstName($gender),
        'lastname' => $faker->lastName($gender),
        'othername' => $faker->lastName($gender),
        'gender' => $gender,
        'dob' => $faker->dateTimeBetween('1990-01-01', '2002-12-31')->format('d/m/Y'),
        'homeaddress' => $faker->address,
        'maritalstatus' => $maritalstatus,
        'primarycontact' => $faker->phoneNumber,
        'auxiliarycontact' => $faker->phoneNumber,
        'edulevel' => $edulevel,
        'institutionname' => $institutionname
    ];
});
