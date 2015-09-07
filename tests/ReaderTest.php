<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ReaderTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    public function testItShowsTenStories()
    {
        factory(App\RssItem::class, 15)->create();
        $items = \App\RssItem::pagedJson(15);
        $this->visit('items.json')
             ->seeJson($items['items'][0])
             ->seeJson($items['items'][9])
             ->dontseeJson(['title' => $items['items'][10]]);
    }

    public function testItPaginates()
    {
        $items = factory(App\RssItem::class, 15)->create();
        $this->visit('items.json')
             ->seeJson(['next_page_url' => 'http://localhost/items.json/?page=2']);
    }

    public function testPageTwoLoadsCorrectItems()
    {
        factory(App\RssItem::class, 25)->create();
        $items = \App\RssItem::pagedJson(25);
        $this->visit('items.json/?page=2')
             ->dontseeJson(['title' => $items['items'][0]])
             ->dontseeJson(['title' => $items['items'][9]])
             ->seeJson($items['items'][10])
             ->seeJson($items['items'][19])
             ->dontseeJson(['title' => $items['items'][20]]);
    }
}
