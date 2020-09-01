<?php 
  $menu_homebutton     = get_theme_mod( 'menu_homebutton' );
  $menu_givingoption   = get_theme_mod( 'menu_givingoption' );
  $menu_giveto         = get_theme_mod( 'menu_giveto' );
  $menu_givelink       = get_theme_mod( 'menu_givelink' );
  $menu_mobile_options = get_theme_mod( 'menu_mobile_options' );
?>

<div id="bellows"<?php if ( has_nav_menu( 'single-menu' ) ) {  ?><?php   }; ?><?php if ($menu_mobile_options!="flatlist") {  ?> class="mobile-collapsing"<?php   } else {?>  class="mobile-flat"<?php };?>>



<?php if ( has_nav_menu( 'single-menu' ) ) {  ?>
  <ul class="menu">
  <?php // Is "home button" desired in the theme options. This is sorta reversed so that the default is right.
   if ($menu_homebutton != 1) { } else {?> 
      <li>
        <a id="drop2" class="home_button" href="<?php echo esc_url( home_url( '/' ) ); ?>"  role="button"  >Home <span class="icon-fa-home pull-right"></span></a>
      </li>
  <?php 
    
  }
      wp_nav_menu( array(
        'theme_location' => 'single-menu',
        ) );
   }; ?>

              <?php

           if ($menu_givingoption=="giving-custom") { ?> 

                <li id="giving" class="dropdown top-menu-item">
                  <a href="<?php echo $menu_givelink; ?>">Give to <?php echo $menu_giveto; ?><i class="icon-fa-gift pull-right"></i></a>
                </li>
            <?php } else if ($menu_givingoption=="giving-no"){ ?>
            <?php } else { ?>

                <li id="giving" class="dropdown top-menu-item">
                  <a href="http://giveto.utk.edu">Give to UT <i class="icon-fa-gift fa-lg pull-right"></i></a>
                </li>


              <?php
              }
        ?>


  </ul>
</div>

