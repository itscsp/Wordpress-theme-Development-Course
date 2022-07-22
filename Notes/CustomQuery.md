
<?php




    $args = array(  
        'post_type' => 'products',
    );

    $loop = new WP_Query( $args ); 
        
    echo '<div  id="owl-carousel" class="owl-carousel owl-theme">';
    while ( $loop->have_posts() ) : $loop->the_post(); ?>
        
        <div class="owlitem ">
            
            <div class="singleitem">
                <h1 class="text-center"><?php echo $title = the_title();?> </h1>

                <p><?php echo substr(get_field('product_short_description'), 0, 60);?>...</p>

                <div class="prd-img">
                            <?php 
                            if( get_field('product_image') ): ?>
                                <img src="<?php the_field('product_image'); ?>" />
                            <?php else: ?>
            
                            <img  src="https://web.idaksh.net/ledmasterme-wp/wp-content/uploads/2022/04/placeholder-2.png" />
                        <?php endif; ?>
                </div>

            </div>
        

        </div>

    <?php 
    endwhile;?>
    </div>


    <?php
    wp_reset_postdata(); 
    ?>


