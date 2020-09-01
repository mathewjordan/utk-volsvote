<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage UT-TheHill
 * @since Twenty Thirteen 1.0
 */
?><!DOCTYPE html>

<html <?php language_attributes(); ?>>
<?php  get_template_part( 'library/partials/head' ); ?>
<body <?php body_class(); ?>>
<?php
  $sitemode = get_theme_mod( 'site_mode_layout' );
  if ($sitemode!="webapp") {
    echo '<div id="orange-bar"></div><div id="page" class="hfeed site row-offcanvas"><div id="main" class="site-main">';
 }
?>


<div class="main-content">
  
  <a class="sr-only sr-only-focusable" href="#content" title="<?php esc_attr_e( 'Skip to content', 'utthehill' ); ?>"><?php _e( 'Skip to content', 'utthehill' ); ?></a>
  <a class="sr-only sr-only-focusable" href="#mainnav" title="<?php esc_attr_e( 'Skip to  main navigation', 'utthehill' ); ?>"><?php _e( 'Skip to main navigation', 'utthehill' ); ?></a>
  <a class="sr-only sr-only-focusable" href="https://oed.utk.edu/ada/campus-accessibility/" title="<?php esc_attr_e( 'Report an accessibility issue', 'utthehill' ); ?>"><?php _e( 'Report an accessibility issue', 'utthehill' ); ?></a>

<?php
  if ($sitemode=="webapp") {  
    get_template_part( 'library/partials/inc-v2019-header' );
  } else {
    get_template_part( 'library/partials/inc-v2015-siderail' );
  }
  if ($sitemode!="webapp") {
    echo '<div id="primary" class="content-area">';
    get_template_part( 'library/partials/inc-v2015-sitetitle' ); 
  } ?>