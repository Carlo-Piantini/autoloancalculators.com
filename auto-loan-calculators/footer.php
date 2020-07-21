<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Auto_Loan_Calculators
 */

?>
		</div><!--.inner-->
	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="site-info inner">
			<?php if (get_field('footer_logo', 'options')) : ?>
				<?php $footer_logo = get_field('footer_logo', 'options'); ?>
				<a id="footer-logo" href="<?php echo bloginfo('url'); ?>">
					<img class="logo-img" src="<?php echo $footer_logo['url']; ?>" alt="<?php echo $footer_logo['alt']; ?>">
				</a><!--#site-logo-->
			<?php endif; ?>

			<?php if (get_field('footer_copy', 'options')) : ?>
				<p id="footer-copy"><?php the_field('footer_copy', 'options'); ?></p><!--#footer-copy-->
			<?php endif; ?>

			<span id="site-copyright">&#169; 2020 - Auto Loan Calculators - Developed by Carlo Piantini</span><!--#site-copyright-->
			<a id="site-privacy" href="/privacy-policy">Terms of Use and Privacy Policy</a><!--#site-privacy-->
		</div><!-- .site-info -->

		<div class="modal-wrap featured-partner-wrap">
			<div class="modal-overlay"></div><!--.modal-overlay-->
			<div id="featured-partner-modal">
				<a class="modal-close" href="#"></a><!--.modal-close-->
				<?php get_template_part('template-parts/forms/featured-partner-form'); ?>
			</div><!--#featured-partner-modal-->
		</div><!--.modal-wrap-->
		<div class="modal-wrap">
			<div class="modal-overlay"></div><!--.modal-overlay-->
			<div id="new-car-modal" class="modal-body">
				<a class="modal-close" href="#"></a><!--.modal-close-->
				<?php get_template_part('template-parts/forms/new-car-form'); ?>
			</div><!--#new-car-modal-->
		</div><!--.modal-wrap-->
		<div class="modal-wrap">
			<div class="modal-overlay"></div><!--.modal-overlay-->
			<div id="widget-modal" class="modal-body">
				<a class="modal-close" href="#"></a><!--.modal-close-->
				<?php get_template_part('template-parts/modals/calc-widget'); ?>
			</div><!--#widget-modal-->
		</div><!--.modal-wrap-->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
