var item = new Vue({
	el: '#work',
	ready: function () {
		this.$http.get('/items.json', function (data, status, request) {

		this.$set('items', data);

	}).error(function (data, status, request) {
		alert('error');
	});
  }
});