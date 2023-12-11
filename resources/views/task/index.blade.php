<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <title>Todo List</title>
</head>
<body>
    <header class="p-2">
        <h1 class="h2 ms-2">Todo List</h1>
    </header>

    <main>
        <table class="table table-striped table-bordered mb-2">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">タスク</th>
                </tr>
            </thead>
            
            <tbody>
                @foreach($tasks as $task)
                    <tr>
                        <th class="bg-white" scope="row" rowspan="2">{{ $task->id }}</th>
                        <td class="d-flex justify-content-between">
                            <span>{{ $task->title }}</span>
                            <form action="/delete" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $task->id }}">
                                <input class="btn p-1 px-2 bg-danger text-white" type="submit" value="Delete">
                            </form>
                        </td>
                    </tr>

                    <tr>
                        <td>{{ $task->content }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>

    <form class="p-2" action="/create" method="POST">
        @csrf
        <div class="mb-3">
            <div class="mb-2">
                <label class="form-label" for="title">Title</label>
                <input id="title" class="form-control" type="text" name="title">
            </div>
            <div class="mb-2">
                <label class="form-label" for="content">Content</label>
                <textarea id="content" class="form-control" name="content" rows="8"></textarea>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</body>
</html>