<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ReaderTest extends TestCase
{
    use DatabaseMigrations;

    public function testItShowsTenStories()
    {
        $items = factory(App\RssItem::class, 15)->create();
        $this->visit('/')
             ->see($items[0]['title'])
             ->see($items[9]['title'])
             ->dontsee($items[10]['title']);
    }

    public function testItPaginates()
    {
        $items = factory(App\RssItem::class, 15)->create();
        $this->visit('/')
             ->see('<a href="http://localhost/?page=2">2</a>');
    }

    public function testPageTwoLoadsCorrectItems()
    {
        $items = factory(App\RssItem::class, 25)->create();
        $this->visit('?page=2')
             ->dontsee($items[0]['title'])
             ->dontsee($items[9]['title'])
             ->see($items[10]['title'])
             ->see($items[19]['title'])
             ->dontsee($items[20]['title']);
    }
}
