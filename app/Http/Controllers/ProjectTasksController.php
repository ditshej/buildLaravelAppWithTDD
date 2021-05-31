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
        if (auth()->user()->isNot($project->owner)) {
            abort(403);
        }

        request()->validate(['body' => 'required']);

        $project->addTask(request('body'));

        return redirect($project->path());
    }

    public function update(Project $project, Task $task): Redirector|Application|RedirectResponse
    {
        if (auth()->user()->isNot($project->owner)) {
            abort(403);
        }

        request()->validate(['body' => 'required']);

        $task->update([
            'body' => request('body'),
            'completed' => request()->has('completed')
        ]);

        return redirect($project->path());
    }

}
