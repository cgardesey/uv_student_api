<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Notification;
use Faker\Generator as Faker;

$factory->define(Notification::class, function (Faker $faker) {
    $notificationid = $faker->unique()->randomElement([
        'notificationfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ1',
        'notificationfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ2',
        'notificationfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ3',
        'notificationfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ4',
        'notificationfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ5',
        'notificationfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ6',
        'notificationfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ7',
        'notificationfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ8',
        'notificationfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ9',
        'notificationfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc10',
        'notificationfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc11',
        'notificationfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc12',
        'notificationfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc13',
        'notificationfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc14',
        'notificationfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc15',
        'notificationfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc16',
        'notificationfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc17',
        'notificationfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc18',
        'notificationfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc19',
        'notificationfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc20'
    ]);
    $senderid = $faker->randomElement([
        'instructorwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ1',
        'instructorwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ2',
        'instructorwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ3',
        'instructorwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ4',
        'instructorwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ5',
        'instructorwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ6',
        'instructorwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ7',
        'instructorwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ8',
        'instructorwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ9',
        'instructorwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc10',
        'instructorwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc11',
        'instructorwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc12',
        'instructorwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc13',
        'instructorwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc14',
        'instructorwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc15',
        'instructorwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc16',
        'instructorwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc17',
        'instructorwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc18',
        'instructorwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc19',
        'instructorwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc20',

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
        'notificationid' => $notificationid,
        'text' => $faker->sentence(5),
        'readbyrecepient' => $faker->boolean(),
        'senderid' => $senderid
    ];
});
