<?php

namespace App\Observers;

use App\Models\Task;

class TaskObserver
{
    /**
     * Handle the task "created" event.
     *
     * @param Task $task
     */
    public function created(Task $task): void
    {
        $task->project->recordActivity('created_task');
    }

    /**
     * Handle the task "deleted" event.
     *
     * @param Task $task
     */
    public function deleted(Task $task): void
    {
        $task->project->recordActivity('deleted_task');
    }
}
