@extends('layouts.app')

@section('content')
    <form method="POST" action="/projects">
        @csrf
        <h1 class="heading is-1">Create a Project</h1>
        <div class="field">
            <label class="label" for="title">Title</label>
            <div class="control">
                <input class="input" id="title" name="title" placeholder="Title" type="text"/>
            </div>
        </div>

        <div class="field">
            <label class="label" for="description">Description</label>
            <div class="control">
                <input class="input" id="description" name="description" placeholder="Description" type="text"/>
            </div>
        </div>

        <div class="field">
            <div class="control">
                <button class="button is-link" type="submit">CreateProject</button>
                <a href="/projects">Cancel</a>
            </div>
        </div>
    </form>
@endsection
