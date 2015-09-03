<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoaderTest extends TestCase
{
    use DatabaseMigrations;

    public function test_it_loads_a_feed()
    {
        $testFeed = 'http://www.theguardian.com/world/rss';

        $rss_sample = file_get_contents(dirname(__FILE__) . '/test-assets/rss');
        $sampleFeed = new SimplePie();
        $sampleFeed->set_raw_data($rss_sample);
        $sampleFeed->init();

        FeedReader::shouldReceive('read')->once()->with($testFeed)->andReturn($sampleFeed);

        $exitCode = Artisan::call('feeds:load', [
            'feed_url' => $testFeed,
        ]);

        $this->assertEquals(1, $exitCode);
        $sampleItem = $sampleFeed->get_item();

        $this->seeInDatabase('rss_items', [
            'title' => $sampleItem->get_title(),
            'link' => $sampleItem->get_link(),
            'author' => $sampleItem->get_author(),
            'categories' => 'China, Japan, Second world war, Asia Pacific, World news, Vladimir Putin',
        ]);
    }
}
