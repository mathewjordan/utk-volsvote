<?php

/* Fire our meta box setup function on the post editor screen. */
add_action( 'load-page.php', 'utk_post_meta_boxes_setup' );
add_action( 'load-page-new.php', 'utk_post_meta_boxes_setup' );

/* Meta box setup function. */
function utk_post_meta_boxes_setup() {

  /* Add meta boxes on the 'add_meta_boxes' hook. */
  add_action( 'add_meta_boxes', 'utk_featured_slider_meta_boxes' );

  /* Save post meta on the 'save_post' hook. */
  add_action( 'save_post', 'utk_save_post_class_meta', 10, 2 );


}
  //plugin is activated

/* Create one or more meta boxes to be displayed on the post editor screen. */
function utk_featured_slider_meta_boxes() {
if ( is_plugin_active( 'soliloquy/soliloquy.php' ) ) {

  add_meta_box(
    'utk-post-class',      // Unique ID
    esc_html__( 'Featured slider ID', 'utk-featuredSliderID' ),    // Title
    'utk_post_class_meta_box',   // Callback function
    'page',         // Admin page (or post type)
    'side',         // Context
    'default'         // Priority
  );
}
} 

  
  


/* Display the post meta box. */
function utk_post_class_meta_box( $post ) { ?>

  <?php wp_nonce_field( basename( __FILE__ ), 'utk_post_class_nonce' ); ?>

  <p>
    <label for="utk-post-class"><?php _e( "Choose a slider you’d like to appear featured and enter its ID here.", 'utk-featuredSliderID' ); ?></label>
    <br />
    <input class="widefat" type="text" name="utk-post-class" id="utk-post-class" value="<?php echo esc_attr( get_post_meta( $post->ID, 'utk_post_class', true ) ); ?>" size="30" />
  </p>
<?php }



/* Save the meta box's post metadata. */
function utk_save_post_class_meta( $post_id, $post ) {

  /* Verify the nonce before proceeding. */
  if ( !isset( $_POST['utk_post_class_nonce'] ) || !wp_verify_nonce( $_POST['utk_post_class_nonce'], basename( __FILE__ ) ) )
    return $post_id;

  /* Get the post type object. */
  $post_type = get_post_type_object( $post->post_type );

  /* Check if the current user has permission to edit the post. */
  if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
    return $post_id;

  /* Get the posted data and sanitize it for use as an HTML class. */
  $new_meta_value = ( isset( $_POST['utk-post-class'] ) ? sanitize_html_class( $_POST['utk-post-class'] ) : '' );

  /* Get the meta key. */
  $meta_key = 'utk_post_class';

  /* Get the meta value of the custom field key. */
  $meta_value = get_post_meta( $post_id, $meta_key, true );

  /* If a new meta value was added and there was no previous value, add it. */
  if ( $new_meta_value && '' == $meta_value )
    add_post_meta( $post_id, $meta_key, $new_meta_value, true );

  /* If the new meta value does not match the old value, update it. */
  elseif ( $new_meta_value && $new_meta_value != $meta_value )
    update_post_meta( $post_id, $meta_key, $new_meta_value );

  /* If there is no new meta value but an old value exists, delete it. */
  elseif ( '' == $new_meta_value && $meta_value )
    delete_post_meta( $post_id, $meta_key, $meta_value );
}