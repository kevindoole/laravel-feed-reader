<!DOCTYPE html>
<html lang="en">
<head>
	<link href='//fonts.googleapis.com/css?family=Lusitana:700' rel='stylesheet' type='text/css'>
	<meta charset="UTF-8">
	<title>Reader</title>
	<link rel="stylesheet" href="/css/app.css">
</head>
<body>
	<div class="wrapper">
		<ul>
			@foreach($items as $item)
				<li>
					<a class="item-link" href="{{ $item->link }}">
						<article class="item">

							<p>
								{{ $item->pub_date->diffForHumans() }} |
								<span class="source">{{ $item->source() }}</span>
							</p>

							<h1>
								{{ $item->title }}
							</h1>

							@if( ! empty($item->categories) )
							<p class="type">
								<i>Categories:</i> {{ $item->categories }}
							</p>
							@endif

						</article>
					</a>
				</li>
			@endforeach
		</ul>
		{!! $items->render() !!}
	</div>
</body>
</html>