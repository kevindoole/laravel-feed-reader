<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RssItem extends Model
{
    protected $fillable = ['title', 'link', 'author', 'categories', 'pub_date', 'guid'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'pub_date'];

    public function scopePagedJson($query, $perPage)
    {
        $items = $query->orderby('pub_date', 'desc')->paginate($perPage);

        $json_data = $items->toArray();
        unset($json_data['data']);

        foreach ($items as $item) {
            $json_data['items'][] = [
                'date' => $item->pub_date->diffForHumans(),
                'source' => $item->source(),
                'title' => $item->title,
                'categories' => $item->categories,
                'link' => $item->link,
            ];
        }

        return $json_data;
    }

    public static function fromSimplePie($items)
    {
        $items = array_map(function ($item) {
            return [
                'title' => $item->get_title(),
                'link' => $item->get_link(),
                'categories' => simple_pie_categories_to_string($item->get_categories()),
                'pub_date' => $item->get_date('U'),
                'guid' => $item->get_id(),
            ];
        }, $items);

        foreach ($items as $item) {
            if (0 === static::where('guid', $item['guid'])->count()) {
                static::create($item);
            }
        }
    }

    public function source()
    {
        return parse_url($this->link, PHP_URL_HOST);
    }

    public function getTitleAttribute($title)
    {
        return html_entity_decode($title);
    }
}
