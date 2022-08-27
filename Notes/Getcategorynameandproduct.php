<?php get_header();
$current_category = get_queried_object();
$banner_image = get_field('banner_image', $current_category);


$children = get_terms($current_category->taxonomy, array(
    'parent'    => $current_category->term_id,
    'hide_empty' => false
));
// // print_r($children); // uncomment to examine for debugging
// if ($children) { // get_terms will return false if tax does not exist or term wasn't found.
//     // term has children
//     echo "true";
// }

?>

<div class=" product-category">
    <section class="banner-container banner-background p-15" style="background-image:url(<?php echo $banner_image ? $banner_image['url'] : 'https://demo.evergrowdigital.com/everhot/wp-content/uploads/2022/06/Strip-Banner2-2.jpg' ?>)">
        <div class="banner-inner">
            <h1 class="text-white"><?php echo $current_category->name; ?> Water Heaters</h1>
            <a href="#CTA" class="btn-primary hfe-menu-item elementor-button">Free Quote</a>
        </div>
    </section>

    <section class="section-container">
        <?php if ($children) { ?>
            <div class="category-sub-section">

                <?php

                $this_category = get_category($cat);
                //echo $this_category->cat_ID;
                $parent_term_id = $this_category->cat_ID; // term id of parent term

                //$termchildren = get_terms('category',array('child_of' => $parent_id));
                $taxonomies = array(
                    'taxonomy' => 'category'
                );

                $args = array(
                    'child_of'      => $parent_term_id
                );

                $terms = get_terms($taxonomies, $args);
                if (sizeof($terms) > 0) {

                    foreach ($terms as $term) { ?>
                        <h1 class="category-name"><?php echo $term->name; ?></h1>
                        <span></span>
                        <?php
                        $args  = array(
                            'post_type' => 'products',
                            'post_status' => 'publish',
                            'category__in' => $term->term_id,
                            'order' => 'DESC'
                        );
                        $query = new WP_Query($args);


                        while ($query->have_posts()) :
                            $query->the_post(); ?>
                            <div class="category-sub" id="<?php the_ID() ?>">
                                <div class="category-sub-flex section-container p-15">
                                    <div class="category-sub-col1">
                                        <?php the_post_thumbnail(); ?>
                                    </div>
                                    <div class="category-sub-col2">
                                        <h1 class="product-title"><?php the_title(); ?></h1>
                                        <p><?php echo wp_trim_words(get_the_content(), 10, '...'); ?></p>
                                        <div class="product_variants-wrap">
                                            <?php
                                            if (have_rows('available_variants')) : ?>
                                                <h5 class="m-0">Available:</h5>
                                                <ul class="product_variants">
                                                    <?
                                                    while (have_rows('available_variants')) : the_row();
                                                        echo "<li>" . $sub_value = get_sub_field('variants') . "</li>";
                                                    endwhile; ?>
                                                </ul>
                                            <?php endif; ?>
                                        </div>

                                        <?php if (have_rows('unique_selling_proposition')) : ?>
                                            <h5 class="spl-points">Special Points</h5>

                                            <ul class="product-usp">
                                                <? // Loop through rows.
                                                while (have_rows('unique_selling_proposition')) : the_row();

                                                    // Load sub field value.
                                                    echo "<li> <i class='fas fa-hand-point-right'></i>" . $sub_value = get_sub_field('points') . "</li>";
                                                // Do something...

                                                // End loop.
                                                endwhile; ?>
                                            </ul>
                                        <?php endif; ?>




                                        <a href="<?php the_permalink(); ?>">Explore</a>

                                    </div>
                                </div>
                            </div>
                <?php
                        endwhile;
                    }
                    echo '</div><!-- categories div end-->';
                }

                ?>
            </div>
        <?php } else{
            $args = array('category' => $current_category->term_id, 'post_type' =>  'products');
            $postslist = get_posts($args); ?>

            <div class="category-sub-section">
                <h1 class="category-name"><?php echo $current_category->name; ?></h1>
                <span></span>
                <?php
            foreach ($postslist as $post) :  setup_postdata($post);?>

                <div class="category-sub" id="<?php the_ID() ?>">
                    <div class="category-sub-flex section-container p-15">
                        <div class="category-sub-col1">
                            <?php the_post_thumbnail(); ?>
                        </div>
                        <div class="category-sub-col2">
                            <h1 class="product-title"><?php the_title(); ?></h1>
                            <p><?php echo wp_trim_words(get_the_content(), 10, '...'); ?></p>
                            <div class="product_variants-wrap">
                                <?php
                                if (have_rows('available_variants')) : ?>
                                    <h5 class="m-0">Available:</h5>
                                    <ul class="product_variants">
                                        <?
                                        while (have_rows('available_variants')) : the_row();
                                            echo "<li>" . $sub_value = get_sub_field('variants') . "</li>";
                                        endwhile; ?>
                                    </ul>
                                <?php endif; ?>
                            </div>

                            <?php if (have_rows('unique_selling_proposition')) : ?>
                                <h5 class="spl-points">Special Points</h5>

                                <ul class="product-usp">
                                    <? // Loop through rows.
                                    while (have_rows('unique_selling_proposition')) : the_row();

                                        // Load sub field value.
                                        echo "<li> <i class='fas fa-hand-point-right'></i>" . $sub_value = get_sub_field('points') . "</li>";
                                    // Do something...

                                    // End loop.
                                    endwhile; ?>
                                </ul>
                            <?php endif; ?>




                            <a href="<?php the_permalink(); ?>">Explore</a>

                        </div>
                    </div>
                </div>

            <?php endforeach;?>
            </div>
        <?php } ?>
    </section>
</div>

<?php get_footer() ?>
