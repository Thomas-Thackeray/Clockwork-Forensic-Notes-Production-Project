<?php

namespace Database\Factories;

use App\Models\fornsic_cases;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class fornsic_notesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->words(3,6),

            'bookmark' => $this->faker->boolean(),
            'important' => $this->faker->boolean(),
            'locked' => $this->faker->boolean(),

            'note_type' => 'Investigator',
            'md5_hash' => $this->faker->asciify('**************************************************'),
            'sha1_hash' => $this->faker->asciify('**************************************************'),

            'description' => $this->faker->sentence(10),
            'evidence_damage' => $this->faker->sentence(10),
            'further_details' => $this->faker->sentence(10),

            'created_by_id' => User::all()->random()->id,
            'case_assigned' => fornsic_cases::all()->random()->id,
        ];
    }
}
