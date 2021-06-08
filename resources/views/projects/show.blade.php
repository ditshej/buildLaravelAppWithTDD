@extends('layouts.app')

@section('content')
    <header class="flex items-center mb-3 py-4">
        <div class="flex justify-between items-end w-full">
            <p class="text-gray-400 text-sm font-normal">
                <a href="/projects" class="text-gray-400 text-sm font-normal no-underline">
                    My Projects
                </a> / {{ $project->title }}
            </p>

            <a href="{{ $project->path().'/edit' }}" class="button-blue">Edit Project</a>
        </div>
    </header>

    <main>
        <div class="lg:flex -mx-3">
            <div class="lg:w-3/4 px-3 mb-6">
                <div class="mb-8">
                    <h2 class="text-lg text-gray-400 text-sm font-normal mb-3">Tasks</h2>

                    @foreach($project->tasks as $task)
                        <div class="card-white mb-3">
                            <form method="POST" action="{{ $task->path() }}">
                                @method('PATCH')
                                @csrf
                                <div class="flex">
                                    <input class="w-full {{ $task->completed ? 'text-gray-400' : '' }}" name="body"
                                           type="text" value="{{ $task->body }}"/>
                                    <input name="completed" type="checkbox"
                                           onchange="this.form.submit()" {{ $task->completed ? 'checked' : '' }}/>
                                </div>
                            </form>
                        </div>
                    @endforeach

                    <div class="card-white mb-3">
                        <form action="{{ $project->path() . '/tasks' }}" method="POST">
                            @csrf
                            <input type="text" placeholder="Begin adding tasks..." class="w-full" name="body"/>
                        </form>
                    </div>
                </div>

                <div>
                    <h2 class="text-lg text-gray-400 text-sm font-normal mb-3">General Notes</h2>

                    <form method="POST" action="{{ $project->path() }}">
                        @method('PATCH')
                        @csrf

                        <textarea
                            name="notes"
                            class="card-white w-full mb-4"
                            style="min-height: 200px;"
                            placeholder="Anything special that you want to make a note of?"
                        >{{ $project->notes }}</textarea>

                        <button type="submit" class="button">Save</button>
                    </form>
                </div>
            </div>

            <div class="lg:w-1/4 px-3">
                @include('projects.card')
            </div>
        </div>
    </main>

@endsection
