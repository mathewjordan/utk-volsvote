<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
  <!--[if lt IE 10]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script></script><![endif]-->


<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/images/interface/icon-114x114.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/images/interface/icon-72x72.png">
<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/interface/icon-114x114.png">
<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/interface/favicon.gif">	
<?php
// If it is the front page and the homepage headline option is turned on
  $brand_gotham = get_theme_mod( 'brand_gotham' );
  if ($brand_gotham=="1") { ?>
    <link rel="stylesheet" type="text/css" href="//cloud.typography.com/6831932/618846/css/fonts.css" />
  <?php } elseif ($brand_gotham=="gotham-alt" || $brand_gotham=="gotham-alt-light" ) { ?>
    <link rel="stylesheet" type="text/css" href="//cloud.typography.com/6831932/7665612/css/fonts.css" />
  <?php  
  }else{  ?><?php } ?>

<?php wp_head(); ?>


</head>