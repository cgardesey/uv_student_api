<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Payment;
use Faker\Generator as Faker;

$factory->define(Payment::class, function (Faker $faker) {
    $paymentid = $faker->unique()->randomElement([
        'paymententwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ1',
        'paymententwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ2',
        'paymententwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ3',
        'paymententwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ4',
        'paymententwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ5',
        'paymententwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ6',
        'paymententwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ7',
        'paymententwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ8',
        'paymententwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ9',
        'paymententwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc10',
        'paymententwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc11',
        'paymententwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc12',
        'paymententwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc13',
        'paymententwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc14',
        'paymententwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc15',
        'paymententwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc16',
        'paymententwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc17',
        'paymententwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc18',
        'paymententwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc19',
        'paymententwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc20'
    ]);
    $responsemessage = $faker->randomElement([
        'Transaction successful',
        'Pending transaction',
        'Insufficient balance',
        'Processing transaction'
    ]);
    $paymentstatus = $faker->randomElement([
        'Transaction successful',
        'Pending transaction',
        'Insufficient balance',
        'Processing transaction'
    ]);
    $payerid = $faker->randomElement([
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
        'paymentid' => $paymentid,
        'mobileno' => $faker->phoneNumber,
        'chargeamount' =>$faker->randomFloat(2, 1, 20),
        'description' => $faker->sentence(5),
        'responsemessage' => $responsemessage,
        'paymentstatus' => $paymentstatus,
        'expirydate' => $faker->date,
        'payerid' => 'studentLNTwsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ1',
    ];
});
