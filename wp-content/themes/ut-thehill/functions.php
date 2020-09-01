<?php

//===================================================================================================================
// Theme Options Page / This creates the options page
//===================================================================================================================


// Set up wordpress
// Set thumbnail sizes, post types allowed, menus set up, rewrite title html, make it HTML5, etc.
// A great deal of this will come from Twenty Thirteen, as that is the theme The Hill grew from.
require_once ( get_template_directory() . '/library/includes/wordpress-setup.php' );

// Custom Settings
require_once ( get_template_directory() . '/library/includes/custom-settings.php' );


// Make the Site Info page
require_once ( get_template_directory() . '/library/includes/site-info.php' );

// Make the options page
// Make the options option. Also, edit the body tag to actually implement the options
// UT work.
require_once ( get_template_directory() . '/library/includes/theme-options.php' );
require_once ( get_template_directory() . '/library/includes/customizer.php' );

// Bootstrap shortcodes
// This is taken from the web. But we're using a lot of BS functionality, so let's include it. Unedited.
require_once ( get_template_directory() . '/library/includes/bootstrap-shortcodes.php' );


// Sidebars
// Lets define the sidebars and the particular HTML it needs to output
// UT Work
require_once ( get_template_directory() . '/library/includes/sidebars.php' );

// Widgets
// Lets define the sidebars and the particular HTML it needs to output
// UT Work
require_once ( get_template_directory() . '/library/includes/widgets.php' );

// Shortcodes
// All of the UT-specific shortcodes are in this file. Leftcolumn, rightcolumn, etc.
// UT Work
require_once ( get_template_directory() . '/library/includes/shortcodes.php' );

// UT Stuff
// Very odd UT stuff. The login logo. The UT user, etc.
// UT Work
require_once ( get_template_directory() . '/library/includes/utk.php' );

// JSN
// Here we have the magic sauce that populates the page finder
// UT Work
// require_once ( get_template_directory() . '/library/includes/generateJsonForSuperSearch.php');

// Enqueue all the stylesheets and scripts
require_once ( get_template_directory() . '/library/includes/scripts.php' );

// Add aria walker class extension
require_once(get_template_directory() . '/library/includes/ariaWalker.php');


// Fix some forms stuff
require_once(get_template_directory() . '/library/includes/forms.php');


// Add a soliloquy slider to the featured image area
require_once(get_template_directory() . '/library/includes/featured-slider.php');

// Gutenberg
// Let's try to remove some of the blocks we don't want.
require_once ( get_template_directory() . '/library/includes/gutenberg-blocksupport.php' );




// Make featured image area full width
require_once(get_template_directory() . '/library/includes/fullwidth.php');