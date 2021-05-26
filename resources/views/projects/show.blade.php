@extends('layouts.app')

@section('content')
    <header class="flex items-center mb-3 py-4">
        <div class="flex justify-between items-end w-full">
            <p class="text-gray-400 text-sm font-normal">
                <a href="/projects" class="text-gray-400 text-sm font-normal no-underline">
                    My Projects
                </a> / {{ $project->title }}
            </p>

            <a href="/projects/create" class="button-blue">New Project</a>
        </div>
    </header>

    <main>
        <div class="lg:flex -mx-3">
            <div class="lg:w-3/4 px-3 mb-6">
                <div class="mb-8">
                    <h2 class="text-lg text-gray-400 text-sm font-normal mb-3">Tasks</h2>
                    {{-- tasks --}}
                    <div class="card-white mb-3">Lorem ipsum.</div>
                    <div class="card-white mb-3">Lorem ipsum.</div>
                    <div class="card-white mb-3">Lorem ipsum.</div>
                    <div class="card-white">Lorem ipsum.</div>
                </div>
                <div>
                    <h2 class="text-lg text-gray-400 text-sm font-normal mb-3">General Notes</h2>
                    {{-- general notes --}}

                    <textarea class="card-white w-full" style="min-height: 200px;">Lorem ipsum.</textarea>
                </div>
            </div>

            <div class="lg:w-1/4 px-3">
               @include('projects.card')
            </div>
        </div>
    </main>

@endsection
