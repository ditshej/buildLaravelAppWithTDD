<?php

namespace Tests\Setup;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;

class ProjectTestFactory
{
    protected int $taskCount = 0;
    protected User $user;

    public function withTasks(int $count): static
    {
        $this->taskCount = $count;

        return $this;
    }

    public function ownedBy(User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function create()
    {
        \Facades\Tests\Setup\ProjectTestFactory::clearResolvedInstance('ProjectTestFactory');

        $project = Project::factory()->create([
            'owner_id' => $this->user ?? User::factory()
        ]);

        Task::factory($this->taskCount)->create([
            'project_id' => $project->id
        ]);

        return $project;
    }
}
