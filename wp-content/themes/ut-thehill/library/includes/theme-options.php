<?php
// Default options values
$ut_options = array(
	'parentunit_text' => '',
	'give_place_text' => '',
	'give_uri_text' => '',
	'type_style' => 'sans',
	'givingbar_status' => 'default',
	'layout_view' => 'white',
	'menu_layout' => 'multiple',
	'author_credits' => true,
	'published_date' => true,
	'homepage_head' => true,
	'nav_style' => 'dropnav',
	'home_button' => true,
	'nivo_anim_speed' => '500',
	'nivo_pause_time' => '3000',
);


if ( is_admin() ) : // Load only if we are viewing an admin page

function ut_register_settings() {
	// Register settings and call sanitation functions
	register_setting( 'ut_theme_options', 'ut_options', 'ut_validate_options' );
}

add_action( 'admin_init', 'ut_register_settings' );



// Store typestyle in array
$ut_categories = array(
	'serif' => array(
		'value' => 'serif',
		'label' => 'Serif'
	),
	'sans' => array(
		'value' => 'sans',
		'label' => 'Sans Serif'
	),
	'mixedserif' => array(
		'value' => 'mixedserif',
		'label' => 'Mixed Serif'
	),
);
// Store Giving Bar Status in array
$ut_givingbarstatus = array(
	'default' => array(
		'value' => 'default',
		'label' => 'Default Giving Link'
	),
	'nogive' => array(
		'value' => 'nogive',
		'label' => 'No Giving Link'
	),
	'custom' => array(
		'value' => 'custom',
		'label' => 'Custom Giving Link'
	),
);

// Store layouts views in array
$ut_layouts = array(
	'white' => array(
		'value' => 'white',
		'label' => 'Rock (Preferred)'
	),
	'orange' => array(
		'value' => 'orange',
		'label' => 'Big Orange'
	),
	'smokey' => array(
		'value' => 'smokey',
		'label' => 'Smokey'
	),
	'valley' => array(
		'value' => 'valley',
		'label' => 'Valley'
	),
	'fountain' => array(
		'value' => 'fountain',
		'label' => 'Fountain'
	),
/*
	'torch' => array(
		'value' => 'torch',
		'label' => 'Torch'
	),
*/
	'globe' => array(
		'value' => 'globe',
		'label' => 'Globe'
	),
	'limestone' => array(
		'value' => 'limestone',
		'label' => 'Limestone'
	),
/*
	'sunsphere' => array(
		'value' => 'sunsphere',
		'label' => 'Sunsphere'
	),
*/
	'river' => array(
		'value' => 'river',
		'label' => 'River'
	),
/*
	'leconte' => array(
		'value' => 'leconte',
		'label' => 'LeConte'
	),
*/
/*
	'rock' => array(
		'value' => 'rock',
		'label' => 'Rock'
	),
*/
	'regalia' => array(
		'value' => 'regalia',
		'label' => 'Regalia'
	),
	'summitt' => array(
		'value' => 'summitt',
		'label' => 'Summitt'
	),
	'legacy' => array(
		'value' => 'legacy',
		'label' => 'Legacy'
	),
	'buckskin' => array(
		'value' => 'buckskin',
		'label' => 'Buckskin'
	),
	'switchgrass' => array(
		'value' => 'switchgrass',
		'label' => 'Switchgrass'
	),
/*
	'eureka' => array(
		'value' => 'eureka',
		'label' => 'Eureka'
	),
*/
/*
	'energy' => array(
		'value' => 'energy',
		'label' => 'Energy'
	),
*/
);

// Store navstyle in array
$ut_navstyle = array(
	'dropdown' => array(
		'value' => 'dropnav',
		'label' => 'Sideways Drop Down'
	),
	'flyout' => array(
		'value' => 'flyout',
		'label' => 'Fly Out'
	),
);

// Create Menu Options
$ut_menuoptions = array(
	'single' => array(
		'value' => 'single',
		'label' => 'Single'
	),
	'multiple' => array(
		'value' => 'multiple',
		'label' => 'Multiple' 
	),

);



// Home Page Head Line Hide


function ut_theme_options() {
	// Add theme options page to the addmin menu
	add_theme_page( 'Theme Options', 'Theme Options', 'edit_theme_options', 'theme_options', 'ut_theme_options_page' );
}
// add_action( 'admin_menu', 'ut_theme_options' );











// Function to generate options page
function ut_theme_options_page() {
	global $ut_options, $ut_categories, $ut_layouts, $ut_navstyle, $ut_menuoptions, $ut_givingbarstatus;

	if ( ! isset( $_REQUEST['updated'] ) )
		$_REQUEST['updated'] = false; // This checks whether the form has just been submitted. ?>



	<div class="wrap">



	<?php screen_icon(); echo "<h2>" . wp_get_theme() . __( ' Theme Options' ) . "</h2>";
	// This shows the page's name and an icon if one has been provided ?>
<?php if ( false !== $_REQUEST['updated'] ) : ?>
	<div><p><strong><?php _e( 'Options saved' ); ?></strong></p></div>
	<?php endif; // If the form has just been submitted, this shows the notification ?>


  <hr>

<div class="clear"></div>
	<?php if ( false !== $_REQUEST['updated'] ) : ?>
	  <div class="updated fade"><p><strong><?php _e( 'Options saved' ); ?></strong></p></div>
	<?php endif; // If the form has just been submitted, this shows the notification ?>



	<form method="post" action="options.php">

	<?php $settings = get_option( 'ut_options', $ut_options ); ?>

	
	<?php settings_fields( 'ut_theme_options' );
	/* This function outputs some hidden fields required by the form,
	including a nonce, a unique number used to ensure the form has been submitted from the admin page
	and not somewhere else, very important for security */ ?>

    <div id="col-container">
      <div id="col-right">
        <div class="col-wrap">
          <h3>Theme Appearance Settings</h3>
          <h4>Make your site yours.</h4>
      		<table class="wp-list-table widefat fixed tags"><!-- Grab a hot cup of coffee, yes we're using tables! -->
          	<tr valign="top"><th scope="row">Color Preference</th>
            	<td>
              	<select id="layout_view" name="ut_options[layout_view]">
              	<?php
               	foreach ( $ut_layouts as $layout ) :
              		$label = $layout['label'];
              		$selected = '';
              		if ( $layout['value'] == $settings['layout_view'] )
              			$selected = 'selected="selected"';
              		echo '<option value="' . esc_attr( $layout['value'] ) . '" ' . $selected . '>' . $label . '</option>';
              	endforeach;
              
               ?>
              	</select>
            	</td>
          	</tr>
      
          	<tr valign="top"><th scope="row">Author Credits</th>
            	<td>
              	<input type="checkbox" id="author_credits" name="ut_options[author_credits]" value="<?php  echo($ut_options['author_credits']); ?>" <?php checked( true, $settings['author_credits'] ); ?> />
              	<label for="author_credits">Show Author Credits</label>
            	</td>
          	</tr>


          	<tr valign="top"><th scope="row">Published Date</th>
            	<td>
              	<input type="checkbox" id="published_date" name="ut_options[published_date]" value="<?php  echo($ut_options['published_date']); ?>" <?php checked( true, $settings['published_date'] ); ?> />
              	<label for="published_date">Show Published Date</label>
            	</td>
          	</tr>

          	<tr valign="top"><th scope="row">Headline on Homepage</th>
            	<td>
              	<input type="checkbox" id="homepage_head" name="ut_options[homepage_head]" value="<?php  echo($ut_options['homepage_head']); ?>" <?php checked( true, $settings['homepage_head'] ); ?> />
              	<label for="homepage_head">Show Headline on Home Page</label>
            	</td>
          	</tr>

          	<tr valign="top"><th scope="row"><label for="type_style">Type Style</label></th>
            	<td>
              	<select id="type_style" name="ut_options[type_style]">
              	<?php
              	foreach ( $ut_categories as $category ) :
              		$label = $category['label'];
              		$selected = '';
              		if ( $category['value'] == $settings['type_style'] )
              			$selected = 'selected="selected"';
              		echo '<option value="' . esc_attr( $category['value'] ) . '" ' . $selected . '>' . $label . '</option>';
              	endforeach;
              	?>
              	</select>
            	</td>
          	</tr>
        	</table>


        </div> <!-- close col-wrap -->
      </div> <!-- close col-right -->

      <div id="col-left">
        <div class="col-wrap">
          <h3>Theme Function Settings</h3>
          <h4>Get your site architecture and navigation set up.</h4>
          <table class="form-table"><!-- Grab a hot cup of coffee, yes we're using tables! -->
          
          	<tr valign="top"><th scope="row">Home button in menu</th>
              	<td>
                	<input type="checkbox" id="home_button" name="ut_options[home_button]" value="<?php  echo($ut_options['home_button']); ?>" <?php checked( true, $settings['home_button'] ); ?> />
                	<label for="home_button">Put a home button in the menu</label>
              	</td>
          	</tr>
          	<tr valign="top"><th scope="row"><label for="nav_style">Navigation Style</label></th>
            	<td>
              	<select id="nav_style" name="ut_options[nav_style]">
              	<?php
              	foreach ( $ut_navstyle as $navstyle ) :
              		$label = $navstyle['label'];
              		$selected = '';
              		if ( $navstyle['value'] == $settings['nav_style'] )
              			$selected = 'selected="selected"';
              		echo '<option value="' . esc_attr( $navstyle['value'] ) . '" ' . $selected . '>' . $label . '</option>';
              	endforeach;
              	?>
              	</select>
            	</td>
          	</tr>


            <tr valign="top"><th scope="row">Menu Options</th>
              	<td>
                	<?php foreach( $ut_menuoptions as $menu_option ) : ?>
                	<input type="radio" id="<?php echo $menu_option['value']; ?>" name="ut_options[menu_layout]" value="<?php esc_attr_e( $menu_option['value'] ); ?>" <?php checked( $settings['menu_layout'], $menu_option['value'] ); ?> />
                	<label for="<?php echo $menu_option['value']; ?>"><?php echo $menu_option['label']; ?></label><br />
                	<?php endforeach; ?>
              	</td>
            </tr>
            <tr valign="top">
              	<td colspan="2">
                	<p><em><strong>Please note</strong>: The single menu option is typically for sites with a shallow nav structure. Single menus are single tier and do not allow sublinks.</em></p>
                	<hr>
              	</td>
            </tr>
          </table>

  				<?php _e( '<h3 class="title">Nivo Gallery Settings</h3>', 'ut-thehill' ); ?>
  				<p><em>Speed is measured in milliseconds, ie 1000 == 1 second.</em></p>
          <table class="wp-list-table fixed tags">
            <tr>
              <td><?php  
	                _e( 'Animation Speed', 'ut-thehill' ); ?>
	                <input id="ut_options[nivo_anim_speed]" class="regular-text" type="number" name="ut_options[nivo_anim_speed]" value="<?php if($settings['nivo_anim_speed']) { esc_attr_e( $settings['nivo_anim_speed'] ); } else { esc_attr_e( $ut_options['nivo_anim_speed'] ); } ?>" />
                	<hr>
              	</td>
            </tr>
            <tr>
              <td><?php  
	                _e( 'Pause Time', 'ut-thehill' ); ?>
	                <input id="ut_options[nivo_pause_time]" class="regular-text" type="number" name="ut_options[nivo_pause_time]" value="<?php if($settings['nivo_pause_time']) { esc_attr_e( $settings['nivo_pause_time'] ); } else { esc_attr_e( $ut_options['nivo_pause_time'] ); } ?>" />
              	</td>
            </tr>
          </table>
          <br>
        	<hr>
        	<br>
      		<table class="wp-list-table widefat fixed tags">
          	<tr valign="top"><th scope="row"><h3>Giving Link</h3></th>
            	<td>
              	<select id="givingbar_status" name="ut_options[givingbar_status]">
              	<?php
               	foreach ( $ut_givingbarstatus as $layout ) :
              		$label = $layout['label'];
              		$selected = '';
              		if ( $layout['value'] == $settings['givingbar_status'] )
              			$selected = 'selected="selected"';
              		echo '<option value="' . esc_attr( $layout['value'] ) . '" ' . $selected . '>' . $label . '</option>';
              	endforeach;
              
               ?>
              	</select>
            	</td>
          	</tr>
            <tr>
              <th scope="row">
        				<?php // GIVING BAR
        				  _e( '<h3 class="title">Give To Place</h3>', 'ut-thehill' ); 
        				?>
               </th>
              <td>
                <?php  //Input for Giving Bar: recipient of gift & custom URL
                _e( 'Who are you giving to?', 'ut-thehill' ); ?>
                <input id="ut_options[give_place_text]" class="regular-text" type="text" name="ut_options[give_place_text]" value="<?php esc_attr_e( $settings['give_place_text'] ); ?>" />
              </td>
            </tr>
            <tr>
              <th scope="row">
        				<?php // GIVING BAR
        				  _e( '<h3 class="title">Give To Link</h3>', 'ut-thehill' ); 
        				?>
               </th>
              <td>
                <?php _e( 'Where is the link going?', 'ut-thehill' ); ?>
                <input id="ut_options[give_uri_text]" class="regular-text" type="text" name="ut_options[give_uri_text]" value="<?php esc_attr_e( $settings['give_uri_text'] ); ?>" />

  						<p><em>Please note: Some units may be interested in customizing the link to the giving website so that it will pre-populate gift designations. For inquiries regarding this process or general questions about online giving at UT, please contact the <a href="http://utfi.org">UT Foundation</a>.</em></p>
              </td>
            </tr>
          </table>

        </div> <!-- close col-wrap -->
      </div> <!-- close col-right -->


  </div> <!-- close col-container -->
	<p class="submit"><input type="submit" class="button-primary" value="Save Options" /></p>

	</form>
  <hr>
  <p>We strive to generate code that degrades gracefully and displays consistently on all modern browsers. Please notify us at <a href="mailto:webteam@utk.edu">webteam@utk.edu</a> if you notice an issue when viewing the templates on a certain device or browser. Be sure to note the device or platform (Mac or PC), browser, and browser version in your message.</p>

</div>

	<?php
}

function ut_validate_options( $input ) {
	global $ut_options, $ut_categories, $ut_layouts, $ut_menuoptions, $ut_givingbarstatus, $give_labels;

	$settings = get_option( 'ut_options', $ut_options );
	


	
	// We strip all tags from the text field, to avoid vulnerablilties like XSS
	$input['give_place_text'] = wp_filter_nohtml_kses( $input['give_place_text'] );
	$input['nivo_anim_speed'] = wp_filter_nohtml_kses( $input['nivo_anim_speed'] );
	$input['nivo_pause_time'] = wp_filter_nohtml_kses( $input['nivo_pause_time'] );

	
	// We strip all tags from the text field, to avoid vulnerablilties like XSS
	// $input['parentunit_text'] = wp_filter_nohtml_kses( $input['parentunit_text'] );

	// We strip all tags from the text field, to avoid vulnerablilties like XSS
  $input['give_uri_text'] = ( isset( $input['give_uri_text'] ) ? esc_url( $input['give_uri_text'] ) : '' );

	// We select the previous value of the field, to restore it in case an invalid entry has been given
	$prev = $settings['type_style'];
	// We verify if the given value exists in the categories array
	if ( !array_key_exists( $input['type_style'], $ut_categories ) )
		$input['type_style'] = $prev;

	// We select the previous value of the field, to restore it in case an invalid entry has been given
//	$prev = $settings['giving_link'];
	// We verify if the given value exists in the categories array
//	if ( !array_key_exists( $input['givingbar_status'], $ut_givingbarstatus ) )
//		$input['givingbar_status'] = $prev;
	
	// We select the previous value of the field, to restore it in case an invalid entry has been given
	$prev = $settings['layout_view'];
	// We verify if the given value exists in the layouts array
	if ( !array_key_exists( $input['layout_view'], $ut_layouts ) )
		$input['layout_view'] = $prev;

	// We verify if the given value exists in the menu array
	if ( !array_key_exists( $input['menu_layout'], $ut_menuoptions ) )
		$input['menu_layout'] = $prev;
	
	// If the checkbox has not been checked, we void it
	if ( ! isset( $input['author_credits'] ) )
		$input['author_credits'] = null;
	// We verify if the input is a boolean value
	$input['author_credits'] = ( $input['author_credits'] == 1 ? 1 : 0 );

	// If the date checkbox has not been checked, we void it
	if ( ! isset( $input['published_date'] ) )
		$input['published_date'] = null;
	// We verify if the input is a boolean value
	$input['published_date'] = ( $input['published_date'] == 1 ? 1 : 0 );

	// If the headline checkbox has not been checked, we void it
	if ( ! isset( $input['homepage_head'] ) )
		$input['homepage_head'] = null;
	// We verify if the input is a boolean value
	$input['homepage_head'] = ( $input['homepage_head'] == 1 ? 1 : 0 );

	// If the home button checkbox has not been checked, we void it
	if ( ! isset( $input['home_button'] ) )
		$input['home_button'] = null;
	// We verify if the input is a boolean value
	$input['home_button'] = ( $input['home_button'] == 1 ? 1 : 0 );
	
	return $input;
}

endif;  // EndIf is_admin()




/**
 * Extend the default WordPress body classes.
 *
 * Here we add classes to the body according to theme options settings for typography and color
 */
 

// function ut_options_orangeheader( $classes ) {
// 	// add 'class-name' to the $classes array
// 	$classes[] = 'orange';
// 	// return the $classes array
// 	return $classes;
// }
// function ut_options_smokeyheader( $classes ) {
// 	// add 'class-name' to the $classes array
// 	$classes[] = 'smokey';
// 	// return the $classes array
// 	return $classes;
// }
// function ut_options_valleyheader( $classes ) {
// 	// add 'class-name' to the $classes array
// 	$classes[] = 'valley';
// 	// return the $classes array
// 	return $classes;
// }
// function ut_options_torchheader( $classes ) {
// 	// add 'class-name' to the $classes array
// 	$classes[] = 'torch';
// 	// return the $classes array
// 	return $classes;
// }
// function ut_options_globeheader( $classes ) {
// 	// add 'class-name' to the $classes array
// 	$classes[] = 'globe';
// 	// return the $classes array
// 	return $classes;
// }
// function ut_options_limestoneheader( $classes ) {
// 	// add 'class-name' to the $classes array
// 	$classes[] = 'limestone';
// 	// return the $classes array
// 	return $classes;
// }
// function ut_options_sunsphereheader( $classes ) {
// 	// add 'class-name' to the $classes array
// 	$classes[] = 'sunsphere';
// 	// return the $classes array
// 	return $classes;
// }
// function ut_options_riverheader( $classes ) {
// 	// add 'class-name' to the $classes array
// 	$classes[] = 'river';
// 	// return the $classes array
// 	return $classes;
// }
// function ut_options_leconteheader( $classes ) {
// 	// add 'class-name' to the $classes array
// 	$classes[] = 'leconte';
// 	// return the $classes array
// 	return $classes;
// }
// function ut_options_rockheader( $classes ) {
// 	// add 'class-name' to the $classes array
// 	$classes[] = 'rock';
// 	// return the $classes array
// 	return $classes;
// }
// function ut_options_regaliaheader( $classes ) {
// 	// add 'class-name' to the $classes array
// 	$classes[] = 'regalia';
// 	// return the $classes array
// 	return $classes;
// }
// function ut_options_summittheader( $classes ) {
// 	// add 'class-name' to the $classes array
// 	$classes[] = 'summitt';
// 	// return the $classes array
// 	return $classes;
// }
// function ut_options_fountainheader( $classes ) {
// 	// add 'class-name' to the $classes array
// 	$classes[] = 'fountain';
// 	// return the $classes array
// 	return $classes;
// }
// function ut_options_legacyheader( $classes ) {
// 	// add 'class-name' to the $classes array
// 	$classes[] = 'legacy';
// 	// return the $classes array
// 	return $classes;
// }
// function ut_options_buckskinheader( $classes ) {
// 	// add 'class-name' to the $classes array
// 	$classes[] = 'buckskin';
// 	// return the $classes array
// 	return $classes;
// }
// function ut_options_switchgrassheader( $classes ) {
// 	// add 'class-name' to the $classes array
// 	$classes[] = 'switchgrass';
// 	// return the $classes array
// 	return $classes;
// }
// function ut_options_eurekaheader( $classes ) {
// 	// add 'class-name' to the $classes array
// 	$classes[] = 'eureka';
// 	// return the $classes array
// 	return $classes;
// }
// function ut_options_energyheader( $classes ) {
// 	// add 'class-name' to the $classes array
// 	$classes[] = 'energy';
// 	// return the $classes array
// 	return $classes;
// }
// function ut_options_seriftype( $classes ) {
// 	// add 'class-name' to the $classes array
// 	$classes[] = 'serif';
// 	// return the $classes array
// 	return $classes;
// }
// function ut_options_mixedserif( $classes ) {
// 	// add 'class-name' to the $classes array
// 	$classes[] = 'mixedserif';
// 	// return the $classes array
// 	return $classes;
// }
// function ut_options_flynavstyle( $classes ) {
// 	// add 'class-name' to the $classes array
// 	$classes[] = 'flyout';
// 	// return the $classes array
// 	return $classes;
// }
// function ut_options_dropnavstyle( $classes ) {
// 	// add 'class-name' to the $classes array
// 	$classes[] = 'dropnav';
// 	// return the $classes array
// 	return $classes;
// }
// 
// 
// function ut_layout_view() {
// 	global $ut_options;
// 	$settings = get_option( 'ut_options', $ut_options );
// 
// 	if(isset($settings['layout_view']) &&  $settings['layout_view'] == 'smokey' ) : 
//     add_filter( 'body_class', 'ut_options_smokeyheader' );
//    endif;
// 	if(isset($settings['layout_view']) &&  $settings['layout_view'] == 'orange' ) : 
//     add_filter( 'body_class', 'ut_options_orangeheader' );
//    endif;
// 	if(isset($settings['type_style']) &&  $settings['type_style'] == 'serif' ) : 
//     add_filter( 'body_class', 'ut_options_seriftype' );
//    endif;
// 	if(isset($settings['type_style']) &&  $settings['type_style'] == 'mixedserif' ) : 
//     add_filter( 'body_class', 'ut_options_mixedserif' );
//    endif;
//   if(isset($settings['nav_style']) && $settings['nav_style'] == 'flyout' ) : 
// 	  add_filter( 'body_class', 'ut_options_flynavstyle' );
//   endif;
// 	if(isset($settings['nav_style']) && $settings['nav_style'] == 'dropnav' ) : 
//     add_filter( 'body_class', 'ut_options_dropnavstyle' );
//    endif;
// 	if(isset($settings['layout_view']) &&  $settings['layout_view'] == 'valley' ) : 
//     add_filter( 'body_class', 'ut_options_valleyheader' );
//    endif;
// 	if(isset($settings['layout_view']) &&  $settings['layout_view'] == 'torch' ) : 
//     add_filter( 'body_class', 'ut_options_torchheader' );
//    endif;
// 	if(isset($settings['layout_view']) &&  $settings['layout_view'] == 'globe' ) : 
//     add_filter( 'body_class', 'ut_options_globeheader' );
//    endif;
// 	if(isset($settings['layout_view']) &&  $settings['layout_view'] == 'limestone' ) : 
//     add_filter( 'body_class', 'ut_options_limestoneheader' );
//    endif;
// 	if(isset($settings['layout_view']) &&  $settings['layout_view'] == 'sunsphere' ) : 
//     add_filter( 'body_class', 'ut_options_sunsphereheader' );
//    endif;
// 	if(isset($settings['layout_view']) &&  $settings['layout_view'] == 'river' ) : 
//     add_filter( 'body_class', 'ut_options_riverheader' );
//    endif;
// 	if(isset($settings['layout_view']) &&  $settings['layout_view'] == 'leconte' ) : 
//     add_filter( 'body_class', 'ut_options_leconteheader' );
//    endif;
// 	if(isset($settings['layout_view']) &&  $settings['layout_view'] == 'rock' ) : 
//     add_filter( 'body_class', 'ut_options_rockheader' );
//    endif;
// 	if(isset($settings['layout_view']) &&  $settings['layout_view'] == 'regalia' ) : 
//     add_filter( 'body_class', 'ut_options_regaliaheader' );
//    endif;
// 	if(isset($settings['layout_view']) &&  $settings['layout_view'] == 'summitt' ) : 
//     add_filter( 'body_class', 'ut_options_summittheader' );
//    endif;
// 	if(isset($settings['layout_view']) &&  $settings['layout_view'] == 'fountain' ) : 
//     add_filter( 'body_class', 'ut_options_fountainheader' );
//    endif;
// 	if(isset($settings['layout_view']) &&  $settings['layout_view'] == 'legacy' ) : 
//     add_filter( 'body_class', 'ut_options_legacyheader' );
//    endif;
// 	if(isset($settings['layout_view']) &&  $settings['layout_view'] == 'buckskin' ) : 
//     add_filter( 'body_class', 'ut_options_buckskinheader' );
//    endif;
// 	if(isset($settings['layout_view']) &&  $settings['layout_view'] == 'switchgrass' ) : 
//     add_filter( 'body_class', 'ut_options_switchgrassheader' );
//    endif;
// 	if(isset($settings['layout_view']) &&  $settings['layout_view'] == 'eureka' ) : 
//     add_filter( 'body_class', 'ut_options_eurekaheader' );
//    endif;
// 	if(isset($settings['layout_view']) &&  $settings['layout_view'] == 'energy' ) : 
//     add_filter( 'body_class', 'ut_options_energyheader' );
//    endif;
// 
// }
// 
// add_action( 'wp_head', 'ut_layout_view' );
// 

function ut_body_class_type($classes) {
    $veria        = get_theme_mod( 'brand_type' );
    $classes[] = $veria;
    return $classes;
}

add_filter('body_class', 'ut_body_class_type');

function ut_body_class_color($classes) {
    $veria        = get_theme_mod( 'brand_color' );
    $classes[] = $veria;
    return $classes;
}
add_filter('body_class', 'ut_body_class_color');

// Add back in when we do the alternative headline styles
 function ut_body_class_gotham($classes) {
     $veria        = get_theme_mod( 'brand_gotham' );
     $classes[] = $veria;
     return $classes;
 }
 add_filter('body_class', 'ut_body_class_gotham');

function ut_body_class_menustyle($classes) {
    $veria        = get_theme_mod( 'navigation_style' );
    if ($veria == 'sideways') {
      $veria = 'dropnav';
    }
    $classes[] = $veria;
    return $classes;
}
add_filter('body_class', 'ut_body_class_menustyle');


/*******************************************************************************
 add class to body if backgrounds turned on using the body_class filter
 ********************************************************************************/
function ut_site_mode( $classes ) {
 
    // set the header background
    $sitemode = get_theme_mod( 'site_mode_layout' );
    $classes[] = $sitemode;

     
    return $classes;
     
}
add_filter('body_class', 'ut_site_mode');