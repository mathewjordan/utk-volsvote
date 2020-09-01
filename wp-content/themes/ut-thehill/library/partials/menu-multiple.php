<?php 
  $menu_homebutton    = get_theme_mod( 'menu_homebutton' );
  $menu_givingoption  = get_theme_mod( 'menu_givingoption' );
  $menu_giveto        = get_theme_mod( 'menu_giveto' );
  $menu_givelink      = get_theme_mod( 'menu_givelink' );
?>

<div id="megamenu"<?php if ( has_nav_menu( 'single-menu' ) ) { echo '" class="singlemenu"'; }?>>
      <ul class="mainnav">
      <?php /*
      Our navigation menu.  If one isn't filled out, wp_nav_menu falls
      back to wp_page_menu.  The menu assigned to the primary position is
      the one used.  If none is assigned, the menu with the lowest ID is
      used. 

      CE: There is a toggle for a single menu or multiple menus. 
      Single menus are single tier and do not allow sublinks. This is typically for sites with a shallow  nav structure. 
      */

      if ( has_nav_menu( 'single-menu' ) ): ?>



         <?php 
           // Is "home button" desired in the theme options
           
           if ($menu_homebutton == 1) { ?> 
                <li class="home_button"><a  href="<?php echo esc_url( home_url( '/' ) ); ?>">Home <span class="icon-fa-home pull-right"></span></a></li>
          <?php }    ?>

                <?php
                  wp_nav_menu( array(
                    'container' => '',
                    'items_wrap'=>'%3$s',
                    'depth'           => 1,
                    'theme_location' => 'single-menu',
                    ) );
                ?>
      <?php else:


           // Is "home button" desired in the theme options
           if ($menu_homebutton == 1) { ?> 
                <li class="home_button"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home <i class="icon-fa-home pull-right"></i></a></li>
          <?php }   


         // If there is a menu-one, then show it.

        if ( has_nav_menu( 'menu-one' ) ) { ?>


<li class="dropdown top-menu-item">
  <button class="dropdown-toggle" id="menu-one" data-toggle="dropdown"  aria-haspopup="true" aria-expanded="false">
     <?php echo gm_get_theme_menu_name('menu-one'); ?><i class="icon-fa-chevron-right pull-right"></i>
  </button>

  <div class="dropdown-menu megamenu-sub" aria-labelledby="menu-one">
    <button class="menu-back btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icon-fa-chevron-left"></i><span class="back">Back</span></button>
    <h3><?php echo gm_get_theme_menu_name('menu-one'); ?> </h3>
      <div class="inner">
        <?php
          wp_nav_menu( array( 'container_class' => 'menu-header','theme_location' => 'menu-one',  "walker" => new ut_add_aria_to_menu(), ) ); 
        ?>
      </div>
  </div>
</li>
        <?php }; 
               
        // If there is a menu-two, then show it.
        if ( has_nav_menu( 'menu-two' ) ) { ?>
<li class="dropdown top-menu-item">
  <button class="dropdown-toggle" id="menu-two" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
    <?php echo gm_get_theme_menu_name('menu-two'); ?> <i class="icon-fa-chevron-right pull-right"></i>
  </button>

  <div class="dropdown-menu megamenu-sub" aria-labelledby="menu-two">
    <button  class="menu-back btn" data-toggle="dropdown" role="button" ><i class="icon-fa-chevron-left"></i> <span class="back">Back</span></button>
    <h3><?php echo gm_get_theme_menu_name('menu-two'); ?> </h3>
    <div class="inner">
      <?php
        wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'menu-two',  "walker" => new ut_add_aria_to_menu(), ) ); 
      ?>
   </div>
  </div>
</li>
        <?php }; 
          
        // If there is a menu-three, then show it.
        if ( has_nav_menu( 'menu-three' ) ) { ?>

<li class="dropdown top-menu-item">
  <button class="dropdown-toggle" id="menu-three" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
    <?php echo gm_get_theme_menu_name('menu-three'); ?> <i class="icon-fa-chevron-right pull-right"></i>
  </button>

  <div class="dropdown-menu megamenu-sub" aria-labelledby="menu-three">
        <button class="menu-back btn"  data-toggle="dropdown" aria-haspopup="true" role="button"><i class="icon-fa-chevron-left"></i> <span class="back">Back</span></button>
        <h3><?php echo gm_get_theme_menu_name('menu-three'); ?> </h3>
        <div class="inner">
          <?php
            wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'menu-three',  "walker" => new ut_add_aria_to_menu(), ) ); 
          ?>
        </div>
      </div>
</li>
        <?php };
        
        // If there is a menu-four, then show it.
        if ( has_nav_menu( 'menu-four' ) ) { ?>
<li class="dropdown top-menu-item">
  <button class="dropdown-toggle" id="menu-four" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
    <?php echo gm_get_theme_menu_name('menu-four'); ?> <i class="icon-fa-chevron-right pull-right"></i>
  </button>
  <div class="dropdown-menu megamenu-sub" aria-labelledby="menu-four">
    <button  class="menu-back btn"  data-toggle="dropdown" role="button"><i class="icon-fa-chevron-left"></i> <span class="back">Back</span></button>
    <h3><?php echo gm_get_theme_menu_name('menu-four'); ?> </h3>
    <div class="inner">
      <?php
        wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'menu-four',  "walker" => new ut_add_aria_to_menu(), ) ); 
      ?>
    </div>
  </div>
</li>

        <?php }; 
        
        // If there is a menu-five, then show it.
        if ( has_nav_menu( 'menu-five' ) ) { ?>
<li class="dropdown top-menu-item">
  <button class="dropdown-toggle" id="menu-five" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
    <?php echo gm_get_theme_menu_name('menu-five'); ?> <i class="icon-fa-chevron-right pull-right"></i>
  </button>
  <div class="dropdown-menu megamenu-sub" aria-labelledby="menu-five">
    <button  class="menu-back btn"  data-toggle="dropdown" role="button"><i class="icon-fa-chevron-left"></i> <span class="back">Back</span></button>
    <h3><?php echo gm_get_theme_menu_name('menu-five'); ?> </h3>
    <div class="inner">
      <?php
      wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'menu-five',  "walker" => new ut_add_aria_to_menu(), ) ); 
      ?>
    </div>
  </div>
</li>
         <?php }; 
         
    
        // If there is a menu-six, then show it.
        if ( has_nav_menu( 'menu-six' ) ) { ?>
<li class="dropdown top-menu-item">
  <button class="dropdown-toggle" id="menu-six" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <?php echo gm_get_theme_menu_name('menu-six'); ?> <i class="icon-fa-chevron-right pull-right"></i>
  </button>
  <div class="dropdown-menu megamenu-sub" aria-labelledby="menu-six">
    <button class="menu-back btn"   data-toggle="dropdown"><i class="icon-fa-chevron-left"></i> <span class="back">Back</span></button>
    <h3><?php echo gm_get_theme_menu_name('menu-six'); ?> </h3>
    <div class="inner">
      <?php
      wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'menu-six',  "walker" => new ut_add_aria_to_menu(), ) ); 
      ?>
    </div>
  </div>
</li>
        <?php }; 
      
    
        // If there is a menu-seven, then show it.
        if ( has_nav_menu( 'menu-seven' ) ) { ?>

<li class="dropdown top-menu-item">
  <button class="dropdown-toggle" id="menu-seven" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <?php echo gm_get_theme_menu_name('menu-seven'); ?> <i class="icon-fa-chevron-right pull-right"></i>
  </button>
  <div class="dropdown-menu megamenu-sub" aria-labelledby="menu-seven">
    <button  class="menu-back btn"  data-toggle="dropdown"  role="button"><i class="icon-fa-chevron-left"></i> <span class="back">Back</span></button>
    <h3><?php echo gm_get_theme_menu_name('menu-seven'); ?> </h3>
    <div class="inner">
      <?php
        wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'menu-seven',  "walker" => new ut_add_aria_to_menu(), ) ); 
      ?>
    </div>
  </div>
</li>
        <?php }; 
        // If there is a menu-eight, then show it.
        if ( has_nav_menu( 'menu-eight' ) ) { ?>
<li class="dropdown top-menu-item">
  <button class="dropdown-toggle" id="menu-eight" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <?php echo gm_get_theme_menu_name('menu-eight'); ?> <i class="icon-fa-chevron-right pull-right"></i>
  </button>
  <div class="dropdown-menu megamenu-sub" aria-labelledby="menu-eight">
    <button  class="menu-back btn"  data-toggle="dropdown" role="button"><i class="icon-fa-chevron-left"></i> <span class="back">Back</span></button>
    <h3><?php echo gm_get_theme_menu_name('menu-eight'); ?> </h3>
    <div class="inner">
      <?php
      wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'menu-eight',  "walker" => new ut_add_aria_to_menu(), ) ); 
      ?>
    </div>
  </div>
</li>
        <?php }; 
        // If there is a menu-nine, then show it.
        if ( has_nav_menu( 'menu-nine' ) ) { ?>
<li class="dropdown top-menu-item">
  <button class="dropdown-toggle" id="menu-nine" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <?php echo gm_get_theme_menu_name('menu-nine'); ?> <i class="icon-fa-chevron-right pull-right"></i>
  </button>
  <div class="dropdown-menu megamenu-sub" aria-labelledby="menu-nine">
    <button  class="menu-back btn"  data-toggle="dropdown" role="button"><i class="icon-fa-chevron-left"></i> <span class="back">Back</span></button>
    <h3><?php echo gm_get_theme_menu_name('menu-nine'); ?> </h3>
    <div class="inner">
      <?php
      wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'menu-nine',  "walker" => new ut_add_aria_to_menu(), ) ); 
      ?>
    </div>
  </div>
</li>

        <?php };
        // If there is a menu-ten, then show it.
        if ( has_nav_menu( 'menu-ten' ) ) {?>

<li class="dropdown top-menu-item">
  <button class="dropdown-toggle" id="menu-ten" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <?php echo gm_get_theme_menu_name('menu-ten'); ?> <i class="icon-fa-chevron-right pull-right"></i>
  </button>
  <div class="dropdown-menu megamenu-sub" aria-labelledby="menu-ten">
    <button  class="menu-back btn"  data-toggle="dropdown" role="button"><i class="icon-fa-chevron-left"></i> <span class="back">Back</span></button>
    <h3><?php echo gm_get_theme_menu_name('menu-ten'); ?> </h3>
    <div class="inner">
      <?php
      wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'menu-ten',  "walker" => new ut_add_aria_to_menu(), ) ); 
      ?>
    </div>
  </div>
</li>
        <?php }; 
        
    
        // If there is a menu-eleven, then show it.
        if ( has_nav_menu( 'menu-eleven' ) ) { ?>
<li class="dropdown top-menu-item">
  <button class="dropdown-toggle" id="menu-eleven" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <?php echo gm_get_theme_menu_name('menu-eleven'); ?> <i class="icon-fa-chevron-right pull-right"></i>
  </button>
  <div class="dropdown-menu megamenu-sub" aria-labelledby="menu-eleven">
    <button  class="menu-back btn"  data-toggle="dropdown" aria-haspopup="true" role="button" ><i class="icon-fa-chevron-left"></i> <span class="back">Back</span></button>
    <h3><?php echo gm_get_theme_menu_name('menu-eleven'); ?> </h3>
    <div class="inner">
      <?php
      wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'menu-eleven',  "walker" => new ut_add_aria_to_menu(), ) ); 
      ?>
    </div>
  </div>
</li>
        <?php }; 
        
        // If there is a menu-twelve, then show it.
        if ( has_nav_menu( 'menu-twelve' ) ) { ?>
<li class="dropdown top-menu-item">
  <button class="dropdown-toggle" id="menu-twelve" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <?php echo gm_get_theme_menu_name('menu-twelve'); ?> <i class="icon-fa-chevron-right pull-right"></i>
  </button>
  <div class="dropdown-menu megamenu-sub" aria-labelledby="menu-twelve">
    <button  class="menu-back btn"  data-toggle="dropdown" aria-haspopup="true" role="button" ><i class="icon-fa-chevron-left"></i> <span class="back">Back</span></button>
    <h3><?php echo gm_get_theme_menu_name('menu-twelve'); ?> </h3>
    <div class="inner">
      <?php 
      wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'menu-twelve',  "walker" => new ut_add_aria_to_menu(), ) ); 
      ?>
    </div>
  </div>
</li>
        <?php };
      endif; 


      // Giving Bar Options

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