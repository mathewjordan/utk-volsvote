<?php
/**
 * The sidebar containing the secondary widget area
 *
 * Displays on posts and pages.
 *
 * If no active widgets are in this sidebar, hide it completely.
 *
 * @package WordPress
 * @subpackage UT-TheHill
 * @since Twenty Thirteen 1.0
 */

// Does a custom sidebar exist?
$customSidebarId = get_post_meta( $post->ID,'ut_ssb_value_key', true );
$showTitle = get_post_meta( $post->ID,'ut_ssb_use_title_key', true );
if($customSidebarId && $customSidebarId != "--") { 
	$thisSidebar = get_post( $customSidebarId);
    $status = $thisSidebar->post_status;
}
	    
if(isset($status) && $status == "publish"): ?>
    	<section id="tertiary" class="sidebar-container widget ut_custom_sidebars">
	    	<?php if($showTitle) { echo "<h2>".$thisSidebar->post_title."</h2>"; } ?>
	    	<?php 
		    	///Get the content
		    	$content = $thisSidebar->post_content;
		    	// Add the html back in
		    	$content = apply_filters( 'the_content' , $content );
		    	// Render
		    	echo $content ?>
    	</section>
<?php else: ?>
    <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
		<div id="tertiary" class="sidebar-container" role="complementary">
				<div class="widget-area">
					<?php dynamic_sidebar( 'sidebar-1' ); ?>
				</div><!-- .widget-area -->
				
				<br class="clear">
				



		</div><!-- #tertiary -->
	<?php endif; ?>
<?php endif; ?>