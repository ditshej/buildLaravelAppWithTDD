@extends('layouts.app')

@section('content')
    <div class="flex items-center mb-3">
        <h1 class="mr-auto">Birdboard</h1>
        <a href="/projects/create">New Project</a>
    </div>

    <div class="flex flex-wrap">
        @forelse($projects as $project)
            <div class="bg-white mr-4 mb-4 rounded p-5 shadow w-1/3" style="height: 200px;">
                <h3 class="font-normal text-xl py-4">{{ $project->title }}</h3>

                <div class="text-gray-400">{{ Illuminate\Support\Str::limit($project->description, 100) }}</div>
            </div>
        @empty
            <li>No projects yet.🏄‍</li>
        @endforelse
    </div>

@endsection
