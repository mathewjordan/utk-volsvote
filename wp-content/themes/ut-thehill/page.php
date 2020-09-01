<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage UT-TheHill
 * @since Twenty Thirteen 1.0
 */
get_header(); ?>

<?php
  $sitemode = get_theme_mod( 'site_mode_layout' );
  
  while ( have_posts() ) : the_post(); 
  
   if(has_post_thumbnail() && ($sitemode!="webapp")): ?>
			<div class="entry-thumbnail">
				<?php the_post_thumbnail("large"); ?>
			</div>
		<?php endif; ?>

<?php
  if( $sitemode!="webapp"): 
    get_template_part( 'library/partials/inc-soliloquy-featured' );
  endif;
?>




  <?php
    $meta_homeheadline = get_theme_mod( 'meta_homeheadline' );
    if ($sitemode=="webapp") { ?>
		<main id="content" class="content-area">
  <?php
    }
    if ($sitemode!="webapp") { ?>
		<div id="content" class="site-content<?php
      if (is_front_page()){  
        if (($meta_homeheadline!="show") && is_front_page()) { ?> home-margin<?php } }else{   } ?>" role="main">
        <?php } ?>

        <?php get_template_part( 'library/partials/inc-breadcrumb' ); ?>







				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <?php
              // If it is the front page and the homepage headline option is turned on
                if (($meta_homeheadline=="hide") && is_front_page()) { ?>
              <?php    
                }else{  ?>
                <header class="entry-header"><h1 class="entry-title"><?php the_title(); ?></h1></header>
              <?php } ?>



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
<?php get_sidebar(); ?>
<?php get_footer(); ?>