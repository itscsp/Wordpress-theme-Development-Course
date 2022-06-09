# Wordpress functions and Tricks

## -> To Check if paage is parent

### -> $isParent = get_pages(array('child_of' => get_the_ID()))

## -> To get parent ID

### -> $theParent = wp_get_post_parent_id(get_the_ID());

## -> To get list all pages present in the wordpress

### -> wp_list_pages(); /*it return all pages*/
### -> wp_list_pages(array('title_li' => NULL, 'child_of' => get_the_ID)); /* we can pass associative array to function as arguments */


