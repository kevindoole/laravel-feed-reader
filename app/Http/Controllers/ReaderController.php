<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\RssItem;

class ReaderController extends Controller
{

    /**
     * The number of items to show per page
     * @var integer
     */
    protected $items_per_page = 10;

    /**
     * Show a static template which contains our Vue template.
     * @return Response
     */
    public function index()
    {
        return view('reader.index');
    }

    /**
     * Present the JSON encoded data our view model expects.
     * @return string JSON-encoded data
     */
    public function jsonFeed()
    {
        $data = RssItem::pagedJson($this->items_per_page);

        return json_encode($data);
    }

    /**
     * Delete an item and return a new list to refill the page.
     * @param  Request $request
     * @return string           JSON-encoded data
     */
    public function deleteItem(Request $request)
    {
        $id = $request->get('id');

        RssItem::where('id', $id)->delete();

        return $this->jsonFeed();
    }

    /**
     * Mark an item as viewed.
     * @param  Request $request
     * @return void
     */
    public function viewedItem(Request $request)
    {
        $id = $request->get('id');

        RssItem::where('id', $id)->update(['viewed' => true]);
    }
}
