<?php
/**
 * The template for displaying Tag pages
 *
 * Used to display archive-type pages for posts in a tag.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage UT-TheHill
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>


  <?php
    $sitemode = get_theme_mod( 'site_mode_layout' );
    if ($sitemode=="webapp") { ?>
		<main id="content" class="content-area">
  <?php
    }
    if ($sitemode!="webapp") { ?>
		<div id="content" class="site-content" role="main">
  <?php
    }
  ?>
        <?php get_template_part( 'library/partials/inc-breadcrumb' ); ?>

		
  		<?php if ( have_posts() ) : ?>
			<header class="archive-header">
  			<h1 class="archive-title"><?php  $show_category = get_theme_mod('meta_taglabel');
  				if ($show_category!="hide") { ?>
            Tag Archives: 
          <?php }
          printf( __( '<strong>%s</strong>', 'utthehill' ), single_tag_title( '', false ) ); ?></h1>
  			


				<?php if ( tag_description() ) : // Show an optional tag description ?>
				<div class="archive-meta"><?php echo tag_description(); ?></div>
				<?php endif; ?>
			</header><!-- .archive-header -->

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'library/partials/content', get_post_format() ); ?>
			<?php endwhile; ?>

			<?php utthehill_paging_nav(); ?>

		<?php else : ?>
			<?php get_template_part( 'library/partials/content', 'none' ); ?>
		<?php endif; ?>

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