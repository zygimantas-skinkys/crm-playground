<?php

namespace Database\Factories;

use App\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'email' => $this->faker->companyEmail,
            'img_path' => $this->faker->image(storage_path('app/public/companies_logo'), 250, 250, 'food', false),
            'website' => $this->faker->url,
        ];
    }
}
