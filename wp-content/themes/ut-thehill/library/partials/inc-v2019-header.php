<?php 
  $meta_parentunit_show = get_theme_mod( 'meta_parentunit_show' );
  $meta_parentunit_name = get_theme_mod( 'meta_parentunit_name' );
  $meta_parentunit_link = get_theme_mod( 'meta_parentunit_link' );
  $meta_sitetitlesize = get_theme_mod( 'meta_sitetitlesize' );
?>
<header id="main-navigation" role="banner">
  <div class="container-columns">
      <h1 class="ut-title"><a class="killer-logo" href="http://www.utk.edu">The University of Tennessee, Knoxville</a></h1>



        <h2 class="site-title <?php if ($meta_parentunit_show=="show") { ?> parent-show<?php } ?><?php if ($meta_sitetitlesize=="small") { ?> site-header-shrink<?php } ?>"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
    <?php 
      if ($meta_parentunit_show=="show") { ?>
        <?php if ($meta_parentunit_link!="") { ?>
          <a href="<?php echo $meta_parentunit_link; ?>">
        <?php } ?>
          <br><small><?php echo $meta_parentunit_name; ?></small>
        <?php if ($meta_parentunit_link!="") { ?>
          </a>
        <?php } ?>
    <?php } ?>
        </h2>
        <button type="button" class="btn btn-findpage">
          <span class="sr-only">Toggle navigation</span> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M4 22h-4v-4h4v4zm0-12h-4v4h4v-4zm0-8h-4v4h4v-4zm3 0v4h17v-4h-17zm0 12h17v-4h-17v4zm0 8h17v-4h-17v4z"/></svg><br><?php _e( 'Menu', 'utthehill' ); ?>
        </button>
  </div>
</header>

  <?php if(esc_attr( get_post_meta( $post->ID, 'utk_fullwidth', true ) ) == true ) { ?><?php  get_template_part( 'library/partials/inc-v2019-featured' ); ?><?php } ?>
  <div id="page" class="hfeed site row-offcanvas">
    <div id="main" class="site-main">
   <?php if(esc_attr( get_post_meta( $post->ID, 'utk_fullwidth', true ) ) == false ) { ?><?php  get_template_part( 'library/partials/inc-v2019-featured' ); ?><?php } ?>


<div id="sidebar">
	<!-- #Find Box -->
   <div class="sidebar-offcanvas inactive">
        <nav role="navigation" id="mainnav">
    		      <button type="button" class="btn btn-findpage btn-close">
          <span class="sr-only">Toggle navigation</span> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M24 20.188l-8.315-8.209 8.2-8.282-3.697-3.697-8.212 8.318-8.31-8.203-3.666 3.666 8.321 8.24-8.206 8.313 3.666 3.666 8.237-8.318 8.285 8.203z"/></svg> <span class="close"><?php _e( 'CLOSE', 'utthehill' ); ?></span>
    		      </button>
          <?php  get_template_part( 'library/partials/switch-menu' ); ?>
    		</nav><!-- #site-navigation -->
    </div>
  </div>
