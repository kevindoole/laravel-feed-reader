<?php

use App\RssItem;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoaderTest extends TestCase
{
    use DatabaseMigrations;

    protected static $sampleFeed;

    protected $testFeedUrl;

    public function setUp()
    {
        parent::setUp();
        $rss_sample = file_get_contents(dirname(__FILE__) . '/test-assets/rss');
        $sampleFeed = new SimplePie();
        $sampleFeed->set_raw_data($rss_sample);
        $sampleFeed->init();
        self::$sampleFeed = $sampleFeed;

        $this->testFeedUrl = 'http://www.theguardian.com/world/rss';
    }

    public function test_it_loads_a_feed()
    {
        $testFeed = $this->testFeedUrl;

        FeedReader::shouldReceive('read')
            ->once()
            ->with([$testFeed])
            ->andReturn(self::$sampleFeed);

        $exitCode = Artisan::call('feeds:load', [
            'feed_url' => $testFeed,
        ]);

        $this->assertEquals(1, $exitCode);
        $sampleItem = self::$sampleFeed->get_item();

        $this->seeInDatabase('rss_items', [
            'title' => $sampleItem->get_title(),
            'link' => $sampleItem->get_link(),
            'categories' => 'China, Japan, Second world war, Asia Pacific, World news, Vladimir Putin',
            'guid' => $sampleItem->get_id(),
        ]);
    }

    public function test_it_doesnt_reload_duplicate_items()
    {
        $testFeed = $this->testFeedUrl;

        FeedReader::shouldReceive('read')
            ->twice()
            ->with([$testFeed])
            ->andReturn(self::$sampleFeed);

        Artisan::call('feeds:load', [
            'feed_url' => $testFeed,
        ]);
        Artisan::call('feeds:load', [
            'feed_url' => $testFeed,
        ]);

        $sampleItem = self::$sampleFeed->get_item();

        $expected_count = 1;
        $actual_count = \App\RssItem::where('guid', $sampleItem->get_id())->count();

        $this->assertEquals($expected_count, $actual_count);
    }
}
