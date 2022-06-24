<?php

get_header();
pageBanner(array(
  'title' => 'All Compuses',
  'subtitle' => 'See what is going on in our world.',
  'photo' => null
));
 ?>

<div class="container container--narrow page-section">
<?php

  while(have_posts()) {
    the_post();
    get_template_part('template-parts/content-event');
   }
  echo paginate_links();
?>

</div>

<?php get_footer();

?>