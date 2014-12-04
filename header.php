<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package colaba
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	
	<div class="header-area full" style="background-color:#2C3E50;"> 
		<div class="main-page">
			<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'colaba' ); ?></a>

			<header id="masthead" class="site-header inner" role="banner">
				<div class="site-branding">
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<!--><h2 class="site-description"><?php //bloginfo( 'description' ); ?></h2><!-->
					<nav id="site-navigation" class="main-navigation" role="navigation">
						<button class="menu-toggle"><?php _e( 'Primary Menu', 'colaba' ); ?></button>
						<?php wp_nav_menu( array( 'theme_location' => 'primary', 'fallback_cb'=>'__return_false' ) ); ?>
					</nav><!-- #site-navigation -->
				</div>

				
			</header><!-- #masthead -->
		</div><!--main-page-->
	</div> <!--header-area-->	

	<div class="main-content-area full"> 
		<div class="main-page">
			<div id="content" class="site-content inner">
