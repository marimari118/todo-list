<!DOCTYPE html>
<html lang="ja">
<head>
    @include('task.includes.head', ['title' => 'ToDo List - Edit'])
</head>
<body>
    @include('task.includes.header')

    <main>
        @include('task.includes.form', ['target' => '/update'])
    </main>

    @include('task.includes.footer')
</body>
</html>