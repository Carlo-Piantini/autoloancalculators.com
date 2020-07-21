<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Auto_Loan_Calculators
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/images/favicons/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/images/favicons/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/images/favicons/favicon-16x16.png">

	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-123979751-8"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-123979751-8');
	</script>
	<script data-ad-client="ca-pub-5975099106101279" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'auto-loan-calculators'); ?></a>

		<header id="masthead" class="site-header">
			<div id="top-navigation-bar">
				<div class="inner">
					<?php if (get_field('site_logo', 'options')) : ?>
						<?php $logo = get_field('site_logo', 'options'); ?>
						<a id="site-logo" href="<?php echo bloginfo('url'); ?>">
							<img class="logo-img" src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>">
						</a><!--#site-logo-->
					<?php endif; ?>
					<a id="mobile-toggle" class="inactive" href="#"><span></span></a><!--#mobile-toggle-->
					<nav id="top-navigation">
						<ul id="top-menu" class="site-menu">
							<li><a id="top-widget-btn" class="modal-btn" data-modal="widget-modal" href="#">Free Calculator Widget</a></li>
							<li><a href="http://www.autoloancalculators.com/contact-us/">Contact Us</a></li>
							<li><a id="new-price-cta" class="modal-btn" data-modal="new-car-modal" href="#">New Car Price Quote</a><!--#new-price-cta--></li>
						</ul>
					</nav><!--#top-navigation-->
				</div><!--.inner-->
			</div><!--#top-navigation-bar-->
			
			<div id="site-navigation-bar">
				<div class="inner">
					<nav id="site-navigation">
						<?php wp_nav_menu( array(
							'theme_location' => 'primary',
							'menu_id'        => 'primary-menu',
							'menu_class'	 => 'site-menu',
							'container'		 => false
						) );
						?>
					</nav><!-- #site-navigation -->
				</div><!--.inner-->
			</div><!--#site-navigation-bar-->
		</header><!-- #masthead -->

		<div id="content" class="site-content">
			<div class="inner">