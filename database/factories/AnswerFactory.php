<?php

namespace Database\Factories;

use App\Models\Question;
use App\Models\User;
use App\Models\Survey;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Answer>
 */
class AnswerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "user_id" => User::inRandomOrder()->first()->id,
            "question_id" => Question::inRandomOrder()->first()->id,
            "survey_id" => Survey::inRandomOrder()->first()->id,
            "answer" => join(" ",$this->faker->sentences(2))
        ];
    }
}
