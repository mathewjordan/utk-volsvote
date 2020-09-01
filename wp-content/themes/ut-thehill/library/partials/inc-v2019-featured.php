<?php
if ( is_front_page() && is_home() ) {
  // Default homepage
  $pagetype = "default";
} elseif ( is_front_page() ) {
  // static homepage
  $pagetype = "homepage";
}  elseif ( is_home() || is_post_type_archive() || is_archive() || is_search()) {
  // blog page
  $pagetype = "archive";
} else {
  //everything else
  $pagetype = "other";
}




  $sitemode = get_theme_mod( 'site_mode_layout' );
  if(has_post_thumbnail() && ($sitemode=="webapp") && ($pagetype!="archive") ): ?>
    <div class="entry-thumbnail entry-thumbnail-webapp">
    	<?php the_post_thumbnail("full"); ?>
    </div>
<?php endif ?>
<?php
  if($sitemode=="webapp"): ?>
  <?php  get_template_part( 'library/partials/inc-soliloquy-featured' ); ?>
<?php endif ?>

