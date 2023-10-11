<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Institution;
use Faker\Generator as Faker;

$factory->define(Institution::class, function (Faker $faker) {
    $institutionid = $faker->unique()->randomElement([
        'institutionsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ1',
        'institutionsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ2',
        'institutionsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ3',
        'institutionsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ4',
        'institutionsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ5',
        'institutionsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ6',
        'institutionsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ7',
        'institutionsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ8',
        'institutionsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKcQ9',
        'institutionsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc10',
        'institutionsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc11',
        'institutionsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc12',
        'institutionsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc13',
        'institutionsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc14',
        'institutionsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc15',
        'institutionsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc16',
        'institutionsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc17',
        'institutionsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc18',
        'institutionsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc19',
        'institutionsfJuFizRV6NRodQNHcf5rbxx4LABcsxhVlozd0NIWkysedo4Yb0YeYHSoxEglXJQeKc20'
    ]);
    $name = $faker->randomElement([
        'GHANA INSTITUTE OF MANAGEMENT AND PUBLIC ADMINISTRATION',
        'KWAME NKRUMAH UNIVERSITY OF SCIENCE AND TECHNOLOGY',
        'UNIVERSITY OF EDUCATION',
        'UNIVERSITY OF CAPE COAST',
        'UNIVERSITY FOR DEVELOPMENT STUDIES',
        'UNIVERSITY OF ENERGY AND NATURAL RESOURCES',
        'UNIVERSITY OF GHANA',
        'UNIVERSITY OF HEALTH AND ALLIED SCIENCE',
        'UNIVERSITY OF MINES AND TECHNOLOGY',
        'UNIVERSITY OF PROFESSIONAL STUDIES',
        'Presbyterian Boys Senior High School',
        'Accra Academy'
    ]);
    $level = $faker->randomElement([
        'Pre-School',
        'Primary School',
        'JHS',
        'SHS',
        'Pre-University',
        'University',
        'Professional',
        'Vocational',
    ]);
    $logourl = $faker->randomElement([
        '/img/institution_logos/gimpa.jpg',
        '/img/institution_logos/jackandjill.jpg',
        '/img/institution_logos/KNUST.jpg',
        '/img/institution_logos/labone.jpg',
        '/img/institution_logos/OWASS.jpg',
        '/img/institution_logos/PRESEC.jpg',
        '/img/institution_logos/UCC.jpg',
        '/img/institution_logos/UG.jpg'
    ]);

    $website = $faker->randomElement([
        'www.knust.edu.gh',
        'https://www.ug.edu.gh',
        'https://ucc.edu.gh',
        'https://www.uew.edu.gh',
        'www.atu.edu.gh',
        'https://kstu.edu.gh',
        'https://preseclegon.edu.gh',
        'https://amanfoonorthamerica.org'
    ]);

    return [
        'institutionid' => $institutionid,
        'name' => $name,
        'level' => $level,
        'address' => $faker->address,
        'location' => $faker->address,
        'contact' => $faker->phoneNumber,
        'website' => $website,
        'logourl' => $logourl,
        'dateregistered' => $faker->dateTimeBetween('2019-01-01', '2020-01-01')->format('d/m/Y'),
        'active' => $faker->boolean()
    ];
});
