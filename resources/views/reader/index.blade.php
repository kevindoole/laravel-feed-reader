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
		<header class="brand">
			<h1>Gurgitator</h1>
		</header>
		<div id="work">
			<ul>
				<li v-repeat="item: items">
					<a class="item-link" href="@{{item.link}}">
						<article class="item">
							<p>
								@{{item.date}} | <span class="source">@{{item.source}}</span>
							</p>

							<h1>
								@{{item.title}}
							</h1>

							<p v-if="$item.categories" class="type">
								<i>Categories:</i> @{{item.categories}}
							</p>

						</article>
					</a>
				</li>
			</ul>
			<div class="pagination">
				<a v-on="click: update" v-if="prevPage" href="@{{prevPage}}">Previous page</a>
				Showing @{{from}} to @{{to}} of @{{total}}
				<a v-on="click: update" href="@{{nextPage}}">Next page</a>
			</div>
		</div>
	</div>

	<script src="http://cdnjs.cloudflare.com/ajax/libs/vue/0.12.12/vue.min.js"></script>
	<script src="/js/app.js"></script>
</body>
</html>