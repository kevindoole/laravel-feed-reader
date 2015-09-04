<?php

function simple_pie_categories_to_string($categories)
{
    return sp_implode_attributes('category', $categories);
}

function simple_pie_authors_to_string($authors)
{
    return sp_implode_attributes('author', $authors);
}

function sp_implode_attributes($attributeName, $list)
{
    if (! is_array($list)) {
        return '';
    }

    $list = array_map(function ($attr) use ($attributeName) {
        return 'author' === $attributeName ? $attr->get_name() : $attr->get_term();
    }, $list);

    $list = implode(', ', $list);

    return $list;
}
