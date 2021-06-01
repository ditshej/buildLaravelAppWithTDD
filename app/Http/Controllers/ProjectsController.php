<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class ProjectsController extends Controller
{
    public function index(): Factory|View|Application
    {
        $projects = auth()->user()->projects;

        return view('projects.index', compact('projects'));
    }

    public function show(Project $project): Factory|View|Application
    {
        $this->authorize('update', $project);

        return view('projects.show', compact('project'));
    }

    public function create(): Factory|View|Application
    {
        return view('projects.create');
    }

    public function store(): Redirector|Application|RedirectResponse
    {
        $attributes = request()->validate([
            'title' => 'required',
            'description' => 'required|max:300',
            'notes' => 'min:3'
        ]);

        $project =auth()->user()->projects()->create($attributes);

        return redirect($project->path());
    }

    public function update(Project $project): Redirector|Application|RedirectResponse
    {
        $this->authorize('update', $project);

        $project->update(request(['notes']));

        return redirect($project->path());
    }
}
