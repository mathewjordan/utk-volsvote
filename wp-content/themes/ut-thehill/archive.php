<?php
/**
 * The template for displaying Archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, Twenty Thirteen
 * already has tag.php for Tag archives, category.php for Category archives,
 * and author.php for Author archives.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage UT-TheHill
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>



<?php
  $show_month = get_theme_mod('meta_monthlabel');
  $show_year = get_theme_mod('meta_yearlabel');
  $show_day = get_theme_mod('meta_daylabel');
?>

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
				<h1 class="archive-title"><?php
					if ( is_day() ) :
					  if ($show_day!="hide") { ?>
              Daily Archives: 
            <?php }
						printf( __( '<strong>%s</strong>', 'utthehill' ), get_the_date() );
					elseif ( is_month() ) :
						if ($show_month!="hide") { ?>
              Monthly Archives: 
            <?php }
						printf( __( '<strong>%s</strong>', 'utthehill' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'utthehill' ) ) );
					elseif ( is_year() ) :
						if ($show_year!="hide") { ?>
              Yearly Archives: 
            <?php }
						printf( __( '<strong>%s</strong>', 'utthehill' ), get_the_date( _x( 'Y', 'yearly archives date format', 'utthehill' ) ) );
					else :
						_e( 'Archives', 'utthehill' );
					endif;
				?></h1>
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