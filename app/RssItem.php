<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RssItem extends Model
{
    protected $fillable = ['title', 'description', 'link', 'author', 'guid', 'pub_date', 'source', 'media_type', 'media_path'];

    public static function fromSimplePie($items)
    {
        $items = array_map(function ($item) {
            return [
                'title' => $item->get_title(),
                'link' => $item->get_link(),
                'author' => $item->get_author(),
                'categories' => simple_pie_categories_to_string($item->get_categories()),
                'pub_date' => $item->get_date(),
            ];
        }, $items);
        static::insert($items);
    }
}
