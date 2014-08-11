<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
	    <ul>
        @foreach($notifications as $job)
            <li>{{ $job->url }}</li>
        @endforeach
        </ul>
	</body>
</html>
