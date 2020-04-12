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
		<div class="modal-wrap">
			<div class="modal-overlay"></div><!--.modal-overlay-->
			<div id="new-car-modal">
				<a class="modal-close" href="#">X</a><!--.modal-close-->
				<?php get_template_part('template-parts/forms/new-car-form'); ?>
			</div><!--#new-car-modal-->
		</div><!--.modal-wrap-->

		<div class="site-info inner">
			<span id="site-copyright">&#169; 2020 - Auto Loan Calculators - Developed by Carlo Piantini</span><!--#site-copyright-->
			<a id="site-privacy" href="/privacy-policy">Privacy Policy</a><!--#site-privacy-->
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
