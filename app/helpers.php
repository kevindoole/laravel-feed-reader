<?php

/**
 * Implode an array of Simplepie_Category into a string.
 * @param  array $categories
 * @return string
 */
function simple_pie_categories_to_string($categories)
{
    return sp_implode_attributes('category', $categories);
}

/**
 * Implode an array of Simplepie_Author into a string.
 * @param  array $authors
 * @return string
 */
function simple_pie_authors_to_string($authors)
{
    return sp_implode_attributes('author', $authors);
}

/**
 * Implodes Simplepie attributes.
 * @param  string $attributeName The name of the simplepie attr
 * @param  array  $list          The list of simplepie attr references
 * @return string
 */
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
