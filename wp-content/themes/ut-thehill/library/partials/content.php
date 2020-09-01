<?php
    /**
    * The default template for displaying content
    *
    * Used for both single and index/archive/search.
    *
    * @package WordPress
    * @subpackage UT-TheHill
    * @since Twenty Thirteen 1.0
    */
?>


<?php
  $metaexcerpt  = get_theme_mod( 'meta_excerpt' );
  $metatax      = get_theme_mod( 'meta_tax' );
  $metadate     = get_theme_mod( 'meta_publisheddate' );
  $metaauthor   = get_theme_mod( 'meta_byline' );
  $showcomments = get_theme_mod( 'contactinfo_comments' );


  $singlebyline  = get_theme_mod( 'single_show_byline' );
  $singledate    = get_theme_mod( 'single_show_pubdate' );
  $singlecats    = get_theme_mod( 'single_show_cats' );
  $singletags    = get_theme_mod( 'single_show_tags' );



 // First Single Layout
 if ( is_single() ) : ?>
  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <header class="entry-header">
    <h1 class="entry-title"><?php the_title(); ?></h1>


    <div class="post-box-meta-single small">
      <?php  if ($singlebyline!="hide") : ?>
        <span class="author byline<?php  if ($metadate!="hide") : ?> separator<?php endif; ?>">
        By <?php if ( 'post' == get_post_type() ) {
  	  		printf( '<a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
  	  			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
  	  			esc_attr( sprintf( __( 'View all posts by %s', 'utthehill' ), get_the_author() ) ),
  	  			get_the_author()
  	  		);
  	    } ?>
        </span>
      <?php endif; ?>
  
      <?php  if ($singledate!="hide") : ?>
        <time class="updated" datetime="<?= get_post_time('c', true); ?>"><?php the_date(); ?></time>
      <?php endif; ?>
    </div>
  </header>

  <div class="entry-content clearfix">
    <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'utthehill' ) ); ?>
    <?php wp_link_pages( array( 'before' => '<ul class="pager"><li><span class="disabled">' . __( 'Pages:', 'utthehill' ) . '</span></li>', 'after' => '</ul>', 'link_before' => '<li><span>', 'link_after' => '</span></li>' ) ); ?>
  </div><!-- .entry-content -->

  <footer class="entry-meta">
      <div class="meta">
    <?php  if ($singletags!="hide") : ?>
        <?php the_tags( '<ul class="list-inline"><li><svg class="meta" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path d="M10.605 0h-10.605v10.609l13.391 13.391 10.609-10.604-13.395-13.396zm-4.191 6.414c-.781.781-2.046.781-2.829.001-.781-.783-.781-2.048 0-2.829.782-.782 2.048-.781 2.829-.001.782.782.781 2.047 0 2.829z"/></svg></li><li>', '</li><li>', '</li></ul>' ); ?>
      <?php endif; ?>
    <?php  if ($singlecats!="hide") : ?>
        <ul class="list-inline"><li><svg xmlns="http://www.w3.org/2000/svg" class="meta"  width="20" height="20" viewBox="0 0 24 24"><path d="M11 5c-1.629 0-2.305-1.058-4-3h-7v20h24v-17h-13z"/></svg></li><li><?php echo get_the_category_list( '</li><li>' ); ?></li></ul>
      <?php endif; ?>
      </div>  

    <?php  if ($showcomments=="allow") : ?>
    <?php if ( comments_open() && ! is_single() && ! is_search() ) : ?>
      <div class="comments-link"> 
        <?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a comment', 'utthehill' ) . '</span>', __( 'One comment so far', 'utthehill' ), __( 'View all % comments', 'utthehill' ) ); ?>
      </div><!-- .comments-link -->
    <?php endif; // comments_open() ?>
    <?php endif; ?>
    <?php if ( is_single() && get_the_author_meta( 'description' ) && is_multi_author() ) : ?>
      <?php get_template_part( 'author-bio' ); ?>
    <?php endif; ?>
  </footer><!-- .entry-meta -->
  </article>
<?php else : // OKAY, now everythign else, blog, categories, tags, etc. NOT SEARCH.
  //==================================================================================== ?>
















<div id="post-<?php the_ID(); ?>" class="post-list-wrapper<?php if ( $metaexcerpt != "content" ) :  ?> excerpt<?php endif; ?>">

  <div class="main">
  <?php  if ($metadate!="hide") : ?>
      <time datetime="<?= get_post_time('c', true); ?>"><?php the_date(); ?></time>
  <?php endif; ?>
  <?php  if ($metaauthor!="hide") : ?>
    <span class="author byline<?php  if ($metadate!="hide") : ?> separator hasdate<?php endif; ?>">
    By <?php if ( 'post' == get_post_type() ) {
  		printf( '<a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
  			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
  			esc_attr( sprintf( __( 'View all posts by %s', 'utthehill' ), get_the_author() ) ),
  			get_the_author()
  		);
    } ?>
    </span>
  <?php endif; ?>
<br>
    <a class="permalink" href="<?php the_permalink(); ?>" rel="bookmark">
  <?php  if(has_post_thumbnail() ): ?>
    <div class="aside aside-2">

<?php

global $post;
$url1 = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail' );
$url2 = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium');
$url3 = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large');
?>


   <img src="<?php echo $url1[0]; ?>" srcset="<?php echo $url1[0]; ?>, <?php echo $url2[0]; ?> 992w, <?php echo $url3[0]; ?> 1200w" alt="" />
    </div>
  <?php endif ?>


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





    <?php  if ($metatax!="hide") : ?>
      <div class="meta">
        <?php the_tags( '<ul class="list-inline"><li><svg class="meta" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path d="M10.605 0h-10.605v10.609l13.391 13.391 10.609-10.604-13.395-13.396zm-4.191 6.414c-.781.781-2.046.781-2.829.001-.781-.783-.781-2.048 0-2.829.782-.782 2.048-.781 2.829-.001.782.782.781 2.047 0 2.829z"/></svg></li><li>', '</li><li>', '</li></ul>' ); ?>
        <ul class="list-inline"><li><svg xmlns="http://www.w3.org/2000/svg" class="meta"  width="20" height="20" viewBox="0 0 24 24"><path d="M11 5c-1.629 0-2.305-1.058-4-3h-7v20h24v-17h-13z"/></svg></li><li><?php echo get_the_category_list( '</li><li>' ); ?></li></ul>
      </div>  
    <?php endif; ?>

    <?php  if ($showcomments=="allow") : ?>
    <?php if ( comments_open() && ! is_single() && ! is_search() ) : ?>
      <div class="comments-link post-list"> <svg xmlns="http://www.w3.org/2000/svg"  class="meta" width="20" height="20" viewBox="0 0 24 24"><path d="M19.619 21.671c-5.038 1.227-8.711-1.861-8.711-5.167 0-3.175 3.11-5.467 6.546-5.467 3.457 0 6.546 2.309 6.546 5.467 0 1.12-.403 2.22-1.117 3.073-.029 1 .558 2.435 1.088 3.479-1.419-.257-3.438-.824-4.352-1.385zm-10.711-5.167c0-4.117 3.834-7.467 8.546-7.467.886 0 1.74.119 2.544.338-.021-4.834-4.761-8.319-9.998-8.319-5.281 0-10 3.527-10 8.352 0 1.71.615 3.391 1.705 4.695.047 1.527-.851 3.718-1.661 5.313 2.168-.391 5.252-1.258 6.649-2.115.803.196 1.576.304 2.328.363-.067-.379-.113-.765-.113-1.16z"/></svg>
        <?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a comment', 'utthehill' ) . '</span>', __( 'One comment so far', 'utthehill' ), __( 'View all % comments', 'utthehill' ) ); ?>
      </div><!-- .comments-link -->
    <?php endif; // comments_open() ?>
    <?php endif; ?>
    
    <?php if ( is_single() && get_the_author_meta( 'description' ) && is_multi_author() ) : ?>
      <?php get_template_part( 'author-bio' ); ?>
    <?php endif; ?>

  </div>






</div>
<?php endif; // is_single() ?>



