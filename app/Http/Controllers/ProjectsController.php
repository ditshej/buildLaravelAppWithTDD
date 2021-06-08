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
        $project =auth()->user()->projects()->create($this->validateRequest());

        return redirect($project->path());
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function update(Project $project): Redirector|Application|RedirectResponse
    {
        $this->authorize('update', $project);

        $project->update($this->validateRequest());

        return redirect($project->path());
    }

    /**
     * @return array
     */
    private function validateRequest(): array
    {
        return request()->validate([
            'title' => 'required',
            'description' => 'required|max:300',
            'notes' => 'min:3'
        ]);
    }
}
