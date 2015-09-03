<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use FeedReader;
use \App\RssItem;

class LoadFeeds extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'feeds:load
                            {feed_url=http://www.theonion.com/feeds/rss : The full feed url}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports an RSS feed into the database.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        date_default_timezone_set('America/Winnipeg');
        $url = $this->argument('feed_url');
        $feed = FeedReader::read($url);
        if ($feed->error()) {
            $this->error($feed->error());
            return 2;
        }
        $items = $feed->get_items();
        RssItem::fromSimplePie($items);
        return 1;
    }
}
