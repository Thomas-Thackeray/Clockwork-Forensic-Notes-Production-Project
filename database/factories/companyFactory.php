<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\company;




class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'company_name' => $this->faker->name(),
            'contact_number' => $this->faker->regexify('09[0-9]{9}'),
            'email' => $this->faker->unique()->safeEmail(),
            'company_description' => $this->faker->sentence(100), 
            'address_line_1' => $this->faker->sentence(2), 
            'address_line_2' => $this->faker->sentence(2), 
        ];
    }
}
