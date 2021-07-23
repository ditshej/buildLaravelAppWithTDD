<?php

namespace App\Observers;

use App\Models\Activity;
use App\Models\Project;

class ProjectObserver
{
    /**
     * Handle the project "created" event.
     *
     * @param Project $project
     */
    public function created(Project $project): void
    {
        $this->recordActivity('created', $project);
    }

    protected function recordActivity(string $type, Project $project): void
    {
        Activity::create([
            'project_id' => $project->id,
            'description' => $type
        ]);
    }

    /**
     * Handle the project "updated" event.
     *
     * @param Project $project
     */
    public function updated(Project $project): void
    {
        $this->recordActivity('updated', $project);
    }

    /**
     * Handle the project "deleted" event.
     *
     * @param Project $project
     */
    public function deleted(Project $project)
    {
        //
    }

    /**
     * Handle the project "restored" event.
     *
     * @param Project $project
     */
    public function restored(Project $project)
    {
        //
    }

    /**
     * Handle the project "force deleted" event.
     *
     * @param Project $project
     */
    public function forceDeleted(Project $project)
    {
        //
    }
}
