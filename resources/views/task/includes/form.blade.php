<form class="p-2" action="{{ $target }}" method="POST">
    @csrf

    @if(isset($task->id))
        <input type="hidden" name="id" value="{{ $task->id }}">
    @endif
    
    <div class="mb-3">
        <div class="mb-2">
            <label class="form-label" for="title">Title</label>
            
            @if($errors->has('title'))
                @error('title')
                    <li class="text-danger">{{ $message }}</li>
                @enderror
                <input id="title" class="form-control" type="text" name="title" value="{{ old('title') }}">
            @elseif(isset($task))
                <input id="title" class="form-control" type="text" name="title" value="{{ $task->title }}">
            @else
                <input id="title" class="form-control" type="text" name="title">
            @endif
        </div>

        <div class="mb-2">
            <label class="form-label" for="content">Content</label>
            
            @if($errors->has('content'))
                @error('content')
                    <li class="text-danger">{{ $message }}</li>
                @enderror
                <textarea id="content" class="form-control" name="content" rows="8">{{ old('content') }}</textarea>
            @elseif(isset($task))
                <textarea id="content" class="form-control" name="content" rows="8">{{ $task->content }}</textarea>
            @else
                <textarea id="content" class="form-control" name="content" rows="8"></textarea>
            @endif
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>