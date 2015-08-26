<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Reader</title>
</head>
<body>
	<ul>
		@foreach($items as $item)
			<li>
				<h1>{{ $item->title }}</h1>
				<p>{{ $item->description }}</p>
			</li>
		@endforeach

		{!! $items->render() !!}
	</ul>
</body>
</html>