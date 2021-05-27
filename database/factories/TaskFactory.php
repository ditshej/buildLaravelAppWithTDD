<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    #[ArrayShape(['body' => "string"])]
    public function definition(): array
    {
        return [
            'body' => $this->faker->sentence()
        ];
    }
}
