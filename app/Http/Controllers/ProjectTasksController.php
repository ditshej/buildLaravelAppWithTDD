<?php

namespace App\Http\Controllers;

use App\Models\Project;

class ProjectTasksController extends Controller
{

    public function store(Project $project)
    {
        $attributes = request()->validate([
            'body' => 'required',
        ]);

        $project->addTask($attributes);

        return redirect($project->path());
    }

}
