<?php

//===================================================================================================================
// Make Soliloquy plugin compatible
//===================================================================================================================

add_filter( 'soliloquy_image_src', 'tgm_soliloquy_https_url' );
function tgm_soliloquy_https_url( $src ) {
     
    return is_ssl() ? str_replace( 'http://', 'https://', $src ) : $src;
     
}

//===================================================================================================================
// Let's put the UT Logo on the login screen
//===================================================================================================================

function change_ut_wp_login_image() {
echo "
<style>
body.login #login h1 a {
background: url('".get_bloginfo('template_url')."/images/interface/login.png') 8px 0 no-repeat transparent;
background-size: 240px 117px;
height:117px;
width:240px; }
</style>
";
}
add_action("login_head", "change_ut_wp_login_image");



//===================================================================================================================
// UT Site ADMIN
//===================================================================================================================

// Creates a new level of user that has more access than editor but less
// than administrator. Allows us not to use User Role Editor plugin
add_role('UT_site_admin', 'UT Site Admin', array(
	'delete_others_pages' => true,
	'delete_others_posts' => true,
	'delete_pages' => true,
	'delete_posts' => true,
	'delete_private_pages' => true,
	'delete_private_posts' => true,
	'delete_published_pages' => true,
	'delete_published_posts' => true,
	'edit_others_pages' => true,
	'edit_others_posts' => true,
	'edit_pages' => true,
	'edit_posts' => true,
	'edit_private_pages' => true,
	'edit_private_posts' => true,
	'edit_published_pages' => true,
	'edit_published_posts' => true,
	'edit_theme_options' => true,
	'switch_themes' => false,
	'gravityforms_create_form' => true,
	'gravityforms_delete_entries' => true,
	'gravityforms_delete_forms' => true,
	'gravityforms_edit_entries' => true,
	'gravityforms_edit_entry_notes' => true,
	'gravityforms_edit_forms' => true,
	'gravityforms_export_entries' => true,
	'gravityforms_feed' => true,
	'gravityforms_view_entries' => true,
	'gravityforms_view_entry_notes' => true,
	'list_users' => true,
	'manage_categories' => true,
	'manage_links' => true,
	'moderate_comments' => true,
	'publish_pages' => true,
	'publish_posts' => true,
	'read' => true,
	'read_private_pages' => true,
	'read_private_posts' => true,
	'upload_files' => true,
	'view_stats' => true,
	'show_admin_bar' => true,
));

// This fixes a problem where no one except administrators could save theme options
// Fix was found in Twenty Eleven theme, and modified to apply to this theme, 
// And confirmed here http://wordpress.org/support/topic/wordpress-settings-api-cheatin-uh-error
function ut_horizontal_option_page_capability( $capability ) {
	return 'edit_theme_options';
}
add_filter( 'option_page_capability_ut_theme_options', 'ut_horizontal_option_page_capability' );

// Create Custom Admin Menu
// Hook for adding admin menus
add_action('admin_menu', 'ut_help_menu');

// action function for above hook
function ut_help_menu() {
	
	$favicon=get_template_directory_uri().'/images/interface/custom-admin-icon.png';
	
    // Add a new top-level menu:
    $hook=add_menu_page(__('UT WordPress Theme Help'), __('UT Theme Help'), 'edit_published_posts', 'ut-theme-admin-help', 'ut_help', 'dashicons-editor-help', 3 );
}

// displays the page content for the custom UT Help menu
function ut_help() {
	require_once ( get_template_directory() . '/library/includes/help/opt-help.php' );
} 


add_filter('embed_oembed_html', 'wrap_embed_with_div', 10, 3);

function wrap_embed_with_div($html, $url, $attr) {
	return "<div class=\"responsive-container\">".$html."</div>";
}


?>