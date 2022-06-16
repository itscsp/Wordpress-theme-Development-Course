<?php get_header(); ?>

<?php

while(have_posts()) {
    the_post(); ?>

    <div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg'); ?>)"></div>
        <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title"><?php the_title(); ?></h1>
        <div class="page-banner__intro">
            <p>DON'T FORGET TO REPLACE ME LATER</p>
        </div>
        </div>
    </div>
    <div class="container container--narrow page-section">
        <div class="metabox metabox--position-up metabox--with-home-link">
            <p>
                <a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('event'); ?>">
                <i class="fa fa-home" aria-hidden="true"></i> Events Home</a>
                <span class="metabox__main"><?php the_title(); ?></span>
            </p>
        </div>
        <div class="generic-content"><?php the_content(); ?></div>
        <?php
         $relatedPrograms = get_field('related_programs');
         if( $relatedPrograms ){
             ?>
        <hr class="section-break">
        <h2 class="headlinne headline-medium">Related Programs(s)</h2>
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