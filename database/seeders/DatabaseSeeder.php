<?php

namespace Database\Seeders;

use App\Models\Project;
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
         Project::factory(5)->create(['owner_id' => $user->id]);
    }
}
