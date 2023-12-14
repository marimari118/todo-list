<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <title>Todo List</title>
</head>
<body>
    <header class="p-2 bg-dark">
        <h1 class="h2 m-0 ms-2 text-white"><a class="text-decoration-none text-white" href="/">Todo List</a></h1>
    </header>

    <main>
        <form class="p-2" action="/update" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{ $task->id }}">
            <div class="mb-3">
                <div class="mb-2">
                    <label class="form-label" for="title">Title</label>
                    <input id="title" class="form-control" type="text" name="title" value="{{ $task->title }}">
                </div>
                <div class="mb-2">
                    <label class="form-label" for="content">Content</label>
                    <textarea id="content" class="form-control" name="content" rows="8">{{ $task->content }}</textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </main>
</body>
</html>