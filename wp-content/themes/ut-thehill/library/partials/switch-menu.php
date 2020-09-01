<?php

  $search_style  = get_theme_mod( 'search_style' );
  if ( $search_style == "search_find_a_page") { ?>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <form   role="search" method="get"  id="remote" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    	<div class="form-group">
        <div>
          <input class="typeahead form-control " type="text" placeholder="Find a Page"  name="s" role="search" aria-label="Site Search">
        </div> 
    	</div>
      <input type="submit" name="btnF" class="sr-only"  value="Go">
    </form>

  <?php } elseif ( $search_style == "search_google")  { ?>

  <form  name="utk_seek_site" method="post" accept-charset="iso-8859-1" action="//www.utk.edu/masthead/query.php">
    <div class="form-group">
      <input type="text" name="qt"  class="searchtext form-control"   onfocus="if(this.value == 'Search <?php bloginfo( 'name' ); ?>') { this.value = ''; }" placeholder="Search Site" title="search">
      <input type="hidden" name="qtype" value="site_utk:<?php echo esc_url( home_url( '/' ) ); ?>">
      <input type="hidden" name="col" value="utk">
      <input name="go" type="submit" title="Submit" class="btn btn-orange sr-only"  value="Go">
    </div>
  </form>



  <?php } elseif ( $search_style == "search_wp")  { ?>

    <?php get_search_form(); ?>

  <?php } elseif ( $search_style == "search_no")  { ?>

   

  <?php } else { ?>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <form   role="search" method="get"  id="remote" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    	<div class="form-group">
        <div>
          <input class="typeahead form-control " type="text" placeholder="Find a Page"  name="s" role="search" aria-label="Site Search">
        </div>
    	</div>
      <input type="submit" name="btnF" class="sr-only"  value="Go">
    </form>

  <?php }  ?>



<?php
  $sitemode =           get_theme_mod( 'site_mode_layout' );
  $menu_homebutton    = get_theme_mod( 'menu_homebutton' );
  $menu_givingoption  = get_theme_mod( 'menu_givingoption' );
  $menu_giveto        = get_theme_mod( 'menu_giveto' );
  $menu_givelink      = get_theme_mod( 'menu_givelink' );
  $menu_style         = get_theme_mod( 'menu_options' );


  if ( $menu_style != "multiple") {
    get_template_part( 'library/partials/menu-single' );
  } else {
    get_template_part( 'library/partials/menu-multiple' );
  }  ?>