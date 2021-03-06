<?php


/* Gobal Page Banner Section

    calling this function
    pageBanner(array(
        'title' => null,
        'subtitle' => null,
        'photo' => null
    ));

*/
function pageBanner($args=NULL) {

        if (!$args['title']) {
            $args['title'] = get_the_title();
        }

        if (!$args['subtitle']) {
            $args['subtitle'] = get_field('page_banner_subtitle');
        }
        if (!$args['photo']) {
            if (get_field('page_banner_background_image') AND !is_archive() AND !is_home() ) {
                $args['photo'] = get_field('page_banner_background_image')['url'];
            } else {
                $args['photo'] = get_theme_file_uri('/images/ocean.jpg');
            }
        }
    ?>
    <div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url(<?php echo $args['photo']; ?>)"></div>
        <div class="page-banner__content container container--narrow">
            <h1 class="page-banner__title"><?php echo $args['title']; ?></h1>
            <div class="page-banner__intro">
                <p><?php
                echo $args['subtitle'];
                ?></p>
            </div>
        </div>
    </div>
    <?php
}





// Load files
function univercity_files() {

    wp_enqueue_script('main-university-js', get_theme_file_uri('/js/index.js'), NULL, '1.0', true);

    wp_enqueue_style('Custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');


    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

    wp_enqueue_style('univercity_main_styles', get_stylesheet_uri());

}

//to generate unique title

function univercity_features() {
    // register_nav_menu('headerMenuLocation', 'Header Menu Location'); // Create Menu Display option at backend of you site
    // register_nav_menu('footerLocationOne', 'Footer Location One');
    // register_nav_menu('footerLocationTwo', 'Footer Location Two');

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_image_size('professorLandscape', 400, 260, true); //this functionality not working in my host but works in other hosts
    add_image_size('professorPortrait', 480, 650, true);
    add_image_size('PageBanner', 1500, 350, true);

}

// to do change in archive page

function univercity_adjust_queries($query) {
    if(!is_admin() AND is_post_type_archive('program') AND is_main_query()) {
        $query->set('orderby', 'title');
        $query->set('order', 'ASC');
        $query->set('posts_per_page', -1);
    }

    $today = date('Ymd');

    if(!is_admin() AND is_post_type_archive('event') AND is_main_query()){
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