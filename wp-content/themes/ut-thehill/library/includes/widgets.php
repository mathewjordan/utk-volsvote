<?php



//===================================================================================================================
// The University of Tennessee Custom Widgets
//===================================================================================================================

// Create custom Highlight box widget
// --------------------------------------------------
class UT_Highlight extends WP_Widget {

	function __construct() {
		parent::__construct(
		// Base ID of your widget
		'UT_Highlight', 

		// Widget name will appear in UI
		__('UT Highlight Box', 'UT_Highlight'), 

		// Widget description
		array( 'description' => __( 'A highlight box for text, HTML, PHP, Javascript, and shortcodes', 'UT_Highlight' ), ) 
		);
	}
	
	
	
	public function widget( $args, $instance ) {

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		/**
		 * Filter the content of the Text widget.
		 *
		 * @since 2.3.0
		 *
		 * @param string    $widget_text The widget content.
		 * @param WP_Widget $instance    WP_Widget instance.
		 */
		$text = apply_filters( 'widget_text', empty( $instance['text'] ) ? '' : $instance['text'], $instance );

			        $text = do_shortcode($text);

		$background = $instance['background'];

		echo $args['before_widget'];

		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		} 
		echo    "<div class='box-light widget ".$background."'>"."\n";
    echo    '<aside   class="widget">';
		?>
		
			<?php echo !empty( $instance['filter'] ) ? wpautop( $text ) : $text; ?></aside></div>
		<?php
		echo $args['after_widget'];
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
			$instance['background'] = $new_instance['background'];
		if ( current_user_can('unfiltered_html') )
			$instance['text'] =  $new_instance['text'];
		else
			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) ); // wp_filter_post_kses() expects slashed
		$instance['filter'] = ! empty( $new_instance['filter'] );
		$instance['background'] = $new_instance['background'];
		return $instance;
	}

	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '', 'background' => '' ) );
		$title = strip_tags($instance['title']);
		$text = esc_textarea($instance['text']);
    $background = $instance['background'];
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Highlight Box:'); ?></label></p>

		<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>
			<select id="<?php echo $this->get_field_id('background');?>" name="<?php echo $this->get_field_name('background');?>" >
        <option <?php if ( 'white' == $instance['background'] ) echo ' selected'; ?> value="white">Default (White)</option>
        <option <?php if ( 'smokey' == $instance['background'] ) echo ' selected'; ?> value="smokey">Smokey</option>
        <option <?php if ( 'orange' == $instance['background'] ) echo ' selected'; ?> value="orange">Orange</option>
        <option <?php if ( 'limestone' == $instance['background'] ) echo ' selected'; ?> value="limestone">Limestone</option>
        <option <?php if ( 'torch' == $instance['background'] ) echo ' selected'; ?> value="torch">Torch</option>
        <option <?php if ( 'river' == $instance['background'] ) echo ' selected'; ?> value="river">River</option>
        <option <?php if ( 'rock' == $instance['background'] ) echo ' selected'; ?> value="rock">Rock</option>
        <option <?php if ( 'eureka' == $instance['background'] ) echo ' selected'; ?> value="eureka">Eureka</option>
        <option <?php if ( 'fountain' == $instance['background'] ) echo ' selected'; ?> value="fountain">Fountain</option>
        <option <?php if ( 'switchgrass' == $instance['background'] ) echo ' selected'; ?> value="switchgrass">Switchgrass</option>
        <option <?php if ( 'valley' == $instance['background'] ) echo ' selected'; ?> value="valley">Valley</option>
        <option <?php if ( 'leconte' == $instance['background'] ) echo ' selected'; ?> value="leconte">Leconte</option>
        <option <?php if ( 'summitt' == $instance['background'] ) echo ' selected'; ?> value="summitt">Summitt</option>
        <option <?php if ( 'globe' == $instance['background'] ) echo ' selected'; ?> value="globe">Globe</option>
        <option <?php if ( 'sunsphere' == $instance['background'] ) echo ' selected'; ?> value="sunsphere">Sunsphere</option>
        <option <?php if ( 'leconte' == $instance['background'] ) echo ' selected'; ?> value="leconte">Leconte</option>
        <option <?php if ( 'regalia' == $instance['background'] ) echo ' selected'; ?> value="regalia">Regalia</option>
        <option <?php if ( 'legacy' == $instance['background'] ) echo ' selected'; ?> value="legacy">Legacy</option>
        <option <?php if ( 'buckskin' == $instance['background'] ) echo ' selected'; ?> value="buckskin">Buckskin</option>
        <option <?php if ( 'energy' == $instance['background'] ) echo ' selected'; ?> value="energy">Energy</option>
			</select>
		<p><input id="<?php echo $this->get_field_id('filter'); ?>" name="<?php echo $this->get_field_name('filter'); ?>" type="checkbox" <?php checked(isset($instance['filter']) ? $instance['filter'] : 0); ?> />&nbsp;<label for="<?php echo $this->get_field_id('filter'); ?>"><?php _e('Automatically add paragraphs'); ?></label></p>



<?php
	}
}

register_widget('UT_Highlight'); 


  

// Unregister a few of the default WP Widgets
// --------------------------------------------------

function unregister_default_wp_widgets() {
    unregister_widget('WP_Widget_Meta');
  //  unregister_widget('WP_Widget_Search');
    unregister_widget('WP_Widget_Calendar');
}
add_action('widgets_init', 'unregister_default_wp_widgets', 1);

// Create custom Dashboard Widget
// --------------------------------------------------

// function ut_dashboard_widget() {
// 	require_once ( get_template_directory() . '/library/includes/widget-themeupdates.php' );
// } 
// 
// 
// 
// // Create the function use in the action hook
// // --------------------------------------------------
// 
// function add_dashboard_utwidget() {
// 	wp_add_dashboard_widget('ut-theme-update-widget', 'UT WordPress Theme Updates', 'ut_dashboard_widget');	
// 	global $wp_meta_boxes;
// 	
// 	// Get the regular dashboard widgets array 
// 	// (which has our new widget already but at the end)
// 
// 	$normal_dashboard = $wp_meta_boxes['dashboard']['normal']['core'];
// 	
// 	// Backup and delete our new dashbaord widget from the end of the array
// 
// 	$widget_backup = array('ut-theme-update-widget' => $normal_dashboard['ut-theme-update-widget']);
// 	unset($normal_dashboard['ut-theme-update-widget']);
// 
// 	// Merge the two arrays together so our widget is at the beginning
// 
// 	$sorted_dashboard = array_merge($widget_backup, $normal_dashboard);
// 
// 	// Save the sorted array back into the original metaboxes 
// 
// 	$wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;
// } 
// 
// // Hook into the 'wp_dashboard_setup' action to register our other functions
// 
// add_action('wp_dashboard_setup', 'add_dashboard_utwidget' );

?>