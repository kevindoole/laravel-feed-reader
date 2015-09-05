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
}
