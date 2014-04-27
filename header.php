<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Sans Sidebar Underscores
 */

/**
 * the template for the document <head>
 */
$title = get_bloginfo('name');
$tagline = get_bloginfo('description');
$char = get_bloginfo('charset');
$ping = get_bloginfo('pingback_url');

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php echo $char; ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php echo $ping; ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php do_action( 'before' ); ?>
	<div id="header-area" class="full">
		<div class="main">
			<header id="masthead" class="site-header inner" role="banner">
				<div class="site-branding">
					<h1 class="site-title">
						<?php if ( get_theme_mod( 'ssu_logo' ) ) : ?>
						    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
						        <img src="<?php echo get_theme_mod( 'ssu_logo' ); ?>" alt="<?php echo esc_attr( $title ); ?>">
						    </a>
						<?php else : ?>
						    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( $title ); ?>">
						        <?php echo $title; ?>
						    </a>
						<?php endif; ?>
					</h1>
					<h2 class="site-description"><?php echo $tagline; ?></h2>
				</div>

				<nav id="site-navigation" class="main-navigation" role="navigation">
					<h1 class="menu-toggle"><?php _e( 'Menu', 'ssu' ); ?></h1>
					<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'ssu' ); ?></a>

					<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
				</nav><!-- #site-navigation -->
			</header><!-- #masthead -->
		</div>
	</div>
	
	<div id="content-area" class="full">
		<div class="main">	
			<div id="content" class="site-content">