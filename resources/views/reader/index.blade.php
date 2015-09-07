<!DOCTYPE html>
<html lang="en">
<head>
	<link href='//fonts.googleapis.com/css?family=Lusitana:700' rel='stylesheet' type='text/css'>
	<meta charset="UTF-8">
	<title>Reader</title>
	<link rel="stylesheet" href="/css/app.css">
	<script>
	var token = '{{ csrf_token() }}';
	</script>
</head>
<body>
	<div class="wrapper">
		<header class="brand">
			<h1>Gurgitator</h1>
		</header>
		<div id="work">
			<ul>
				<item
					v-repeat="item: items"
					track-by="id"
					parent-show-item="@{{onShowItem}}"
					v-transition="expand"
				></item>
			</ul>
			<div class="pagination">
				<a class="prev" v-on="click: changePage" v-if="prevPage" href="@{{prevPage}}">Previous page</a>
				Showing @{{from}} to @{{to}} of @{{total}}
				<a class="next" v-on="click: changePage" v-if="nextPage" href="@{{nextPage}}">Next page</a>
			</div>
			<div v-if="showing" class="offsite-content">
				<header>
					<button v-on="click: showing = false">Back to the thing</button>
				</header>
				<iframe v-attr="src: showing" frameborder="0"></iframe>
			</div>
		</div>
	</div>

	<script type="text/x-template" id="item-template">
		<li>
			<a
				v-on="click: showItem($event)"
				class="item-link"
				v-class="active: item.active, visited: item.viewed"
				href="@{{item.link}}"
			>
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

					<button v-on="click: deleteItem($event)" class="delete">Delete</button>
				</article>
			</a>
		</li>
	</script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/vue/0.12.12/vue.min.js"></script>
	<script src="/js/app.js"></script>
</body>
</html>