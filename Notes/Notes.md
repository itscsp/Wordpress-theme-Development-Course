# Wordpress functions and Tricks

## -> To Check if paage is parent

#### -> $isParent = get_pages(array('child_of' => get_the_ID()))

## -> To get parent ID

#### -> $theParent = wp_get_post_parent_id(get_the_ID());

## -> To get list all pages present in the wordpress

#### -> wp_list_pages(); /*it return all pages*/
#### -> wp_list_pages(array('title_li' => NULL, 'child_of' => get_the_ID)); /*we can pass associative array to function as arguments*/

## -> Assign language dynamically
#### language_attributes( string $doctype = 'html' ) /*Displays the language attributes for the ‘html’ tag.*/

## To add charset dynamically in <head> section of site
#### <meta charset="<?php bloginfo('charset') ?>">

## To add wordpress default class on body tag
<pre>
    body <?php body_class(); ?>  /*it give bunch of class that are usefull*/ -->
</pre>
#### example :
<pre>
    body class="home blog logged-in admin-bar  customize-support"
</pre>

## Ordering Post

<pre>

    $today = date('Ymd');

    $homePageEvents = new WP_Query(array(
    'post_type' => 'event',
    'posts+per_page' => -1,
    'meta_key' => 'event_date',
    'orderby' => 'meta_value_num',
    'order' => 'ASC',
    'meta_query' => array(
            array(
            'key' => 'event_date',
            'compare' => '>=',
            'value' => $today,
            'type' => 'numeric'
            )
        )
    ))

</pre>

