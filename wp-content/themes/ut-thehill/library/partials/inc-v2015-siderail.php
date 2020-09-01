<div id="sidebar" class="">
	<header id="masthead" class="site-header" role="banner">
    <h3 class="killer-logo"><a href="https://www.utk.edu">The University of Tennessee, Knoxville</a></h3>
    <h2 class="sr-only"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h2>
    <button type="button" class="toggle close btn-findpage">
      <span class="sr-only">Toggle navigation</span> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M4 22h-4v-4h4v4zm0-12h-4v4h4v-4zm0-8h-4v4h4v-4zm3 0v4h17v-4h-17zm0 12h17v-4h-17v4zm0 8h17v-4h-17v4z"/></svg><br><?php _e( 'MENU', 'utthehill' ); ?>
    </button>
	</header><!-- #masthead -->
	<!-- #Find Box -->
  <div class="sidebar-offcanvas">
    <nav role="navigation" id="mainnav">
        <button type="button" class="toggle close collapseMenu">
          <span class="sr-only">Toggle navigation</span> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M24 20.188l-8.315-8.209 8.2-8.282-3.697-3.697-8.212 8.318-8.31-8.203-3.666 3.666 8.321 8.24-8.206 8.313 3.666 3.666 8.237-8.318 8.285 8.203z"/></svg> <span class="close"><?php _e( 'CLOSE', 'utthehill' ); ?></span>
        </button>

        <?php  get_template_part( 'library/partials/switch-menu' ); ?>
    </nav><!-- #site-navigation -->
  </div>
</div>