<?php
add_action('rest_api_init', 'universityLikeRoutes');

function universityLikeRoutes() {
    // for post method
    register_rest_route('university/vl', 'manageLike', array(
        'methods' => 'POST',
        'callback' => 'createLike'
    ));

    // for delete method
    register_rest_route('university/vl', 'manageLike', array(
        'methods' => 'DELETE',
        'callback' => 'deleteLike'
    ));
}

function createLike() {
    return "for trying to create a like";
}

function deleteLike() {
    return "for trying to delete a like";
}
