<!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create a Project</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.css"/>
</head>
<body>

<form method="POST" action="/projects" class="container" style="padding-top: 40px;">
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
        </div>
    </div>
</form>
</body>
</html>
