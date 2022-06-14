<?php
// Load files
function univercity_files() {

    wp_enqueue_script('main-university-js', get_theme_file_uri('/js/index.js'), NULL, '1.0', true);

    wp_enqueue_style('Custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');


    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

    wp_enqueue_style('univercity_main_styles', get_stylesheet_uri());

}

//to generate unique title

function univercity_features() {
    register_nav_menu('headerMenuLocation', 'Header Menu Location'); // Create Menu Display option at backend of you site
    // register_nav_menu('footerLocationOne', 'Footer Location One');
    // register_nav_menu('footerLocationTwo', 'Footer Location Two');

    add_theme_support('title-tag');
}

// to do change in archive page

function univercity_adjust_queries($query) {
    $today = date('Ymd');

    if(!is_admin() AND is_post_type_archive('event') AND $query->is_main_query()){
        $query->set('meta_key', 'event_date');
        $query->set('orderby', 'meta_value_num');
        $query->set('order', 'ASC');
        $query->set('meta_query', array(
            array(
              'key' => 'event_date',
              'compare' => '>=',
              'value' => $today,
              'type' => 'numeric'
            )
          ));


    }
}




/**********************
Actions
***********************/

add_action('wp_enqueue_scripts', 'univercity_files');

add_action('after_setup_theme','univercity_features');

add_action('pre_get_posts', 'univercity_adjust_queries');