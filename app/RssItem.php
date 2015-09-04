<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RssItem extends Model
{
    protected $fillable = ['title', 'link', 'author', 'categories', 'pub_date',];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'pub_date'];

    public static function fromSimplePie($items)
    {
        $items = array_map(function ($item) {
            return [
                'title' => $item->get_title(),
                'link' => $item->get_link(),
                'author' => simple_pie_authors_to_string($item->get_authors()),
                'categories' => simple_pie_categories_to_string($item->get_categories()),
                'pub_date' => $item->get_date('U'),
            ];
        }, $items);

        foreach ($items as $item) {
            static::create($item);
        }
    }
}
