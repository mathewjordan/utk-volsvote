<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage UT-TheHill
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>
<? 
  $home_url = home_url();
  $search_term = substr($_SERVER['REQUEST_URI'],1);
  $search_term = urldecode(stripslashes($search_term));
//  $search_term = 'blog';
  $search_url = $home_url . "/". $search_term;
  $search_term = str_replace('/', ' ', $search_term);
  $search_term = str_replace('-', ' ', $search_term);
//  $full_search_url = $search_url . $search_term;
//  $full_search_url = preg_replace('/ /', '%20', $full_search_url);
//  $full_page = implode("", file($full_search_url));
//  print_r($full_page); die();
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
    <div class="page-wrapper">
      <div class="page-content">
        <h2>
<?php _e( 'Page Not Found', 'utthehill' ); ?>
        </h2>
        <h4>
<?php _e( 'We&rsquo;re sorry. It looks like nothing was found at this location. We hope the information below can be of some assistance.', 'utthehill' ); ?>
        </h4>
        <div class="one-third column">
          <img src="<?php echo get_template_directory_uri(); ?>/images/interface/404.jpg" class="alignleft size-full" alt="Image of Smokey encouraging us to find the page.">
        </div>
        <div class="two-thirds column">
          <br class="clear">
          <div class="box-light">
<?php _e( 'Try searching for the page:', 'utthehill' ); ?>
            <form method="post" action="http://google.tennessee.edu/search">
              <div class="form-group">
                <input type="text" class="form-control" name="q" onfocus="if(this.value == ' ') { this.value = ''; }" value=" "><br>
                <select name="sitesearch" class="form-control">
                  <option value="<?php echo( $home_url); ?>">
<?php bloginfo( 'name' ); ?>
                  </option>
                  <option value="utk.edu">
                  </option>
                  <option value="tennessee.edu">
                  </option>
                </select>
                <br><input type="submit" name="btnG" class="btn" value="Search">
              </div>
              <input type="hidden" name="output" value="xml_no_dtd"><input type="hidden" name="oe" value="UTF-8"><input type="hidden" name="ie" value="UTF-8"><input type="hidden" name="ud" value="1"><input type="hidden" name="site" value="Knoxville"><input type="hidden" name="client" value="utk_translate_frontend"><input type="hidden" name="entqr" value="3"><input type="hidden" name="qtype" class="searchtext" value="utk" title="search type"><input type="hidden" name="proxystylesheet" value="utk_translate_frontend">
            </form>
          </div>
          <p>
            <a class="btn" href="<?php echo esc_url( home_url( '/' ) ); ?>">
<?php bloginfo( 'name' ); ?>
<?php _e( 'homepage', 'utthehill' ); ?>
            </a>
          </p>
          <p>
            <a class="btn" href="http://www.utk.edu">
<?php _e( 'homepage', 'utthehill' ); ?>
            </a>
          </p>
        </div>
<?php

$s=get_search_query();
$args = array(
                's' => $search_term
            );


    // The Query
$the_query = new WP_Query( $args );
if ( $the_query->have_posts() ) {
//  echo( "<div class=\"box-light\">");
  echo( "<hr>");
        _e("<h4>Here are some pages that you may  be looking for, based upon the URL containing  &ldquo;". $search_term .".&rdquo;</h4>", "utthehill");
  echo( "<ul>");
        while ( $the_query->have_posts() ) {
           $the_query->the_post();
                 ?>
        <li>
          <a href="<?php the_permalink(); ?>">
<?php the_title(); ?>
          </a>
        </li>
<?php
        }
  echo( "</ul>");
 // echo( "</div>");
    }else{

   } ?>
        <hr><br class="clear">
        <p>
<?php _e( '<strong>404.</strong> The page at <code>'. $search_url.'</code> was not found.', 'utthehill' ); ?>
<?php _e( 'Are you sure the page should be here?', 'utthehill' ); ?>
          <a href="mailto:webteam@utk.edu">
<?php _e( 'Tell the UT Webteam about it', 'utthehill' ); ?>
          </a>
        </p>
      </div>
<!-- .page-content -->
    </div>
<!-- .page-wrapper -->
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
