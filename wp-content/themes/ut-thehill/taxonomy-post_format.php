<?php
/**
 * The template for displaying Post Format pages
 *
 * Used to display archive-type pages for posts with a post format.
 * If you'd like to further customize these Post Format views, you may create a
 * new template file for each specific one.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage UT-TheHill
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>


		<div id="content" class="site-content" role="main">
        <?php get_template_part( 'library/partials/inc-breadcrumb' ); ?>
		<?php if ( have_posts() ) : ?>
			<header class="archive-header">
				<h1 class="archive-title"><?php printf( __( '%s Archives', 'utthehill' ), '<span>' . get_post_format_string( get_post_format() ) . '</span>' ); ?></h1>
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