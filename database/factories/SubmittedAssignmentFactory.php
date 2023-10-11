<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\SubmittedAssignment;
use Faker\Generator as Faker;

$factory->define(SubmittedAssignment::class, function (Faker $faker) {
    $submittedassignmentid = $faker->unique()->randomElement([
        'submittedassignmentV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ1',
        'submittedassignmentV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ2',
        'submittedassignmentV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ3',
        'submittedassignmentV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ4',
        'submittedassignmentV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ5',
        'submittedassignmentV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ6',
        'submittedassignmentV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ7',
        'submittedassignmentV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ8',
        'submittedassignmentV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ9',
        'submittedassignmentV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc10',
        'submittedassignmentV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc11',
        'submittedassignmentV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc12',
        'submittedassignmentV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc13',
        'submittedassignmentV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc14',
        'submittedassignmentV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc15',
        'submittedassignmentV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc16',
        'submittedassignmentV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc17',
        'submittedassignmentV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc18',
        'submittedassignmentV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc19',
        'submittedassignmentV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc20'
    ]);
    $url = $faker->randomElement([
        '/uploads/submitted-assignments/L1.pdf',
        '/uploads/submitted-assignments/L2.pdf',
        '/uploads/submitted-assignments/L3.pdf',
        '/uploads/submitted-assignments/L4.pdf',
        '/uploads/submitted-assignments/L5.pdf',
        '/uploads/submitted-assignments/L6.pdf',
        '/uploads/submitted-assignments/L7.pdf',
        '/uploads/submitted-assignments/L8.pdf',
        '/uploads/submitted-assignments/L9.pdf',
        '/uploads/submitted-assignments/L10.pdf',
        '/uploads/submitted-assignments/L12.pdf',
        '/uploads/submitted-assignments/L13.pdf',
        '/uploads/submitted-assignments/L14.pdf'
    ]);
    $assignmentid = $faker->randomElement([
        'assignmentwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ1',
        'assignmentwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ2',
        'assignmentwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ3',
        'assignmentwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ4',
        'assignmentwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ5',
        'assignmentwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ6',
        'assignmentwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ7',
        'assignmentwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ8',
        'assignmentwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ9',
        'assignmentwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc10',
        'assignmentwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc11',
        'assignmentwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc12',
        'assignmentwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc13',
        'assignmentwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc14',
        'assignmentwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc15',
        'assignmentwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc16',
        'assignmentwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc17',
        'assignmentwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc18',
        'assignmentwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc19',
        'assignmentwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc20'
    ]);
    $studentid = $faker->randomElement([
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

    return [
        'submittedassignmentid' => $submittedassignmentid,
        'title' => $faker->sentence(7),
        'url' => $url,
        'percentagescore' => rand(0, 100),
        'assignmentid' => $assignmentid,
        'studentid' => $studentid,
    ];
});
