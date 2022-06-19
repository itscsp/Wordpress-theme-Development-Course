<?php
  get_header();
  pageBanner(array(
    'title' => 'Past Events',
    'subtitle' => 'A recap of our events',
    'photo' => null
  ));

  ?>
  <div class="container container--narrow page-section">
    <?php
        $today = date('Ymd');

        $pastEvent = new WP_Query(array (
            'paged' => get_query_var('paged', 1),
            'post_type' => 'event',
            // 'posts_per_page' => 1,
            'meta_key' => 'event_date',
            'orderby' => 'meta_value_num',
            'order' => 'ASC',
            'meta_query' => array(
                array(
                'key' => 'event_date',
                'compare' => '<',
                'value' => $today,
                'type' => 'numeric'
                )
            )
        ));
      while($pastEvent->have_posts()){
        $pastEvent->the_post();
        get_template_part('template-parts/content', 'event');


       }

      echo paginate_links(array(
          'total' => $pastEvent->max_num_pages
      ));
    ?>
  </div>


<?php

  get_footer();
?>