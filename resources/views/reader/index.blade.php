<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Reader</title>
	<link rel="stylesheet" href="/css/app.css">
	<link href='//fonts.googleapis.com/css?family=Lusitana:400,700' rel='stylesheet' type='text/css'>
	<link href='//fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
	<link href='//fonts.googleapis.com/css?family=Merriweather+Sans:400,300,300italic,400italic,700italic,700,800,800italic' rel='stylesheet' type='text/css'>
</head>
<body>
	<div class="wrapper">
		<ul>
			@foreach($items as $item)
				<li>
					<article class="item">
						<h1>{{ $item->title }}</h1>
						<div class="media">
							<img class="img thumb" src="{{ $item->media_path }}" alt="">
							<div class="bd">
								<p>{{ $item->description }}</p>
							</div>
						</div>
					</article>
				</li>
			@endforeach
		</ul>
		{!! $items->render() !!}
	</div>
</body>
</html>