<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RssItem extends Model
{
    protected $fillable = ['title', 'description', 'link'];
}
