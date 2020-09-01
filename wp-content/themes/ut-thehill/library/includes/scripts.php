<?php


/**
 * Enqueue scripts and styles for the front end.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */


function utthehill_scripts_styles() {

    if( !is_admin()){
	    wp_deregister_script('jquery');
	    wp_register_script('jquery', ("//code.jquery.com/jquery-1.11.2.min.js"), array(), null, true);
	    wp_enqueue_script('jquery');
    }

	/*
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );




  // Scripts
  // =============================

  $sitemode = get_theme_mod( 'site_mode_layout' );
  if ($sitemode!="webapp") {
    // Loads UTK JavaScript with added object data fromthe WP table
    wp_register_script( 'utthehill-utk', get_template_directory_uri() . '/library/js/v2015.js', array( 'jquery' ), '2020-01-06', true );
  } else {
    // Loads UTK JavaScript with added object data fromthe WP table
    wp_register_script( 'utthehill-utk', get_template_directory_uri() . '/library/js/v2019.js', array( 'jquery' ), '2020-01-06', true );
	}

	// Setup some vars to pass to js
	$tempDirectory = get_template_directory_uri();
	global $blog_id;
	$siteId = $blog_id;
	$settings = get_option( 'ut_options');
	if (!isset($settings['nivo_anim_speed']) || $settings['nivo_anim_speed'] == '' ) { 
		$nivoAnimSpeed = '500';
	} else {
		$nivoAnimSpeed = $settings['nivo_anim_speed'];
	}
	if (!isset($settings['nivo_pause_time']) || $settings['nivo_pause_time'] == '' ) { 
		$nivoPauseTime = '3000';
	} else {
		$nivoPauseTime = $settings['nivo_pause_time'];
	}

//	$contentArray = generateJson();
	$translation_array = array( 'templateDirectory' => $tempDirectory, 'siteId' => $siteId,  'nivo_anim_speed' => $nivoAnimSpeed, 'nivo_pause_time' => $nivoPauseTime);
	wp_localize_script( 'utthehill-utk', 'url_object', $translation_array );

	// run it Lola
	wp_enqueue_script( 'utthehill-utk' );

  

	// Loads the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'utthehill-ie', get_template_directory_uri() . '/library/css/ie.css', array( 'utthehill-style' ), '2020-01-06' );
	wp_style_add_data( 'utthehill-ie', 'conditional', 'lt IE 9' );



  // Styles
  // =============================

  $sitemode = get_theme_mod( 'site_mode_layout' );
  if ($sitemode!="webapp") {
  	wp_enqueue_style( 'utthehill-style', get_template_directory_uri() . '/library/v2015.css', array(), '2020-01-06' );
  } else {
  	wp_enqueue_style( 'custom-style',    get_template_directory_uri() . '/library/v2019.css', array(), '2020-01-06' ); //our stylesheet
	}





}
add_action( 'wp_enqueue_scripts', 'utthehill_scripts_styles' );




/**
 * WP REST API register custom endpoints
 *
 * @since 1.0.0
 */
function ja_rest_api_register_routes() {
	register_rest_route( 'ja/v2', '/search', array(
		'methods'  => 'GET',
		'callback' => 'ja_rest_api_search',
	) );
}
add_action( 'rest_api_init', 'ja_rest_api_register_routes' );
/**
 * WP REST API search results.
 *
 * @since 1.0.0
 * @param object $request
 */
function ja_rest_api_search( $request ) {
	if ( empty( $request['term'] ) ) {
		return;
	}
	$results = new WP_Query( array(
//		'post_type'     => array( 'post', 'page' ),
		'post_status'   => 'publish',
		'posts_per_page'=> -1,
		's'             => $request['term'],
	) );
	if ( !empty( $results->posts ) ) {
		return $results->posts;
	} else {
		return $results->posts;
	}
}

?>