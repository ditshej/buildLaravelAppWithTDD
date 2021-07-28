<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class ProjectTasksController extends Controller
{

    public function store(Project $project): Redirector|Application|RedirectResponse
    {
        $this->authorize('update', $project);

        request()->validate(['body' => 'required']);

        $project->addTask(request('body'));

        return redirect($project->path());
    }

    public function update(Project $project, Task $task): Redirector|Application|RedirectResponse
    {
        $this->authorize('update', $task->project);

        $task->update(request()?->validate(['body' => 'required']));

        $method = request('completed') ? 'complete' : 'incomplete';
        $task->$method();

        return redirect($project->path());
    }

}
