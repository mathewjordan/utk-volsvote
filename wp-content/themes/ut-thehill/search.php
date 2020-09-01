<?php
/**
 * The template for displaying Search Results pages
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

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: <strong>%s</strong>', 'utthehill' ), get_search_query() ); ?></h1>
			</header>

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>




<div id="post-<?php the_ID(); ?>" class="post-list-wrapper">

  <div class="main">
    <a class="permalink" href="<?php the_permalink(); ?>" rel="bookmark">
      <h1 class="entry-title"><?php the_title(); ?></h1>

  <?php // Figure out if we should show CONTENT or EXCERPT
    if ( $metaexcerpt != "content" ) :  ?>
    <div class="entry-summary post-list">
      <?php the_excerpt(); ?>
      <?php wp_link_pages( array( 'before' => '<ul class="pager"><li><span class="disabled">' . __( 'Pages:', 'utthehill' ) . '</span></li>', 'after' => '</ul>', 'link_before' => '<li><span>', 'link_after' => '</span></li>' ) ); ?>
    </div><!-- .entry-summary -->
  <?php else : ?>
    <div class="entry-content post-list">
      <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'utthehill' ) ); ?>
      <?php wp_link_pages( array( 'before' => '<ul class="pager"><li><span class="disabled">' . __( 'Pages:', 'utthehill' ) . '</span></li>', 'after' => '</ul>', 'link_before' => '<li><span>', 'link_after' => '</span></li>' ) ); ?>
    </div><!-- .entry-content -->
  <?php endif; ?>

  </a>




    <?php if ( comments_open() && ! is_single() && ! is_search() ) : ?>
      <div class="comments-link post-list"> 
        <?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a comment', 'utthehill' ) . '</span>', __( 'One comment so far', 'utthehill' ), __( 'View all % comments', 'utthehill' ) ); ?>
      </div><!-- .comments-link -->
    <?php endif; // comments_open() ?>

  </div>


  <?php  if ($metadate!="hide") : ?>
    <div class="aside aside-1">
      <time datetime="<?= get_post_time('c', true); ?>"><?php the_date(); ?></time>
    </div>
  <?php endif; ?>


  <?php  if(has_post_thumbnail() ): ?>
    <?php // <div class="aside aside-2"> ?>
    	<?php // the_post_thumbnail("thumb"); ?>
   <?php // </div> ?>
  <?php endif; ?>


</div>			<?php endwhile; ?>

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
<?php get_footer(); ?>