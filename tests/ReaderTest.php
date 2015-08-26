<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ReaderTest extends TestCase
{
    /**
     * Tests the ReaderController.
     *
     * @return void
     */
    public function testItShowsTenStories()
    {
        $items = \App\RssItem::limit(11)->get()->toArray();
        $this->visit('/')
             ->see($items[0]['title'])
             ->see($items[9]['title'])
             ->dontsee($items[10]['title']);
    }

    public function testItPaginates()
    {
        $this->visit('/')
             ->see('<a href="http://localhost/?page=2">2</a>');
    }

    public function testPageTwoLoadsCorrectItems()
    {
        $items = \App\RssItem::limit(21)->get()->toArray();
        $this->visit('?page=2')
             ->dontsee($items[0]['title'])
             ->dontsee($items[9]['title'])
             ->see($items[10]['title'])
             ->see($items[19]['title'])
             ->dontsee($items[20]['title']);
    }
}
