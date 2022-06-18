<?php get_header(); ?>

<?php

while(have_posts()) {
    the_post(); ?>

    <div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url(<?php
        $pageBannerImage = get_field('page_banner_background_image');
        echo $pageBannerImage['url'];
        // if we want show peciic crope size
        // echo $pageBannerImage['sizes']['pageBanner'];
        ?>)"></div>
        <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title"><?php the_title(); ?></h1>
        <div class="page-banner__intro">
            <p><?php
            the_field('page_banner_subtitle')
            ?></p>
        </div>
        </div>
    </div>
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

