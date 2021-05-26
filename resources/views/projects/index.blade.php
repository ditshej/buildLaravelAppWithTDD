@extends('layouts.app')

@section('content')
    <header class="flex items-center mb-3 py-4">
        <div class="flex justify-between items-end w-full">
            <h2 class="text-gray-400 text-sm font-normal">My Projects</h2>
            <a href="/projects/create" class="button-blue">New Project</a>
        </div>
    </header>

    <main class="flex flex-wrap -mx-3">
        @forelse($projects as $project)
            <div class="w-full lg:w-1/3 px-3 pb-6">
                @include('projects.card')
            </div>
        @empty
            <li>No projects yet.🏄‍</li>
        @endforelse
    </main>

@endsection
