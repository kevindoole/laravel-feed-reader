<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RssItem extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'link', 'author', 'categories', 'pub_date', 'guid'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'pub_date', 'deleted_at'];

    /**
     * Format a collection of items for our Vue viewmodel.
     * @param  Builder $query
     * @param  int     $perPage Number of items to show per page
     * @return array   Ready for JSON array of item data
     */
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
                'id' => $item->id,
                'viewed' => $item->viewed,
            ];
        }

        return $json_data;
    }

    /**
     * The model can create a list of records from a Simplepie_Items array.
     *
     * Items with previously persisted guids are skipped.
     *
     * @param  array $items An array of SimplePie_Item references
     * @return array        The count of loaded and skipped items
     */
    public static function fromSimplePie($items)
    {
        $loaded = 0;
        $skipped = 0;


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
            if (0 === static::withTrashed()->where('guid', $item['guid'])->count()) {
                static::create($item);
                $loaded++;
            } else {
                $skipped++;
            }
        }

        return compact('loaded', 'skipped');
    }

    /**
     * Show the source of the article, based on the domain in the item link.
     * @return string The domain in the link attribute
     */
    public function source()
    {
        return parse_url($this->link, PHP_URL_HOST);
    }

    /**
     * Encode entities before showing an item title.
     * @param  string $title The title pulled from RSS
     * @return string        The title with encoded entities
     */
    public function getTitleAttribute($title)
    {
        return html_entity_decode($title);
    }
}
