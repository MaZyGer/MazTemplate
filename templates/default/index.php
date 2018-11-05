<?php
Template::instance()->assignPage('start', 'start.html');

// Top nav
Template::instance()->assignPage('topnavi', 'topnavi.html');
Template::instance()->assignPage('headerslide', 'header.html');

// Custom variables
$username = "NiceUser";
Template::instance()->writeVar('username', $username);

if(false) {
    // Now special: We want show login field if we are logged.
    Template::instance()->setPageVar('login_nav_field', 'topnavi_loggedin.html');
} else {
    // but we can override, if we are not logged
    Template::instance()->setPageVar('login_nav_field', 'topnavi_loggedout.html');
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title></title>
  </head>
  <body>
	<?php Template::instance()->showPage('header'); ?>
	</br>
    <?php Template::instance()->showPage('start'); ?>
  </body>
</html>