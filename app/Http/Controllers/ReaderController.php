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
        return view('reader.index');
    }

    public function jsonFeed()
    {
        $data = RssItem::pagedJson($this->items_per_page);

        return json_encode($data);
    }

    public function deleteItem(Request $request)
    {
        $id = $request->get('id');

        RssItem::where('id', $id)->delete();

        return $this->jsonFeed();
    }

    public function viewedItem(Request $request)
    {
        $id = $request->get('id');

        RssItem::where('id', $id)->update(['viewed' => true]);
    }
}
