<a href="{{ route('jobs.index') }}">index</a>
{{ Form::open(['url' => route('jobs.store'), 'method' => 'post']) }}
    <lable>url</lable>
    <input name="url" />
    <input type="submit" value="submit" />
{{ Form::close() }}
