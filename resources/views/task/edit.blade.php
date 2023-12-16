<!DOCTYPE html>
<html lang="ja">
<head>
    @include('task.head', ['title' => 'ToDo List - Edit'])
</head>
<body>
    @include('task.header')

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

    @include('task.footer')
</body>
</html>