<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;

class ProjectFactory extends Factory
{
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    #[ArrayShape(['title' => "string", 'description' => "string", 'owner_id' => "\Closure"])]
    public function definition(): array
    {
        return [
            'title' => $this->faker->words(3,true),
            'description' => $this->faker->paragraph(),
            'owner_id' => fn() => User::factory()->create()->id
        ];
    }
}
