<?php
  $meta_parentunit_show = get_theme_mod( 'meta_parentunit_show' );
  $meta_parentunit_name = get_theme_mod( 'meta_parentunit_name' );
  $meta_parentunit_link = get_theme_mod( 'meta_parentunit_link' );
  $meta_sitetitlesize = get_theme_mod( 'meta_sitetitlesize' );
?>

<div id="sitetitle" class="site-header">
  <h2 class="department<?php if ($meta_sitetitlesize=="small") { ?> site-header-shrink<?php } ?>"><a  href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a><?php

      if ($meta_parentunit_show=="show") { ?>
        <small>
          <?php if ($meta_parentunit_link!="") { ?>
            <a href="<?php echo $meta_parentunit_link; ?>">
            <?php } ?>
              <?php echo $meta_parentunit_name; ?>
            <?php if ($meta_parentunit_link!="") { ?>
            <?php } ?>
          </a>
        </small>

    <?php } ?>
  </h2>
</div>