<?php

namespace App\Observers;

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
        $project->recordActivity('created');
    }

    /**
     * Handle the project "updated" event.
     *
     * @param Project $project
     */
    public function updated(Project $project): void
    {
        $project->recordActivity('updated');
    }
}
