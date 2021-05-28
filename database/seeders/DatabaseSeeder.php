<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->create(['email' => 'ghost@email.com', 'password' => Hash::make('123456')]);

        $projects = Project::factory(5)->create(['owner_id' => $user->id]);

        foreach ($projects as $project) {
            Task::factory(5)->create(['project_id' => $project->id]);
        }
    }
}
