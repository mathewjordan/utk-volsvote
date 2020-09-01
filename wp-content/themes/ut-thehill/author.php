<?php
/**
 * The template for displaying Author archive pages
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

			<?php
				/*
				 * Queue the first post, that way we know what author
				 * we're dealing with (if that is the case).
				 *
				 * We reset this later so we can run the loop
				 * properly with a call to rewind_posts().
				 */
				the_post();
			?>

			<header class="archive-header">
				<h1 class="archive-title"><?php printf( __( 'All posts by %s', 'utthehill' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ); ?></h1>
			</header><!-- .archive-header -->

			<?php
				/*
				 * Since we called the_post() above, we need to
				 * rewind the loop back to the beginning that way
				 * we can run the loop properly, in full.
				 */
				rewind_posts();
			?>

			<?php if ( get_the_author_meta( 'description' ) ) : ?>
				<?php get_template_part( 'author-bio' ); ?>
			<?php endif; ?>

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