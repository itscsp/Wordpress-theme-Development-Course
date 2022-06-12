# single Post Page


<?php
/**
 * The template for displaying all single posts and attachments
 */
  
get_header(); ?>
  
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
  
        <?php
        // Start the loop.
        while ( have_posts() ) : the_post();
  
            echo "<h1>".the_title()."</h1>; //it display page title
  
        // End the loop.
        endwhile;
        ?>
  
        </main><!-- .site-main -->
    </div><!-- .content-area -->
  
<?php get_footer(); ?>