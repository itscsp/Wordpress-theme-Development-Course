#Createing Dynamic Navigation Menus

## register_nav_menu('headerMenuLocation', 'Header Menu Location');
#### these two function name are completety your choice
#### headerMenuLocation :- used as argumnet when you call the funciton to display menus
#### 'Header Menu Location' :- used in backend of site for you to check

<pre style="color:red">
 <?php
   wp_nav_menu(array(
        'theme_location' => 'headerMenuLocation'
   ));
 ?>
 </pre>