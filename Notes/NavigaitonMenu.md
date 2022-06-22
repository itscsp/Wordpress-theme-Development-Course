# Creating Custom Navigation Menus in WordPress Themes
### To add a custom navigation menu, the first thing you need to do is register your new navigation menu by adding this code to your theme’s functions.php file.

#### /*In function.php*/
#### function wpb_custom_new_menu() {
####    register_nav_menu('my-custom-menu',__( 'My Custom Menu' ));
#### }

#### add_action( 'init', 'wpb_custom_new_menu' );


### You can now go to Appearance » Menus page in your WordPress admin and try to create or edit a new menu. You will see ‘My Custom Menu’ as theme location option.

![choose-menu-location](https://user-images.githubusercontent.com/86185190/173168424-eb9011d0-d584-4c0e-ad60-ddac682badec.jpg)


# Displaying Custom Navigation Menus in WordPress Themes

/*In header.php*/
#### <?php
#### wp_nav_menu( array(
####     'theme_location' => 'headerMenuLocation',
####     'container_class' => 'custom-menu-class' ) );
#### ?>

you write any where these code that will give Navigation


