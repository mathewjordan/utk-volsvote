<?php



function Utnews2017_customize_register( $wp_customize ) {
  // All our sections, settings, and controls will be added here

  
  // Here are the Meta Information Settings
  // ===================================================================



  // Show the Parent in Header
  $wp_customize->add_setting('meta_parentunit_show', array(
    'default'   => 'hide',
    'transport' => 'refresh'
  ));
  $wp_customize->add_control('meta_parentunit_show', array(
    'label'      => __('Show Parent Unit in Header', 'utthehill'),
    'section'    => 'meta-infomation',
    'settings'   => 'meta_parentunit_show',
    'default'    => 'show',
    'type'       => 'radio',
    'choices'    => array(
      'show'   => 'Show',
      'hide'  => 'Hide',
    ),
  ));

  // Parent Unit
  $wp_customize->add_setting('meta_parentunit_name', array());
  $wp_customize->add_control('meta_parentunit_name', array(
    'label'      => __('Parent Unit', 'utthehill'),
    'section'    => 'meta-infomation',
    'settings'   => 'meta_parentunit_name',
    'type'       => 'text'
  ));

  // Parent Unit link
  $wp_customize->add_setting('meta_parentunit_link', array());
  $wp_customize->add_control('meta_parentunit_link', array(
    'label'      => __('Parent Unit Link', 'utthehill'),
    'section'    => 'meta-infomation',
    'settings'   => 'meta_parentunit_link',
    'type'       => 'text'
  ));


  // Byline
  $wp_customize->add_setting('meta_byline', array(
    'default'   => 'hide',
    'transport' => 'refresh'
  ));
  $wp_customize->add_control('meta_byline', array(
    'label'      => __('Show the author&rsquo;s byline on archive pages', 'utthehill'),
    'section'    => 'meta-infomation',
    'settings'   => 'meta_byline',
    'default'    => 'show',
    'type'       => 'radio',
    'choices'    => array(
      'show'   => 'Show',
      'hide'  => 'Hide',
    ),
  ));

  // Homepage Headline
  $wp_customize->add_setting('meta_homeheadline', array(
    'default'   => 'show',
    'transport' => 'refresh'
  ));
  $wp_customize->add_control('meta_homeheadline', array(
    'label'      => __('Show the headline on homepage', 'utthehill'),
    'section'    => 'meta-infomation',
    'settings'   => 'meta_homeheadline',
    'type'       => 'radio',
    'default'    => 'show',
    'choices'    => array(
      'show'   => 'Show',
      'hide'  => 'Hide',
    ),
  ));

  // Shrink site title (for sites with very long names)
  $wp_customize->add_setting('meta_sitetitlesize', array(
    'default'   => 'regular',
    'transport' => 'refresh'
  ));
  $wp_customize->add_control('meta_sitetitlesize', array(
    'label'      => __('Shrink site title (for sites with very long names).', 'utthehill'),
    'section'    => 'meta-infomation',
    'settings'   => 'meta_sitetitlesize',
    'type'       => 'radio',
    'default'    => 'regular',
    'choices'    => array(
      'regular'   => 'Regular',
      'small'  => 'Shrink',
    ),
  ));




  // Published Date
  $wp_customize->add_setting('meta_publisheddate', array(
    'default'   => 'show',
    'transport' => 'refresh'
  ));
  $wp_customize->add_control('meta_publisheddate', array(
    'label'      => __('Show the published date on archive pages', 'utthehill'),
    'section'    => 'meta-infomation',
    'settings'   => 'meta_publisheddate',
    'default'    => 'show',
    'type'       => 'radio',
    'choices'    => array(
      'show'   => 'Show',
      'hide'  => 'Hide',
    ),
  ));

  // taxonomy
  $wp_customize->add_setting('meta_tax', array(
    'default'   => 'show',
    'transport' => 'refresh'
  ));
  $wp_customize->add_control('meta_tax', array(
    'label'      => __('Show the taxonomy block on archive pages', 'utthehill'),
    'section'    => 'meta-infomation',
    'settings'   => 'meta_tax',
    'default'    => 'show',
    'type'       => 'radio',
    'choices'    => array(
      'show'   => 'Show',
      'hide'  => 'Hide',
    ),
  ));
  // Show the word "Category" on the categories page
  $wp_customize->add_setting('meta_categorylabel', array(
    'default'   => 'show',
    'transport' => 'refresh'
  ));
  $wp_customize->add_control('meta_categorylabel', array(
    'label'      => __('Show the word "Category" on the categories page', 'utthehill'),
    'section'    => 'meta-infomation',
    'settings'   => 'meta_categorylabel',
    'default'    => 'show',
    'type'       => 'radio',
    'choices'    => array(
      'show'   => 'Show',
      'hide'  => 'Hide',
    ),
  ));

  // Show the word "Month" on the month page
  $wp_customize->add_setting('meta_monthlabel', array(
    'default'   => 'show',
    'transport' => 'refresh'
  ));
  $wp_customize->add_control('meta_monthlabel', array(
    'label'      => __('Show the &ldquo;Monthly Archives&rdquo; label on the monthly archive page', 'utthehill'),
    'section'    => 'meta-infomation',
    'settings'   => 'meta_monthlabel',
    'default'    => 'show',
    'type'       => 'radio',
    'choices'    => array(
      'show'   => 'Show',
      'hide'  => 'Hide',
    ),
  ));
  // Show the word "Tag" on the month page
  $wp_customize->add_setting('meta_taglabel', array(
    'default'   => 'show',
    'transport' => 'refresh'
  ));
  $wp_customize->add_control('meta_taglabel', array(
    'label'      => __('Show the word &ldquo;Tag&rdquo; on the tag page', 'utthehill'),
    'section'    => 'meta-infomation',
    'settings'   => 'meta_taglabel',
    'default'    => 'show',
    'type'       => 'radio',
    'choices'    => array(
      'show'   => 'Show',
      'hide'  => 'Hide',
    ),
  ));
  // Show the word "Year" on the month page
  $wp_customize->add_setting('meta_yearlabel', array(
    'default'   => 'show',
    'transport' => 'refresh'
  ));
  $wp_customize->add_control('meta_yearlabel', array(
    'label'      => __('Show the &ldquo;Year Archives&rdquo; label on the yearly archive page', 'utthehill'),
    'section'    => 'meta-infomation',
    'settings'   => 'meta_yearlabel',
    'default'    => 'show',
    'type'       => 'radio',
    'choices'    => array(
      'show'   => 'Show',
      'hide'  => 'Hide',
    ),
  ));
  // Show the word "Year" on the month page
  $wp_customize->add_setting('meta_daylabel', array(
    'default'   => 'show',
    'transport' => 'refresh'
  ));
  $wp_customize->add_control('meta_daylabel', array(
    'label'      => __('Show the &ldquo;Day Archives&rdquo; label on the daily archive page', 'utthehill'),
    'section'    => 'meta-infomation',
    'settings'   => 'meta_daylabel',
    'default'    => 'show',
    'type'       => 'radio',
    'choices'    => array(
      'show'   => 'Show',
      'hide'  => 'Hide',
    ),
  ));


  // Content vs Excerpt on Archive Pages
  $wp_customize->add_setting('meta_excerpt', array(
    'default'   => 'excerpt',
    'transport' => 'refresh'
  ));
  $wp_customize->add_control('meta_excerpt', array(
    'label'      => __('On archive pages show the excerpt or content', 'utthehill'),
    'section'    => 'meta-infomation',
    'settings'   => 'meta_excerpt',
    'type'       => 'radio',
    'default'    => 'show',
    'choices'    => array(
      'excerpt'  => 'Excerpt',
      'content'  => 'Content',
    ),
  ));





  $wp_customize->add_section('meta-infomation' , array(
      'title' => __('Meta Information Appearance','utthehill'),
  ));


  // Brand and Appearence Settings
  // ===================================================================

  // Typeface
  $wp_customize->add_setting('brand_type', array(
    'default'   => 'sanserif',
    'transport' => 'refresh'
  ));
  $wp_customize->add_control('brand_type', array(
    'label'      => __('Typestyle', 'utthehill'),
    'section'    => 'brand_appearance',
    'settings'   => 'brand_type',
    'default'    => 'sanserif',
    'type'       => 'radio',
    'choices'    => array(
      'sanserif'   => 'Sans-Serif',
      'serif'  => 'Serif',
      'mixedserif'  => 'Mixed Serif',
    ),
  ));

   // Use Gotham
   $wp_customize->add_setting('brand_gotham', array(
     'default'   => '0',
     'transport' => 'refresh'
   ));
   $wp_customize->add_control('brand_gotham', array(
     'label'      => __('Use Gotham', 'utthehill'),
     'section'    => 'brand_appearance',
     'settings'   => 'brand_gotham',
     'type'       => 'radio',
     'choices'    => array(
       ''   => 'System',
       '1'  => 'Gotham',
//       'gotham-alt'  => 'Alternative Headlines: Heavy',
//       'gotham-alt-light'  => 'Alternative Headlines: Light',
     ),
   ));

  // Color Scheme
  $wp_customize->add_setting('brand_color', array(
    'default'   => 'rock',
    'transport' => 'refresh'
  ));
  $wp_customize->add_control('brand_color', array(
    'label'      => __('Color Scheme', 'utthehill'),
    'section'    => 'brand_appearance',
    'settings'   => 'brand_color',
    'default'    => 'white',
    'type'       => 'radio',
    'choices'    => array(
      'orange' => 'Orange',
      'white'   => 'White',
      'limestone' => 'Limestone',
      'smokey' => 'Smokey',
      'torch' => 'Torch',
      'river' => 'River',
      'rock' => 'Rock',
      'eureka' => 'Eureka',
      'switchgrass' => 'Switchgrass',
      'valley' => 'Valley',
      'leconte' => 'Leconte',
      'summitt' => 'Summitt',
      'globe' => 'Globe',
      'sunsphere' => 'Sunsphere',
      'regalia' => 'Regalia',
      'legacy' => 'Legacy',
      'buckskin' => 'Buckskin',
      'fountain' => 'Fountain',
      'energy' => 'Energy',
    ),
  ));
  $wp_customize->add_section('brand_appearance' , array(
      'title' => __('Brand Appearance','utthehill'),
      'description' => __('<h1>Brand specific settings.</h1><p> Gotham is a commercial typeface requires a font licensing fee based upon page views. You can license it yourself through <a href="http://typography.com">typography.com</a> or you can contact Communications and Marketing for more information.</p>','utthehill'),
  ));





  // Single Post Settings
  // ===================================================================

  // Byline
  $wp_customize->add_setting('single_show_byline', array(
    'default'   => 'show',
    'transport' => 'refresh'
  ));
  $wp_customize->add_control('single_show_byline', array(
    'label'      => __('Show the author&rsquo;s byline', 'utthehill'),
    'section'    => 'post_settings',
    'settings'   => 'single_show_byline',
    'default'    => 'hide',
    'type'       => 'radio',
    'choices'    => array(
      'show'   => 'Show',
      'hide'  => 'Hide',
    ),
  ));
 // Show the published date
  $wp_customize->add_setting('single_show_pubdate', array(
    'default'   => 'show',
    'transport' => 'refresh'
  ));
  $wp_customize->add_control('single_show_pubdate', array(
    'label'      => __('Show the published date', 'utthehill'),
    'section'    => 'post_settings',
    'settings'   => 'single_show_pubdate',
    'default'    => 'hide',
    'type'       => 'radio',
    'choices'    => array(
      'show'   => 'Show',
      'hide'  => 'Hide',
    ),
  ));
 // Show the categories
  $wp_customize->add_setting('single_show_cats', array(
    'default'   => 'show',
    'transport' => 'refresh'
  ));
  $wp_customize->add_control('single_show_cats', array(
    'label'      => __('Show the categories', 'utthehill'),
    'section'    => 'post_settings',
    'settings'   => 'single_show_cats',
    'default'    => 'hide',
    'type'       => 'radio',
    'choices'    => array(
      'show'   => 'Show',
      'hide'  => 'Hide',
    ),
  ));
 // Show the tags
  $wp_customize->add_setting('single_show_tags', array(
    'default'   => 'show',
    'transport' => 'refresh'
  ));
  $wp_customize->add_control('single_show_tags', array(
    'label'      => __('Show the tags', 'utthehill'),
    'section'    => 'post_settings',
    'settings'   => 'single_show_tags',
    'default'    => 'hide',
    'type'       => 'radio',
    'choices'    => array(
      'show'   => 'Show',
      'hide'  => 'Hide',
    ),
  ));


 // Show the pager
  $wp_customize->add_setting('single_show_pager', array(
    'default'   => 'show',
    'transport' => 'refresh'
  ));
  $wp_customize->add_control('single_show_pager', array(
    'label'      => __('Show the pager navigation', 'utthehill'),
    'section'    => 'post_settings',
    'settings'   => 'single_show_pager',
    'default'    => 'hide',
    'type'       => 'radio',
    'choices'    => array(
      'show'   => 'Show',
      'hide'  => 'Hide',
    ),
  ));


  $wp_customize->add_section('post_settings' , array(
      'title' => __('Single Post Settings','utthehill'),
      'description' => __('<h1>Single Post View Settings.</h1><p>These settings affect the post view, not the archive view of the posts.</p>','utthehill'),
  ));

 
 
 // Show the sidebar on posts
  $wp_customize->add_setting('single_show_sidebar', array(
    'default'   => 'show',
    'transport' => 'refresh'
  ));
  $wp_customize->add_control('single_show_sidebar', array(
    'label'      => __('Show the main sidebar on single posts', 'utthehill'),
    'section'    => 'post_settings',
    'settings'   => 'single_show_sidebar',
    'default'    => 'hide',
    'type'       => 'radio',
    'choices'    => array(
      'show'   => 'Show',
      'hide'  => 'Hide',
    ),
  ));


  $wp_customize->add_section('post_settings' , array(
      'title' => __('Single Post Settings','utthehill'),
      'description' => __('<h1>Single Post View Settings.</h1><p>These settings affect the post view, not the archive view of the posts.</p>','utthehill'),
  ));




  // Site Mode
  // ===================================================================

   // Home Entry Layout
   $wp_customize->add_setting('site_mode_layout', array(
    'default'   => 'standard',
    'transport' => 'refresh'
   ));
   $wp_customize->add_control('site_mode_layout', array(
     'label'      => __('Entry Layout', 'utthehill'),
     'section'    => 'site_mode',
     'settings'   => 'site_mode_layout',
     'default'    => 'standard',
     'type'       => 'radio',
     'choices'    => array(
     'standard'   => 'Classic',
     'webapp'     => 'Full-Width',
     ),
   ));
   $wp_customize->add_section('site_mode' , array(
      'title' => __('Site Mode','utthehill'),
      'description' => __('<h1>Brand specific settings.</h1><p> Gotham is a commercial typeface requires a font licensing fee based upon page views. You can license it yourself through <a href="http://typography.com">typography.com</a> or you can contact Communications and Marketing for more information.</p> <p>The color scheme settings are only available in Hill Classic mode.</p>','utthehill'),
      'capability' =>  __('administrator','utthehill'),
   ));


  // Contact Info
  // ===================================================================

  // Phone Label 1
  $wp_customize->add_setting('contactinfo_phone1label', array());
  $wp_customize->add_control('contactinfo_phone1label', array(
    'label'      => __('Phone Label 1', 'utthehill'),
    'section'    => 'contact_info',
    'settings'   => 'contactinfo_phone1label',
    'type'       => 'text'
  ));
  // Phone Number 1
  $wp_customize->add_setting('contactinfo_phone1number', array());
  $wp_customize->add_control('contactinfo_phone1number', array(
    'label'      => __('Phone Number 1', 'utthehill'),
    'section'    => 'contact_info',
    'settings'   => 'contactinfo_phone1number',
    'type'       => 'text'
  ));
  // Phone Label 2
  $wp_customize->add_setting('contactinfo_phone2label', array());
  $wp_customize->add_control('contactinfo_phone2label', array(
    'label'      => __('Phone Label 2', 'utthehill'),
    'section'    => 'contact_info',
    'settings'   => 'contactinfo_phone2label',
    'type'       => 'text'
  ));
  // Phone Number 2
  $wp_customize->add_setting('contactinfo_phone2number', array());
  $wp_customize->add_control('contactinfo_phone2number', array(
    'label'      => __('Phone Number 2', 'utthehill'),
    'section'    => 'contact_info',
    'settings'   => 'contactinfo_phone2number',
    'type'       => 'text'
  ));
  // Phone Label 3
  $wp_customize->add_setting('contactinfo_phone3label', array());
  $wp_customize->add_control('contactinfo_phone3label', array(
    'label'      => __('Phone Label 3', 'utthehill'),
    'section'    => 'contact_info',
    'settings'   => 'contactinfo_phone3label',
    'type'       => 'text'
  ));
  // Phone Number 3
  $wp_customize->add_setting('contactinfo_phone3number', array());
  $wp_customize->add_control('contactinfo_phone3number', array(
    'label'      => __('Phone Number 3', 'utthehill'),
    'section'    => 'contact_info',
    'settings'   => 'contactinfo_phone3number',
    'type'       => 'text'
  ));

  // Email
  $wp_customize->add_setting('contactinfo_email1label', array());
  $wp_customize->add_control('contactinfo_email1label', array(
    'label'      => __('Email Label', 'utthehill'),
    'section'    => 'contact_info',
    'settings'   => 'contactinfo_email1label',
    'type'       => 'text'
  ));
  // Email Address
  $wp_customize->add_setting('contactinfo_email1address', array());
  $wp_customize->add_control('contactinfo_email1address', array(
    'label'      => __('Email Address', 'utthehill'),
    'section'    => 'contact_info',
    'settings'   => 'contactinfo_email1address',
    'type'       => 'text'
  ));


  // Address
  $wp_customize->add_setting('contactinfo_address', array());
  $wp_customize->add_control('contactinfo_address', array(
    'label'      => __('Address', 'utthehill'),
    'section'    => 'contact_info',
    'settings'   => 'contactinfo_address',
    'type'       => 'textarea'
  ));
  // Map URL (from maps.utk.edu)
  $wp_customize->add_setting('contactinfo_map', array( 'sanitize_callback' => 'themeslug_sanitize_url' ));
  $wp_customize->add_control('contactinfo_map', array(
    'label'      => __('Map Link', 'utthehill'),
    'section'    => 'contact_info',
    'description' => __( 'Add a link to your office from maps.utk.edu.' ),
    'settings'   => 'contactinfo_map',
    'type'       => 'url'
  ));

function themeslug_sanitize_url( $url ) {
  return esc_url_raw( $url );
}
  // General Info
  $wp_customize->add_setting('contactinfo_general', array());
  $wp_customize->add_control('contactinfo_general', array(
    'label'      => __('General Info', 'utthehill'),
    'section'    => 'contact_info',
    'settings'   => 'contactinfo_general',
    'type'       => 'textarea'
  ));

  // Show Comments
  $wp_customize->add_setting('contactinfo_comments', array());
  $wp_customize->add_control('contactinfo_comments', array(
    'label'      => __('Allow comments?', 'utthehill'),
    'section'    => 'contact_info',
    'settings'   => 'contactinfo_comments',
    'default'    => 'no',
    'type'       => 'radio',
    'choices'    => array(
    'allow'      => 'Allow',
    'no'         => 'No Comments',
    ),
    
    
  ));




  // Social Media in this section

  // Twitter URL
  $wp_customize->add_setting('socialmedia_twitter', array(
                'sanitize_callback' => 'esc_url_raw' //cleans URL from all invalid characters
            ));
  $wp_customize->add_control('socialmedia_twitter', array(
    'label'      => __('Twitter URL', 'utthehill'),
    'section'    => 'contact_info',
    'settings'   => 'socialmedia_twitter',
    'type'       => 'url'
  ));
  // Facebook URL
  $wp_customize->add_setting('socialmedia_facebook', array(
                'sanitize_callback' => 'esc_url_raw' //cleans URL from all invalid characters
            ));
  $wp_customize->add_control('socialmedia_facebook', array(
    'label'      => __('Facebook URL', 'utthehill'),
    'section'    => 'contact_info',
    'settings'   => 'socialmedia_facebook',
    'type'       => 'url'
  ));
  // LinkedIn URL
  $wp_customize->add_setting('socialmedia_linkedin', array(
                'sanitize_callback' => 'esc_url_raw' //cleans URL from all invalid characters
            ));
  $wp_customize->add_control('socialmedia_linkedin', array(
    'label'      => __('LinkedIn URL', 'utthehill'),
    'section'    => 'contact_info',
    'settings'   => 'socialmedia_linkedin',
    'type'       => 'url'
  ));
  // YouTube URL
  $wp_customize->add_setting('socialmedia_youtube', array(
                'sanitize_callback' => 'esc_url_raw' //cleans URL from all invalid characters
            ));
  $wp_customize->add_control('socialmedia_youtube', array(
    'label'      => __('YouTube URL', 'utthehill'),
    'section'    => 'contact_info',
    'settings'   => 'socialmedia_youtube',
    'type'       => 'url'
  ));
  // Snapchat URL
  $wp_customize->add_setting('socialmedia_snapchat', array(
                'sanitize_callback' => 'esc_url_raw' //cleans URL from all invalid characters
            ));
  $wp_customize->add_control('socialmedia_snapchat', array(
    'label'      => __('Snapchat URL', 'utthehill'),
    'section'    => 'contact_info',
    'settings'   => 'socialmedia_snapchat',
    'type'       => 'url'
  ));
  // WeeChat URL
  $wp_customize->add_setting('socialmedia_weechat', array(
                'sanitize_callback' => 'esc_url_raw' //cleans URL from all invalid characters
            ));
  $wp_customize->add_control('socialmedia_weechat', array(
    'label'      => __('WeeChat URL', 'utthehill'),
    'section'    => 'contact_info',
    'settings'   => 'socialmedia_weechat',
    'type'       => 'url'
  ));
  // Pinterest URL
  $wp_customize->add_setting('socialmedia_pin', array(
                'sanitize_callback' => 'esc_url_raw' //cleans URL from all invalid characters
            ));
  $wp_customize->add_control('socialmedia_pin', array(
    'label'      => __('Pinterest URL', 'utthehill'),
    'section'    => 'contact_info',
    'settings'   => 'socialmedia_pin',
    'type'       => 'url'
  ));
  // Instagram URL
  $wp_customize->add_setting('socialmedia_insta', array(
                'sanitize_callback' => 'esc_url_raw' //cleans URL from all invalid characters
            ));
  $wp_customize->add_control('socialmedia_pin', array(
    'label'      => __('Instagram URL', 'utthehill'),
    'section'    => 'contact_info',
    'settings'   => 'socialmedia_insta',
    'type'       => 'url'
  ));
  // Goodreads URL
  $wp_customize->add_setting('socialmedia_goodr', array(
                'sanitize_callback' => 'esc_url_raw' //cleans URL from all invalid characters
            ));
  $wp_customize->add_control('socialmedia_goodr', array(
    'label'      => __('Goodreads URL', 'utthehill'),
    'section'    => 'contact_info',
    'settings'   => 'socialmedia_goodr',
    'type'       => 'url'
  ));
  // Vimeo URL
  $wp_customize->add_setting('socialmedia_vime', array(
                'sanitize_callback' => 'esc_url_raw' //cleans URL from all invalid characters
            ));
  $wp_customize->add_control('socialmedia_vime', array(
    'label'      => __('Vimeo URL', 'utthehill'),
    'section'    => 'contact_info',
    'settings'   => 'socialmedia_vime',
    'type'       => 'url'
  ));
  // Sound Cloud URL
  $wp_customize->add_setting('socialmedia_sound', array(
                'sanitize_callback' => 'esc_url_raw' //cleans URL from all invalid characters
            ));
  $wp_customize->add_control('socialmedia_sound', array(
    'label'      => __('Soundcloud URL', 'utthehill'),
    'section'    => 'contact_info',
    'settings'   => 'socialmedia_sound',
    'type'       => 'url'
  ));
  // Slack URL
  $wp_customize->add_setting('socialmedia_slac', array(
                'sanitize_callback' => 'esc_url_raw' //cleans URL from all invalid characters
            ));
  $wp_customize->add_control('socialmedia_slac', array(
    'label'      => __('Slack URL', 'utthehill'),
    'section'    => 'contact_info',
    'settings'   => 'socialmedia_slac',
    'type'       => 'url'
  ));




   $wp_customize->add_section('contact_info' , array(
      'title' => __('Contact Info','utthehill'),
      'description' => __('<p>This information will appear in the footer of your site.</p>','utthehill'),
   ));




  // Menu System
  // ===================================================================

  // Menu Options
  $wp_customize->add_setting('menu_options', array(
    'default'   => 'single',
    'transport' => 'refresh'
  ));
  $wp_customize->add_control('menu_options', array(
    'label'      => __('Menu Styles', 'utthehill'),
    'section'    => 'menu_style',
    'settings'   => 'menu_options',
    'default'    => 'single',
    'type'       => 'radio',
    'choices'    => array(
      'single'     => 'Single',
      'multiple'   => 'Multiple',
    ),
  ));
  // Mobile Menu Options
  $wp_customize->add_setting('menu_mobile_options', array(
    'default'   => 'flatlist',
    'transport' => 'collapse'
  ));
  $wp_customize->add_control('menu_mobile_options', array(
    'label'      => __('Menu Mobile Styles (Single Menu Only)', 'utthehill'),
    'section'    => 'menu_style',
    'settings'   => 'menu_mobile_options',
    'default'    => 'flatlist',
    'type'       => 'radio',
    'choices'    => array(
      'collapse'     => 'Collapse',
      'flatlist'   => 'Flat List',
    ),
  ));
  // Navigation Style
  $wp_customize->add_setting('navigation_style', array(
    'default'   => 'sideways',
    'transport' => 'refresh'
  ));
  $wp_customize->add_control('navigation_style', array(
    'label'      => __('Navigation Style', 'utthehill'),
    'section'    => 'menu_style',
    'settings'   => 'navigation_style',
    'default'    => 'sideways',
    'type'       => 'radio',
    'choices'    => array(
      'flyout'     => 'Classic: Flyout',
      'sideways'   => 'Classic: Sideways Dropdown',
    ),
  ));
  // Show Home Button
  $wp_customize->add_setting('menu_homebutton', array(
    'default'   => 'checked',
    'transport' => 'refresh'
  ));
  $wp_customize->add_control('menu_homebutton', array(
    'label'      => __('Show Home Button In Menu', 'utthehill'),
    'section'    => 'menu_style',
    'settings'   => 'menu_homebutton',
    'default'    => 1,
    'type'       => 'checkbox',
  ));

  // Giving Bar
  $wp_customize->add_setting('menu_givingoption', array(
        'default'   => 'giving',
        'transport' => 'refresh'
  ));
  $wp_customize->add_control('menu_givingoption', array(
    'label'      => __('Show Give Button In Menu', 'utthehill'),
    'section'    => 'menu_style',
    'settings'   => 'menu_givingoption',
    'default'    => 'standard',
    'type'       => 'radio',
    'choices'    => array(
      'giving'        => 'Default Giving',
      'giving-no'     => 'No Giving Link',
      'giving-custom' => 'Custom Link',
    ),
  ));
  // Giving To
  $wp_customize->add_setting('menu_giveto', array());
  $wp_customize->add_control('menu_giveto', array(
    'label'      => __('Who do we give to?', 'utthehill'),
    'section'    => 'menu_style',
    'settings'   => 'menu_giveto',
    'type'       => 'text'
  ));
  // Giving Link
  $wp_customize->add_setting('menu_givelink', array());
  $wp_customize->add_control('menu_givelink', array(
    'label'      => __('The custom link', 'utthehill'),
    'section'    => 'menu_style',
    'settings'   => 'menu_givelink',
    'type'       => 'text'
  ));

  // What kind os search
  $wp_customize->add_setting('search_style', array(
    'default'   => 'search_find_a_page',
    'transport' => 'refresh'
  ));
  $wp_customize->add_control('search_style', array(
    'label'      => __('Search Style', 'utthehill'),
    'section'    => 'menu_style',
    'settings'   => 'search_style',
    'default'    => 'sideways',
    'type'       => 'radio',
    'choices'    => array(
      'search_find_a_page'     => 'Find a Page Wordpress Search',
      'search_google'   => 'UT Google Custom Search',
      'search_wp'   => 'WordPress Native Search',
      'search_no'   => 'No Search',
    ),
  ));

  $wp_customize->add_section('menu_style' , array(
      'title' => __('Menu System','utthehill'),
  ));





}
add_action( 'customize_register', 'Utnews2017_customize_register' );


