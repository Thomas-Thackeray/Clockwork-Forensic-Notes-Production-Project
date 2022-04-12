<?php

namespace Database\Factories;

use App\Models\company;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class fornsic_casesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'case_name' => $this->faker->words(1,1),
            'case_description' => $this->faker->words(10,20),
            'completed' => $this->faker->boolean(),
            'priority' => $this->faker->boolean(),
            'company_id' => company::all()->random()->id,
            'created_by' => User::all()->random()->id,
            'case_hash' => $this->faker->asciify('**************************************************'),
        ];
    }
}
