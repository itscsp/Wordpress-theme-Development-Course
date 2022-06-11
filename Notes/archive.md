# How to Create a Custom Archives Page in WordPress
### Custom archives page is a great way to bring together all your old content in one page. 

#### Refernce Site : https://visualcomposer.com/blog/wordpress-archive-page-and-post-grid/



<pre class="EnlighterJSRAW" data-enlighter-language="php">&lt;?php
/* Template Name: Custom Template */

get_header();
?&gt;

    &lt;main id="main" class="content-wrapper"&gt;

        &lt;?php if ( have_posts() ) : ?&gt;

            &lt;header class="page-header"&gt;
                &lt;?php
                the_archive_title( '&lt;h1 class="page-title"&gt;', '&lt;/h1&gt;' );
                ?&gt;
            &lt;/header&gt;

            &lt;?php
            // Start the Loop.
            while ( have_posts() ) :
                // You can list your posts here
                the_post();
                ?&gt;
                &lt;div class="archive-item"&gt;
                    &lt;div class="post-title"&gt;
                        &lt;a href="&lt;?php the_permalink(); ?&gt;"&gt;
                            &lt;?php the_title(); ?&gt;
                        &lt;/a&gt;
                    &lt;/div&gt;

                    &lt;div class="post-thumbnail"&gt;
                        &lt;a href="&lt;?php the_permalink(); ?&gt;"&gt;
                            &lt;?php the_post_thumbnail(); ?&gt;
                        &lt;/a&gt;
                    &lt;/div&gt;

                    &lt;div class="post-content"&gt;
                        &lt;?php the_content(); ?&gt;
                    &lt;/div&gt;
                &lt;/div&gt;
            &lt;?php
            endwhile;

            // Navigation
            the_post_navigation();
        else :
            // No Post Found
        endif;
        ?&gt;
    &lt;/main&gt;&lt;!-- #main --&gt;

&lt;?php
get_footer();
</pre>
