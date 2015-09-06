<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\RssItem;

class ReaderController extends Controller
{

    protected $items_per_page = 10;

    public function index()
    {
        $items = RssItem::orderby('pub_date', 'desc')->paginate($this->items_per_page);
        return view('reader.index', compact('items'));
    }

    public function jsonFeed()
    {
        $items = RssItem::orderby('pub_date', 'desc')->paginate($this->items_per_page);

        $json_data = [];

        foreach ($items as $item) {
            $json_data[] = [
                'date' => $item->pub_date->diffForHumans(),
                'source' => $item->source(),
                'title' => $item->title,
                'categories' => $item->categories,
                'link' => $item->link,
            ];
        }

        return json_encode($json_data);
    }
}
