<?php

function simple_pie_categories_to_string($categories)
{
    if (! is_array($categories)) {
        return '';
    }

    $categories = array_map(function ($cat) {
        return $cat->get_term();
    }, $categories);

    $categories = implode(', ', $categories);

    return $categories;
}
