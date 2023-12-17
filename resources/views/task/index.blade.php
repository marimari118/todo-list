<!DOCTYPE html>
<html lang="ja">
<head>
    @include('task.includes.head', ['title' => 'ToDo List'])
</head>
<body>
    @include('task.includes.header')
    
    <main>
        <form name="search" class="input-group p-2" action="/">
            @csrf
            <input type="text" class="form-control rounded-start" name="search" value="{{ $search }}" placeholder="キーワードを入力">
            <button type="button" class="btn btn-outline-success" onclick="document.search.submit();">
                <span class="bi-search"></span>
            </button>
        </form>

        @if(isset($search) && $search != '')
            <div class="p-2">「{{ $search }}」の検索結果: {{ $count }}件</div>
        @else
            <div class="p-2">すべてのタスク: {{ $count }}件</div>
        @endif
        
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <a class="page-link" href="/?search={{ $search }}&page=1" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                @php
                    $pagenation_max = min($page + 2, $max_page);
                @endphp

                @for($i = max($page - 2, 1); $i <= $pagenation_max; $i++)
                    <li class="page-item"><a class="page-link" href="/?search={{ $search }}&page={{ $i }}">{{ $i }}</a></li>
                @endfor
                
                <li class="page-item">
                    <a class="page-link" href="/?search={{ $search }}&page={{ $max_page }}" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
        
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
                            <div class="d-flex gap-1">
                                <form action="/edit">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $task->id }}">
                                    <input class="btn p-0 px-1 bg-secondary text-white" type="submit" value="Edit">
                                </form>

                                <form action="/delete" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $task->id }}">
                                    <input class="btn p-0 px-1 bg-danger text-white" type="submit" value="Delete">
                                </form>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>{!! $task->content !!}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        @include('task.includes.form', ['target' => '/create'])
    </main>

    @include('task.includes.footer')
</body>
</html>