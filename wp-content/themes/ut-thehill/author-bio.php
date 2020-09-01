<?php
/**
 * The template for displaying Author bios
 *
 * @package WordPress
 * @subpackage UT-TheHill
 * @since Twenty Thirteen 1.0
 */
?>
<?php
    $sitemode = get_theme_mod( 'site_mode_layout' );
    if ($sitemode=="webapp") { ?>
<main id="primary" class="content-area"> 
<?php
    }
    if ($sitemode!="webapp") { ?>
<div id="content" class="site-content" role="main">
<?php
    }
  ?>
<?php get_template_part( 'library/partials/inc-breadcrumb' ); ?>
	<div class="author-info">
		<div class="author-avatar">
<?php
		/**
		 * Filter the author bio avatar size.
		 *
		 * @since Twenty Thirteen 1.0
		 *
		 * @param int $size The avatar height and width size in pixels.
		 */
		$author_bio_avatar_size = apply_filters( 'utthehill_author_bio_avatar_size', 74 );
		echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
		?>
		</div>
<!-- .author-avatar -->
		<div class="author-description">
			<h2 class="author-title">
<?php printf( __( 'About %s', 'utthehill' ), get_the_author() ); ?>
			</h2>
			<p class="author-bio">
<?php the_author_meta( 'description' ); ?>
				<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"> 
<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'utthehill' ), get_the_author() ); ?>
				</a> 
			</p>
		</div>
<!-- .author-description -->
	</div>
<!-- .author-info -->
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
