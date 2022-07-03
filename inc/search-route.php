<?php
// createing custom rest api
add_action('rest_api_init', 'universityRegisterSearch');

function universityRegisterSearch() {
    register_rest_route('university/v1', 'search', array(
        'methods' => WP_REST_SERVER::READABLE,
        'callback' => 'universitySearchResult'
    ));
}

function universitySearchResult($data) {
    $mainQuery = new WP_Query(array(
        'post_type' => array('post', 'page', 'professor', 'program', 'campus', 'event'),
        's' => sanitize_text_field($data['term'])
    ));


    $results = array(
        'generalInfo' => array(),
        'professor' => array(),
        'programs' => array(),
        'events' => array(),
        'campuses' => array()
    );

    // API Login write down

    while($mainQuery->have_posts()) {
        $mainQuery->the_post();

        if(get_post_type() == 'post' OR get_post_type() == 'page'){
            array_push($results['generalInfo'], array(
                'title' => get_the_title(),
                'permlink' => get_the_permalink(),
                'postType' => get_post_type(),
                'authorName' => get_the_author()
            ));
        }

        if(get_post_type() == 'professor'){
            array_push($results['professor'], array(
                'title' => get_the_title(),
                'permlink' => get_the_permalink(),
                'image' => get_the_post_thumbnail_url(0, 'professorLandscape')
            ));
        }

        if(get_post_type() == 'program'){
            $relatedCampuses = get_field('related_campuses');

            if($relatedCampuses){
                foreach($relatedCampuses as $campus) {
                    array_push($results['campuses'], array(
                        'title' => get_the_title($campus),
                        'permlink' => get_the_permalink($campus)
                    ));
                }
            }

            array_push($results['programs'], array(
                'title' => get_the_title(),
                'permlink' => get_the_permalink(),
                'id' => get_the_ID()
            ));
        }

        if(get_post_type() == 'event'){
            $eventDate = new DateTime(get_field('event_date'));

            $description = null;
            if (has_excerpt()) {
                $description = get_the_excerpt();
            } else {
                $description = wp_trim_words(get_the_content(), 18);
            }

            array_push($results['events'], array(
                'title' => get_the_title(),
                'permlink' => get_the_permalink(),
                'month' => $eventDate->format('M'),
                'day' => $eventDate->format('d'),
                'description' => $description
            ));
        }

        if(get_post_type() == 'campus'){
            array_push($results['campuses'], array(
                'title' => get_the_title(),
                'permlink' => get_the_permalink()
            ));
        }
    }


    // here we getting related professor for searching programs

    $programRelationQuery = new WP_Query(array(
        'post_type' => 'professor',
        'meta_query' => array(
            array(
                'key' => 'related_programs',
                'compare' => 'LIKE',
                'value' => '"'.$results['programs'][0]['id'].'"'
            )
        )
    ));

    while($programRelationQuery->have_posts()) {
        $programRelationQuery->the_post();
        if(get_post_type() == 'professor'){
            array_push($results['professor'], array(
                'title' => get_the_title(),
                'permlink' => get_the_permalink(),
                'image' => get_the_post_thumbnail_url(0, 'professorLandscape')
            ));
        }
    }


    // this code remove dublicate in search result

    $results['professor'] = array_values(array_unique($results['professor'], SORT_REGULAR));
    $results['campuses'] = array_values(array_unique($results['campuses'], SORT_REGULAR));


   return $results;
}