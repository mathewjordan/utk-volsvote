<?php
/**
 * Template Name: No Sidebar
 * Description: Full-width, without a sidebar
 *
 * @package WordPress
 * @subpackage utresponsive
 */


get_header(); ?>

		<?php /* The loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>


  		<?php // Check to see if ACF is activated. If so, grab the first row and see if it is a Slider. If so, use it instead of the Featured Image
	          if(function_exists('have_rows') && have_rows('custom_acf_layout')):
		            // Set a few vars so we dont dupe the slider in the full width and the body
						    $n = 0;
							  $sliderExists = false; ?>
    <?php  get_template_part( 'library/partials/inc-nivo-featured' ); ?>
		<?php endif; ?>




<?php
  $sitemode = get_theme_mod( 'site_mode_layout' );
  if(has_post_thumbnail() && ($sitemode!="webapp")): ?>
    <div class="entry-thumbnail">
    	<?php the_post_thumbnail("large"); ?>
    </div>
<?php endif; ?>
<?php
   if( $sitemode!="webapp"): ?>
    <?php  get_template_part( 'library/partials/inc-soliloquy-featured' ); ?>
		<?php endif; ?>
  <?php
    $sitemode = get_theme_mod( 'site_mode_layout' );
    if ($sitemode=="webapp") { ?>
		<main id="content" class="content-area nosidebar">
  <?php
  $meta_homeheadline = get_theme_mod( 'meta_homeheadline' );
    }
    if ($sitemode!="webapp") { ?>
		<div id="content<?php
  $sitemode = get_theme_mod( 'site_mode_layout' );
  if ($sitemode=="webapp") {
    echo '-webapp';
 }
 ?>"  class="site-content nosidebar<?php
              if (is_front_page()){  
                   
              if (($meta_homeheadline!="show") && is_front_page()) { ?> home-margin<?php } }else{   } ?>" role="main">
  <?php
    }
  ?>


        <?php get_template_part( 'library/partials/inc-breadcrumb' ); ?>




				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<header class="entry-header">

            <?php
              // If it is the front page and the homepage headline option is turned on
                if (($meta_homeheadline=="hide") && is_front_page()) { ?>
              <?php    
                }else{  ?>
                <header class="entry-header"><h1 class="entry-title"><?php the_title(); ?></h1></header>
              <?php } ?>


					</header><!-- .entry-header -->




								<div class="entry-content reg">
									<?php the_content(); ?>
									<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'utthehill' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
								</div><!-- .entry-content -->




					<footer class="entry-meta">
						<?php edit_post_link( __( 'Edit', 'utthehill' ), '<span class="edit-link">', '</span>' ); ?>
					</footer><!-- .entry-meta -->
				</article><!-- #post -->

			<?php endwhile; ?>

  <?php
    if ($sitemode!="webapp") { ?>
		</div>
  <?php
    }
  ?>
  <?php
    if ($sitemode=="webapp") { ?>
		</main>
  <?php
    }
  ?>
<?php get_footer(); ?>
