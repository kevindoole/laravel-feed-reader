var item = new Vue({
    el: '#work',
    data: {
        'items': [],
        'nextPage': '',
        'prevPage': '',
        'from': '',
        'to': '',
        'total': ''
    },
    ready: function () {
        var suffix = location.search ? location.search : '';
        this.loadFeeds('/items.json' + suffix);
    },
    methods: {
        update: function (e) {
            e.preventDefault();
            this.loadFeeds(e.target.href);

            var new_url = e.target.href.replace('items.json/', '');
            history.pushState({}, '', new_url);
        },
        loadFeeds: function (url) {
            this.$http.get(url, function (data, status, request) {

                this.$set('items', data.items);
                this.$set('nextPage', data.next_page_url);
                this.$set('prevPage', data.prev_page_url);
                this.$set('from', data.from);
                this.$set('to', data.to);
                this.$set('total', data.total);

            }).error(function (data, status, request) {
                alert('error');
            });
        }
    }
});