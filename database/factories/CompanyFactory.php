<?php

/** @var Factory $factory */

use App\Company;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Company::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'email' => $faker->companyEmail,
        'img_path' => $faker->image(storage_path('app/public/companies_logo'), 250, 250, 'food', false),
        'website' => $faker->url,
    ];
});
