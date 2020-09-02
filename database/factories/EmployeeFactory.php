<?php

/** @var Factory $factory */

use App\Company;
use App\Employee;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Employee::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'company_id' => Company::all()->random()->id,
        'email' => $faker->email,
        'phone' => $faker->phoneNumber,
    ];
});
