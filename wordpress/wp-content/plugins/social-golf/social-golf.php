<?php
/*
    Plugin Name: Social Golf Club Organizer
    Plugin URI: http://todo
    Description: Run a social golf club with WordPress.
    Version: 0.1
    Author: Stuart Langley
    Author URI: https://plus.google.com/+StuartLangley
    License: GPL
*/

namespace social_golf;


function activation() {
  do_action('social-golf-activation');
}

function deactivation() {
  do_action('social-golf-deactivation');
}

function uninstall() {
  do_action('social-golf-uninstall');
}

// Register our defined modules.
$modules = [];
if ( $modules_dir = @ opendir( __DIR__ . '/modules/' ) ) {
  while ( false !== ( $file = readdir( $modules_dir ) ) ) {
    if ( '.php' === substr( $file, -4 ) )
      $modules[] = $file;
  }
  @closedir( $modules_dir );
  sort( $modules );

  foreach ( $modules as $file ) {
    require_once __DIR__ . '/modules/' . $file ;
  }
}

register_activation_hook( __FILE__, __NAMESPACE__ . '\\activation' );
register_deactivation_hook(__FILE__, __NAMESPACE__ . '\\deactivation');
register_uninstall_hook(__FILE__, __NAMESPACE__ . '\\uninstall');