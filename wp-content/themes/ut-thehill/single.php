<?php
/**
 * The template for displaying all single posts
 *
 * @package WordPress
 * @subpackage UT-TheHill
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>
    <?php if(has_post_thumbnail()): ?>
  <?php
    if ($sitemode!="webapp") { ?>
			<div class="entry-thumbnail">
				<?php the_post_thumbnail("large"); ?>
			</div>
  <?php } ?>

    <?php endif; ?>

    <?php
    $sitemode = get_theme_mod( 'site_mode_layout' );
    $showcomments = get_theme_mod( 'contactinfo_comments' );
    if ($sitemode=="webapp") { ?>
		<main id="content" class="content-area<?php $showsidebar = get_theme_mod( 'single_show_sidebar' ); if ($showsidebar=="hide") { ?> wide<?php } ?>">
  <?php
    }
    if ($sitemode!="webapp") { ?>
		<div id="content" class="site-content<?php $showsidebar = get_theme_mod( 'single_show_sidebar' ); if ($showsidebar=="hide") { ?> wide<?php } ?>" role="main">
  <?php
    }
  ?>
        <?php get_template_part( 'library/partials/inc-breadcrumb' ); ?>

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'library/partials/content', get_post_format() ); ?>

    <?php
    $showpager = get_theme_mod( 'single_show_pager' );
    if ($showpager!="hide") { ?>
				<?php utthehill_post_nav(); ?>
    <?php } ?>


        <?php if ($showcomments=="allow") { ?>
          <?php comments_template(); ?>
        <?php } ?>


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

<?php
$showsidebar = get_theme_mod( 'single_show_sidebar' );
if ($showsidebar!="hide") { ?>
		<?php get_sidebar(); ?>
<?php } ?>


<?php get_footer(); ?>