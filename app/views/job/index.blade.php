<a href="{{ route('jobs.create') }}">create</a>
<table>
    <thead>
        <th>id</th>
        <th>url</th>
        <th>last_name</th>
        <th>last_count</th>
        <th>updated_at</th>
    </thead>
    @foreach($jobs as $job)
    <tr>
        <td>{{ $job->id }}</td>
        <td>{{ $job->url }}</td>
        <td>{{ $job->last_name }}</td>
        <td>{{ $job->last_count }}</td>
        <td>{{ $job->updated_at }}</td>
    </tr>
    @endforeach
</table>
