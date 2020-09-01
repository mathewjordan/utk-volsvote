<?php



//===================================================================================================================
// 
//    [ WIDGETS AND LINK DRAWER ]
// 
//===================================================================================================================


//===================================================================================================================
// Fire up the widgets
//===================================================================================================================
function utresponsive_widgets_init() {


//    add_filter( 'widget_title', function( $title ) { return '<i>' . $title . '</i>'; } );
//    $wtitle = apply_filters('widget_title', empty( $instance['title'] ) );

// <a class="btn btn-primary" data-toggle="collapse" href="#%1$s" aria-expanded="false" aria-controls="%1$s">'. $wtitle . '</a>

	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'utresponsive' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( '404 Helpers', 'utresponsive' ),
		'id' => 'sidebar-404',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
			) );



//===================================================================================================================
// Link drawer sidebars
//===================================================================================================================

	register_sidebar( array(
		'name' => __( 'Link Drawer Area One', 'utresponsive' ),
		'id' => 'sidebar-3',
		'description' => __( 'An optional widget area for your site Link Drawer ', 'utresponsive' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Link Drawer  Area Two', 'utresponsive' ),
		'id' => 'sidebar-4',
		'description' => __( 'An optional widget area for your site Link Drawer ', 'utresponsive' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Link Drawer Area Three', 'utresponsive' ),
		'id' => 'sidebar-5',
		'description' => __( 'An optional widget area for your site Link Drawer ', 'utresponsive' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );





//===================================================================================================================
// Expanded Footer Widgets
//===================================================================================================================

	register_sidebar( array(
		'name' => __( 'Expanded Footer Area One', 'utresponsive' ),
		'id' => 'sidebar-6',
		'description' => __( 'An optional widget area for your site Expanded Footer ', 'utresponsive' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Expanded Footer Area Two', 'utresponsive' ),
		'id' => 'sidebar-7',
		'description' => __( 'An optional widget area for your site Expanded Footer ', 'utresponsive' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Expanded Footer Area Three', 'utresponsive' ),
		'id' => 'sidebar-8',
		'description' => __( 'An optional widget area for your site Expanded Footer ', 'utresponsive' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Expanded Footer Area Four', 'utresponsive' ),
		'id' => 'sidebar-9',
		'description' => __( 'An optional widget area for your site Expanded Footer ', 'utresponsive' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

}
add_action( 'widgets_init', 'utresponsive_widgets_init' );








//===================================================================================================================
//  Count the number of Link Drawer Sidebars and act accordingly
//===================================================================================================================

function utthehill_footer_sidebar_class() {
	$count = 0;

	if ( is_active_sidebar( 'sidebar-3' ) )
		$count++;

	if ( is_active_sidebar( 'sidebar-4' ) )
		$count++;

	if ( is_active_sidebar( 'sidebar-5' ) )
		$count++;

	$class = '';

	switch ( $count ) {
		case '1':
			$class = 'linkdrawer-one';
			break;
		case '2':
			$class = 'linkdrawer-two';
			break;
		case '3':
			$class = 'linkdrawer-three';
			break;
	}

	if ( $class )
		echo 'class="' . $class . '"';
}





//===================================================================================================================
//  Count the number of Expanded Footer Sidebars and act accordingly
//===================================================================================================================

function utthehill_expandedfooter_sidebar_class() {
	$count = 0;

	if ( is_active_sidebar( 'sidebar-6' ) )
		$count++;

	if ( is_active_sidebar( 'sidebar-7' ) )
		$count++;

	if ( is_active_sidebar( 'sidebar-8' ) )
		$count++;

	if ( is_active_sidebar( 'sidebar-9' ) )
		$count++;

	$class2 = '';

	switch ( $count ) {
		case '1':
			$class2 = 'expanded-one';
			break;
		case '2':
			$class2 = 'expanded-two';
			break;
		case '3':
			$class2 = 'expanded-three';
			break;
		case '4':
			$class2 = 'expanded-four';
			break;
	}

	if ( $class2 )
		echo 'class="' . $class2 . '"';
} ?>