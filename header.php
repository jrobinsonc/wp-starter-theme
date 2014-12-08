<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url'); ?>">
<title><?php wp_title( '-', true, 'right'); ?></title>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="page" class="hfeed site">

	<header id="masthead" class="site-header" role="banner">
		<h1 class="site-title"><a href="<?php echo esc_url(home_url( '/')); ?>" rel="home"><?php bloginfo( 'name'); ?></a></h1>

		<div class="main-bar">
			
			<nav id="primary-navigation" class="site-navigation" role="navigation">
				<?php wp_nav_menu(array('theme_location' => 'primary')); ?>
			</nav>

			<div class="search-box">
				<?php get_search_form(); ?>
			</div>

			<div class="clearfix"></div>
		</div>

	</header><!-- #masthead -->

	<div id="content" class="site-content">
