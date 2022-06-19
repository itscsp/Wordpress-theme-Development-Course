<?php get_header(); ?>

<?php

while(have_posts()) {
    the_post();
    pageBanner(array(
        'title' => null,
        'subtitle' => null,
        'photo' => null
      ));

    ?>

    <div class="container container--narrow page-section">

        <div class="generic-content">

            <div class="row group">
                <div class="one-third">
                    <?php the_post_thumbnail('professorPortrait'); ?>
                    <!-- Here professorPortrait feature not working now -->
                </div>
                <div class="two-thirds">
                        <?php the_content(); ?>
                </div>
            </div>

        </div>

        <?php
         $relatedPrograms = get_field('related_programs');
         if( $relatedPrograms ){
             ?>
        <hr class="section-break">
        <h2 class="headline headline--medium">Subject(s) Taught</h2>
        <ul class="link-list min-list">
        <?php

            foreach($relatedPrograms as $programs) { ?>

                <li>
                    <a href="<?php echo get_the_permalink($programs); ?>"><?php  echo get_the_title($programs); ?></a>
                </li>
            <?php }

        ?>
        </ul>
        <?php
         }?>
    </div>

<?php }
?>

<?php get_footer(); ?>

