<?php

namespace Database\Factories;

use App\Models\Disease;
use Illuminate\Database\Eloquent\Factories\Factory;

class DiseaseFactory extends Factory
{
    protected $model = Disease::class;


    public function definition()
    {
        return [
            'disease_type' => $this->faker->randomElement(Disease::getTypes()),
            'additional_symptoms' => $this->faker->text(25),
            'attended_in_hospital' => $this->faker->boolean,
            'fever' => $this->faker->boolean,
            'skin_rashes' => $this->faker->boolean,
            'cough' => $this->faker->boolean,
            'muscle_ache' => $this->faker->boolean,
            'headache' => $this->faker->boolean,
            'vomiting' => $this->faker->boolean,
        ];
    }
}
