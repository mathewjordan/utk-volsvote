<?php
  // Do we have Soliloquy turned on? AND do we have an ID entered.
  $post_id = get_the_ID();
//  if ( class_exists( 'Soliloquy' ) && !empty( $post_id != "")) {
  ///if ( class_exists( 'Soliloquy' )) {
  if ( class_exists( 'Soliloquy' ) && ( $post_id != "")) {
?>
	<div class="entry-thumbnail-slider">
    <?php
      $post_class = get_post_meta( $post_id, 'utk_post_class', true );
      if ( !empty( $post_class ) )
      echo do_shortcode( '[soliloquy id="' . $post_class . '"]' ); 
    ?>
	</div>
<?php        
  }
?>