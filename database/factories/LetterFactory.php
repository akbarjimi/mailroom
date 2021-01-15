<?php

namespace Database\Factories;

use App\Models\Letter;
use App\Models\LetterType;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Uuid;

class LetterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Letter::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        if (Letter::all()->isEmpty()) {
            $lettertype = LetterType::factory()->create()->id;
        } else {
            $lettertype = rand(0,1) ? LetterType::factory()->create()->id : LetterType::inRandomOrder()->first()->id;
        }

        if (Letter::all()->isEmpty()) {
            $project = Project::factory()->create()->id;
        } else {
            $project = rand(0,1) ? Project::factory()->create()->id : Project::inRandomOrder()->first()->id;
        }


        return [
            'id' => Uuid::uuid4()->toString(),
            'lettertype_id' => $lettertype,
            'project_id' => $project,
            'row' => Letter::where('lettertype_id', $lettertype)->where('project_id', $project)->max('row') + 1,
            'user_id' => User::factory()->create()->id,
            'title' => $this->faker->words(5, true),
            'date' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
