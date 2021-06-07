<?php

namespace Tests\Setup;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;

class ProjectFactory
{
    protected int $taskCount = 0;
    protected User $user;

    public function withTasks(int $count)
    {
        $this->taskCount = $count;

        return $this;
    }

    public function ownedBy(User $user)
    {
        $this->user = $user;

        return $this;
    }

    public function create()
    {
        \Facades\Tests\Setup\ProjectFactory::clearResolvedInstance('ProjectFactory');

        $project = Project::factory()->create([
            'owner_id' => $this->user ?? User::factory()
        ]);

        Task::factory($this->taskCount)->create([
            'project_id' => $project->id
        ]);

        return $project;
    }
}
