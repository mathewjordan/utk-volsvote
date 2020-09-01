<?php

//===================================================================================================================
// Shortcodes, get your shortcodes
//===================================================================================================================


// Begin Shortcodes
class UTKShortcodes {

  function __construct() {
    add_action( 'init', array( $this, 'add_shortcodes' ) );
    //add_action( 'wp_enqueue_scripts', array( $this, 'bootstrap_shortcodes_scripts' ), 9999 ); // Register this fxn and allow Wordpress to call it automatcally in the header
  }



  /*--------------------------------------------------------------------------------------
    *
    * add_shortcodes
    *
    * @author Filip Stefansson
    * @since 1.0
    *
    *-------------------------------------------------------------------------------------*/
  function add_shortcodes() {

    $shortcodes = array(
      'highlight', 
      'darkhighlight',
      'rightcolumn',
      'leftcolumn',
      'half',
      'onefourth',
      'onethird',
      'twothirds',
      'clear',
      'hash',
      'fold',
      'accordion',
      'callout',
      'mobile',
      'login',
      'orangehash',
      'icon-download',
      'icon-arrow-down',
      'icon-arrow-up',
      'icon-map',
      'icon-find',
      'icon-folder',
      'icon-home',
      'icon-check',
      'icon-sign',
      'icon-tag',
      'icon-arrow-right',
      'icon-arrow-left',
      'icon-file',
      'icon-question',
      'icon-cal',
      'icon-gift',
      'icon-user',
      'icon-comment',
      'icon-edit',
    );

    foreach ( $shortcodes as $shortcode ) {

      $function = 'ut_' . str_replace( '-', '_', $shortcode );
      add_shortcode( $shortcode, array( $this, $function ) );
      
    }
  }


// Make a highlight box
function ut_highlight( $atts, $content = null ) {
	extract(shortcode_atts(array(
		"color" => '',
		"outline" => '',
		"text" => ''
	), $atts));
   $content = wpautop(trim($content));
   return '<div class="box-light card '.$color.' tx'.$text.' brd-'.$outline.'">' . do_shortcode($content) . '</div>';
}



// Make a dark highlight box
function ut_darkhighlight( $atts, $content = null ) {
 	 remove_filter( 'the_content', 'wpautop' );
   add_filter( 'the_content', 'wpautop' , 12);
   $content = wpautop(trim($content));
  return '<div class="box card">' . do_shortcode($content) . '</div>';
}

//	Right Column
function ut_rightcolumn($atts, $content = null) {
	 remove_filter( 'the_content', 'wpautop' );
   add_filter( 'the_content', 'wpautop' , 12);
   $content = wpautop(trim($content));
   return '<div class="rightcolumn">' . do_shortcode($content) . '</div>';
}

//	Left Column
function ut_leftcolumn($atts, $content = null) {
	 remove_filter( 'the_content', 'wpautop' );
   add_filter( 'the_content', 'wpautop' , 12);
   $content = wpautop(trim($content));
   return '<div class="leftcolumn">' . do_shortcode($content) . '</div>';
}

//	Half Column
function ut_half($atts, $content = null) {
  	extract(shortcode_atts(array(
  		"align" => ''
  	), $atts));
	 remove_filter( 'the_content', 'wpautop' );
   add_filter( 'the_content', 'wpautop' , 12);
   $content = wpautop(trim($content));
   return '<div class="half '.$align.'">' . do_shortcode($content) . '</div>';
}

//	One Fourth Column
function ut_onefourth($atts, $content = null) {
  	extract(shortcode_atts(array(
  		"align" => ''
  	), $atts));
	 remove_filter( 'the_content', 'wpautop' );
   add_filter( 'the_content', 'wpautop' , 12);
   $content = wpautop(trim($content));
   return '<div class="one-fourth column '.$align.'">' . do_shortcode($content) . '</div>';
}


//	One Third Column
function ut_onethird($atts, $content = null) {
	extract(shortcode_atts(array(
		"align" => ''
	), $atts));
	 remove_filter( 'the_content', 'wpautop' );
   add_filter( 'the_content', 'wpautop' , 12);
   $content = wpautop(trim($content));
   return '<div class="one-third column '.$align.'">' . do_shortcode($content) . '</div>';
}

//	Two Third Column
function ut_twothirds($atts, $content = null) {
	extract(shortcode_atts(array(
		"align" => ''
	), $atts));
	 remove_filter( 'the_content', 'wpautop' );
   add_filter( 'the_content', 'wpautop' , 12);
   $content = wpautop(trim($content));
   return '<div class="two-thirds column '.$align.'">' . do_shortcode($content) . '</div>';
}


//Clear
function ut_clear( $atts ){
 return '<br class="clearshortcode">';
}
//Hash
function ut_orangehash( $atts ){
 return '<hr class="orange-hash">';
}

//Accordion Actions
// Folds
// remove_filter( 'the_content', 'wpautop' );
// add_filter( 'the_content', 'wpautop' , 12);

function ut_fold($atts, $content = null) {
	extract(shortcode_atts(array(
		"title" => '#',
		"group" => '#'
	), $atts));
   remove_filter( 'the_content', 'wpautop' );
   
	return '<div class="accordion-group">
                  <div class="accordion-heading"><a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse'.$group.'">'. $title .'</a></div><div id="collapse'. $group .'" class="accordion-body collapse"><div class="accordion-inner">'. do_shortcode($content) . '</div></div></div>';
				}
// Wrap
function ut_accordion($atts, $content = null) {
   $content = wpautop(trim($content));
   remove_filter( 'the_content', 'wpautop' );
	return '<div class="accordion" id="accordion2">'. do_shortcode($content) .'</div>';
}

//Callout
function ut_callout($atts, $content = null) {
	extract(shortcode_atts(array(
		"align" => '#'
	), $atts));
   $content = wpautop(trim($content));
	return '<div class="callout '.$align.'">'. do_shortcode($content) .'</div>';
}

// Mobile NivoSlider Links

function ut_mobile($atts) {
	
	return '<p class="mobile-nivo"><a class="button" href="'.site_url().'/nivoslider/'.the_slug().'/">View Slideshow</a></p>';
				}

//==[ icon shortcodes ===============
// Make a download icon
function ut_icon_download( $atts, $content = null ) {
	extract(shortcode_atts(array(
		"color" => '#'
	), $atts));
   return '<span class="uticon icon-download '.$color.'"><svg xmlns="http://www.w3.org/2000/svg"   viewBox="0 0 24 24"><path d="M15 10h4l-7 8-7-8h4v-10h6v10zm3.213-8.246l-1.213 1.599c2.984 1.732 5 4.955 5 8.647 0 5.514-4.486 10-10 10s-10-4.486-10-10c0-3.692 2.016-6.915 5-8.647l-1.213-1.599c-3.465 2.103-5.787 5.897-5.787 10.246 0 6.627 5.373 12 12 12s12-5.373 12-12c0-4.349-2.322-8.143-5.787-10.246z"/></svg>' . do_shortcode($content) . '</span> ';
}

// Make a map icon
function ut_icon_map( $atts, $content = null ) {
	extract(shortcode_atts(array(
		"color" => '#'
	), $atts));
   return '<span class="uticon icon-map '.$color.'"><svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24"><path d="M17.492 15.432c-.433 0-.855-.087-1.253-.259l.467-1.082c.25.107.514.162.786.162.222 0 .441-.037.651-.11l.388 1.112c-.334.118-.683.177-1.039.177zm-10.922-.022c-.373 0-.741-.066-1.093-.195l.407-1.105c.221.081.451.122.686.122.26 0 .514-.05.754-.148l.447 1.09c-.382.157-.786.236-1.201.236zm8.67-.783l-1.659-.945.583-1.024 1.66.945-.584 1.024zm-6.455-.02l-.605-1.011 1.639-.981.605 1.011-1.639.981zm3.918-1.408c-.243-.101-.5-.153-.764-.153-.23 0-.457.04-.674.119l-.401-1.108c.346-.125.708-.188 1.075-.188.42 0 .83.082 1.217.244l-.453 1.086zm7.327-.163c-.534 0-.968.433-.968.968 0 .535.434.968.968.968.535 0 .969-.434.969-.968 0-.535-.434-.968-.969-.968zm-16.061 0c-.535 0-.969.433-.969.968 0 .535.434.968.969.968s.969-.434.969-.968c0-.535-.434-.968-.969-.968zm18.031-.832v6.683l-4 2.479v-4.366h-1v4.141l-4-2.885v-3.256h-2v3.255l-4 2.885v-4.14h-1v4.365l-4-2.479v-13.294l4 2.479v3.929h1v-3.927l4-2.886v4.813h2v-4.813l1.577 1.138c-.339-.701-.577-1.518-.577-2.524l.019-.345-2.019-1.456-5.545 4-6.455-4v18l6.455 4 5.545-4 5.545 4 6.455-4v-11.618l-.039.047c-.831.982-1.614 1.918-1.961 3.775zm2-8.403c0-2.099-1.9-3.801-4-3.801s-4 1.702-4 3.801c0 3.121 3.188 3.451 4 8.199.812-4.748 4-5.078 4-8.199zm-5.5.199c0-.829.672-1.5 1.5-1.5s1.5.671 1.5 1.5-.672 1.5-1.5 1.5-1.5-.671-1.5-1.5zm-.548 8c-.212-.992-.547-1.724-.952-2.334v2.334h.952z"/></svg>' . do_shortcode($content) . '</span> ';
}

// Make a chevron right icon
function ut_icon_arrow_right( $atts, $content = null ) {
	extract(shortcode_atts(array(
		"color" => '#'
	), $atts));
   return '<span class="uticon icon-arrow-right '.$color.'"><svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24"><path d="M7.33 24l-2.83-2.829 9.339-9.175-9.339-9.167 2.83-2.829 12.17 11.996z"/></svg>' . do_shortcode($content) . '</span> ';
}

// Make a chevron left icon
function ut_icon_arrow_left( $atts, $content = null ) {
	extract(shortcode_atts(array(
		"color" => '#'
	), $atts));
   return '<span class="uticon icon-arrow-left '.$color.'"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z"/></svg>' . do_shortcode($content) . '</span> ';
}

// Make a file icon
function ut_icon_file( $atts, $content = null ) {
	extract(shortcode_atts(array(
		"color" => '#'
	), $atts));
   return '<span class="uticon icon-file '.$color.'"><svg xmlns="http://www.w3.org/2000/svg"   viewBox="0 0 24 24"><path d="M15 2v5h5v15h-16v-20h11zm1-2h-14v24h20v-18l-6-6z"/></svg>' . do_shortcode($content) . '</span> ';
}
// Make a arrow down
function ut_icon_arrow_down( $atts, $content = null ) {
	extract(shortcode_atts(array(
		"color" => '#'
	), $atts));
   return '<span class="uticon icon-arrow-down '.$color.'"><svg xmlns="http://www.w3.org/2000/svg"   viewBox="0 0 24 24"><path d="M0 7.33l2.829-2.83 9.175 9.339 9.167-9.339 2.829 2.83-11.996 12.17z"/></svg>' . do_shortcode($content) . '</span> ';
}
// Make a arrow up
function ut_icon_arrow_up( $atts, $content = null ) {
	extract(shortcode_atts(array(
		"color" => '#'
	), $atts));
   return '<span class="uticon icon-arrow-up '.$color.'"><svg xmlns="http://www.w3.org/2000/svg"   viewBox="0 0 24 24"><path d="M0 16.67l2.829 2.83 9.175-9.339 9.167 9.339 2.829-2.83-11.996-12.17z"/></svg>' . do_shortcode($content) . '</span> ';
}


// Make a find
function ut_icon_find( $atts, $content = null ) {
	extract(shortcode_atts(array(
		"color" => '#'
	), $atts));
   return '<span class="uticon icon-find '.$color.'"><svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24"><path d="M23.822 20.88l-6.353-6.354c.93-1.465 1.467-3.2 1.467-5.059.001-5.219-4.247-9.467-9.468-9.467s-9.468 4.248-9.468 9.468c0 5.221 4.247 9.469 9.468 9.469 1.768 0 3.421-.487 4.839-1.333l6.396 6.396 3.119-3.12zm-20.294-11.412c0-3.273 2.665-5.938 5.939-5.938 3.275 0 5.94 2.664 5.94 5.938 0 3.275-2.665 5.939-5.94 5.939-3.274 0-5.939-2.664-5.939-5.939z"/></svg>' . do_shortcode($content) . '</span> ';
}
// Make a folder
function ut_icon_folder( $atts, $content = null ) {
	extract(shortcode_atts(array(
		"color" => '#'
	), $atts));
   return '<span class="uticon icon-folder '.$color.'"><svg xmlns="http://www.w3.org/2000/svg"   viewBox="0 0 24 24"><path d="M21.604 13l-1.272 7h-16.663l-1.272-7h19.207zm-14.604-11h-6v7h2v-5h3.084c1.38 1.612 2.577 3 4.916 3h10v2h2v-4h-12c-1.629 0-2.305-1.058-4-3zm17 9h-24l2 11h20l2-11z"/></svg>' . do_shortcode($content) . '</span> ';
}
// Make a home
function ut_icon_home( $atts, $content = null ) {
	extract(shortcode_atts(array(
		"color" => '#'
	), $atts));
   return '<span class="uticon icon-home '.$color.'"><svg xmlns="http://www.w3.org/2000/svg"   viewBox="0 0 24 24"><path d="M20 7.093v-5.093h-3v2.093l3 3zm4 5.907l-12-12-12 12h3v10h7v-5h4v5h7v-10h3zm-5 8h-3v-5h-8v5h-3v-10.26l7-6.912 7 6.99v10.182z"/></svg>' . do_shortcode($content) . '</span> ';
}
// Make a check
function ut_icon_check( $atts, $content = null ) {
	extract(shortcode_atts(array(
		"color" => '#'
	), $atts));
   return '<span class="uticon icon-check '.$color.'"><svg xmlns="http://www.w3.org/2000/svg"   viewBox="0 0 24 24"><path d="M21.856 10.303c.086.554.144 1.118.144 1.697 0 6.075-4.925 11-11 11s-11-4.925-11-11 4.925-11 11-11c2.347 0 4.518.741 6.304 1.993l-1.422 1.457c-1.408-.913-3.082-1.45-4.882-1.45-4.962 0-9 4.038-9 9s4.038 9 9 9c4.894 0 8.879-3.928 8.99-8.795l1.866-1.902zm-.952-8.136l-9.404 9.639-3.843-3.614-3.095 3.098 6.938 6.71 12.5-12.737-3.096-3.096z"/></svg>' . do_shortcode($content) . '</span> ';
}
// Make a sign
function ut_icon_sign( $atts, $content = null ) {
	extract(shortcode_atts(array(
		"color" => '#'
	), $atts));
   return '<span class="uticon icon-sign '.$color.'"><svg xmlns="http://www.w3.org/2000/svg"   viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-.001 5.75c.69 0 1.251.56 1.251 1.25s-.561 1.25-1.251 1.25-1.249-.56-1.249-1.25.559-1.25 1.249-1.25zm2.001 12.25h-4v-1c.484-.179 1-.201 1-.735v-4.467c0-.534-.516-.618-1-.797v-1h3v6.265c0 .535.517.558 1 .735v.999z"/></svg>' . do_shortcode($content) . '</span> ';
}
// Make a tag
function ut_icon_tag( $atts, $content = null ) {
	extract(shortcode_atts(array(
		"color" => '#'
	), $atts));
   return '<span class="uticon icon-tag '.$color.'"><svg xmlns="http://www.w3.org/2000/svg"   viewBox="0 0 24 24"><path d="M10.773 21.585l-1.368 1.415-10.405-10.429v-8.571h2v7.719l9.773 9.866zm1.999-20.585h-9.772v9.772l12.074 12.228 9.926-9.85-12.228-12.15zm-4.772 7c-1.105 0-2-.895-2-2s.895-2 2-2 2 .895 2 2-.895 2-2 2z"/></svg>' . do_shortcode($content) . '</span> ';
}

// Make a question
function ut_icon_question( $atts, $content = null ) {
	extract(shortcode_atts(array(
		"color" => '#'
	), $atts));
   return '<span class="uticon icon-question '.$color.'"><svg xmlns="http://www.w3.org/2000/svg"   viewBox="0 0 24 24"><path d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm1.25 17c0 .69-.559 1.25-1.25 1.25-.689 0-1.25-.56-1.25-1.25s.561-1.25 1.25-1.25c.691 0 1.25.56 1.25 1.25zm1.393-9.998c-.608-.616-1.515-.955-2.551-.955-2.18 0-3.59 1.55-3.59 3.95h2.011c0-1.486.829-2.013 1.538-2.013.634 0 1.307.421 1.364 1.226.062.847-.39 1.277-.962 1.821-1.412 1.343-1.438 1.993-1.432 3.468h2.005c-.013-.664.03-1.203.935-2.178.677-.73 1.519-1.638 1.536-3.022.011-.924-.284-1.719-.854-2.297z"/></svg>' . do_shortcode($content) . '</span> ';
}
// Make a gift
function ut_icon_gift( $atts, $content = null ) {
	extract(shortcode_atts(array(
		"color" => '#'
	), $atts));
   return '<span class="uticon icon-gift">' . do_shortcode($content) . '</span> ';
}
// Make a user
function ut_icon_user( $atts, $content = null ) {
	extract(shortcode_atts(array(
		"color" => '#'
	), $atts));
   return '<span class="uticon icon-user">' . do_shortcode($content) . '</span> ';
}
// Make a comment
function ut_icon_comment( $atts, $content = null ) {
	extract(shortcode_atts(array(
		"color" => '#'
	), $atts));
   return '<span class="uticon icon-comment">' . do_shortcode($content) . '</span> ';
}
// Make a edit
function ut_icon_edit( $atts, $content = null ) {
	extract(shortcode_atts(array(
		"color" => '#'
	), $atts));
   return '<span class="uticon icon-edit '.$color.'"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M14.078 4.232l-12.64 12.639-1.438 7.129 7.127-1.438 12.641-12.64-5.69-5.69zm-10.369 14.893l-.85-.85 11.141-11.125.849.849-11.14 11.126zm2.008 2.008l-.85-.85 11.141-11.125.85.85-11.141 11.125zm18.283-15.444l-2.816 2.818-5.691-5.691 2.816-2.816 5.691 5.689z"/></svg>' . do_shortcode($content) . '</span> ';
}
// Make a cal
function ut_icon_cal( $atts, $content = null ) {
	extract(shortcode_atts(array(
		"color" => '#'
	), $atts));
   return '<span class="uticon icon-cal '.$color.'"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M20 20h-4v-4h4v4zm-6-10h-4v4h4v-4zm6 0h-4v4h4v-4zm-12 6h-4v4h4v-4zm6 0h-4v4h4v-4zm-6-6h-4v4h4v-4zm16-8v22h-24v-22h3v1c0 1.103.897 2 2 2s2-.897 2-2v-1h10v1c0 1.103.897 2 2 2s2-.897 2-2v-1h3zm-2 6h-20v14h20v-14zm-2-7c0-.552-.447-1-1-1s-1 .448-1 1v2c0 .552.447 1 1 1s1-.448 1-1v-2zm-14 2c0 .552-.447 1-1 1s-1-.448-1-1v-2c0-.552.447-1 1-1s1 .448 1 1v2z"/></svg>' . do_shortcode($content) . '</span> ';
}
function ut_login( $atts , $content = null ) {
    $currentURL =  wp_login_url();
    return "<div class=\"box-light gray1\">This content is for authorized users only. Please <a href='$currentURL' title='Login'>login with your NetID and NetID password</a> to begin.</div>";
}


 
 /*--------------------------------------------------------------------------------------
    *
    * If the user puts a return between the shortcode and its contents, sometimes we want to strip the resulting P tags out
    *
    *-------------------------------------------------------------------------------------*/
  function strip_paragraph( $content ) {
      $content = str_ireplace( '<p>','',$content );
      $content = str_ireplace( '</p>','',$content );
      $content = str_ireplace( '<br />','',$content );

      return $content;
  }

}

new UTKShortcodes();





?>