var itemComponent = {
    template: '#item-template',
    props: [{
        name: 'parent-show-item',
        type: Function,
        required: true
    }],
    data: {
        'title': '',
        'date': '',
        'active': false,
        'viewed': false,
        'source': '',
        'categories': '',
        'link': '',
        'id': ''
    },
    methods: {
        showItem: function (index, e) {
            e.preventDefault();
            this.item.$set('active', true);
            this.item.$set('viewed', true);
            this.parentShowItem(this.item.link);
            this.$http.post('items/viewed/' + location.search, {id: this.item.id, _token: token});
        },
        deleteItem: function (e) {
            e.preventDefault();
            e.stopPropagation();
            this.item.$delete();

            this.$http.post('items/delete/' + location.search, {id: this.item.id, _token: token}, function (data, status, request) {
                this.$parent.$set('items', data.items);
                this.$parent.$set('total', data.total);
                this.$parent.$set('to', data.to);
            }).error(function (data, status, request) {
                alert('error');
            });
        }
    }
};

var items = new Vue({
    el: '#work',
    data: {
        'items': [],
        'nextPage': '',
        'prevPage': '',
        'from': '',
        'to': '',
        'total': '',
        'showing': false
    },
    components: {
        'item': itemComponent
    },
    ready: function () {
        var suffix = location.search ? location.search : '';
        this.loadFeeds('/items.json' + suffix);
    },
    methods: {
        onShowItem: function (link) {
            this.$set('showing', link);
        },
        changePage: function (e) {
            e.preventDefault();
            this.loadFeeds(e.target.href, function () {
                window.scrollTo(0, 0);
            });

            var new_url = e.target.href.replace('items.json/', '');
            history.pushState({}, '', new_url);
        },
        loadFeeds: function (url, cb) {
            this.$http.get(url, function (data, status, request) {

                this.$set('items', data.items);
                this.$set('nextPage', data.next_page_url);
                this.$set('prevPage', data.prev_page_url);
                this.$set('from', data.from);
                this.$set('to', data.to);
                this.$set('total', data.total);

                if ('function' === typeof cb) {
                    cb();
                }

            }).error(function (data, status, request) {
                alert('error');
            });
        }
    }
});
