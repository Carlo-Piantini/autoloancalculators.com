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

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php if (is_user_logged_in()) : ?>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'auto-loan-calculators'); ?></a>

		<header id="masthead" class="site-header">
			<div id="top-navigation-bar">
				<div class="inner">
					<a id="site-logo" href="<?php echo bloginfo('url'); ?>">Your Site Logo - AutoLoanCalculators.com</a><!--#site-logo-->
					<nav id="top-navigation">
						<?php wp_nav_menu(array(
							'theme_location' => 'top',
							'menu_id'        => 'top-menu',
							'menu_class'	 => 'site-menu',
							'container'		 => false
						));
						?>
					</nav><!--#top-navigation-->
				</div><!--.inner-->
			</div><!--#top-navigation-bar-->
			
			<div id="site-navigation-bar">
				<div class="inner">
					<nav id="site-navigation">
						<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'auto-loan-calculators' ); ?></button>
						<?php wp_nav_menu( array(
							'theme_location' => 'primary',
							'menu_id'        => 'primary-menu',
							'menu_class'	 => 'site-menu',
							'container'		 => false
						) );
						?>
					</nav><!-- #site-navigation -->
					<a id="new-price-cta" class="modal-btn" data-modal="new-car-modal" href="#">New Car Price Quote</a><!--#new-price-cta-->
				</div><!--.inner-->
			</div><!--#site-navigation-bar-->
		</header><!-- #masthead -->

		<div id="content" class="site-content">
			<div class="inner">
<?php else : ?>
	<div id="page" class="site coming-soon">
		<h1 id="coming-soon-header">A New WordPress Site</h1><!--#coming-soon-header-->
		<h2 id="coming-soon-subheader">Coming Soon!</h2><!--#coming-soon-subheader-->
		<a id="coming-soon-login" href="/wp-admin">Admin Login</a><!--#coming-soon-login-->
	</div>
<?php endif; ?>