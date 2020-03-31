<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Auto_Loan_Calculators
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area">

	<a id="embed-widget-btn" href="#">Add Loan Calculator to Website</a><!--#embed-widget-btn-->

	<?php 
		$ip_address = $_SERVER['REMOTE_ADDR'];
		$access_key = '18b19bb66fdbc1efd30acc384d8d9da6';

		$ch = curl_init('http://api.ipstack.com/'.$ip_address.'?access_key='.$access_key.'');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		// Store the data:
		$json = curl_exec($ch);
		curl_close($ch);

		// Decode JSON response:
		$api_result = json_decode($json, true);

		// Store the zipcode of the IP address in a local variable
		// echo '<pre>' . print_r($api_result) . '</pre>';
		$result_city = $api_result['city'];
		$result_state = $api_result['region_name'];
		$result_zip = $api_result['zip'];

		// Setup the args for the custom WP_Query to generate the featured partner based on IP
		function my_posts_where( $where ) {
			$where = str_replace("meta_key = 'zip_codes_$", "meta_key LIKE 'zip_codes_%", $where);
			return $where;
		}
		add_filter('posts_where', 'my_posts_where');

		$args = array(
			'post_type' 	=> 'partner',
			'meta_query'	=> array(
				'relation'	=> 'OR',
				array(
					'key'		=> 'city',
					'compare'	=> '=',
					'value'		=> $result_city
				),
				array(
					'key'		=> 'state',
					'compare'	=> '=',
					'value'		=> $result_state
				),
				array(
					'key'		=> 'zip_codes_$_zip_code',
					'compare'	=> '=',
					'value'		=> $result_zip
				)
			)
		);
		$partner_query = new WP_Query($args);
	?>
	<?php if ($partner_query->have_posts()) : ?>
		<?php while ($partner_query->have_posts()) : $partner_query->the_post(); ?>
			<div class="ad-widget featured-partner-widget sidebar-widget">
				<h4 class="partner-header">Featured Partner</h4><!--.partner-header-->
				<h5 class="partner-title"><?php the_title(); ?></h5><!--.partner-title-->
				<?php $logo = get_field('logo'); ?>
				<img class="partner-logo" src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>" /><!--.partner-logo-->
				<div class="partner-contact">
					<a class="partner-phone" href="tel:<?php the_field('phone_number'); ?>"><?php the_field('phone_number'); ?></a>
					<a class="partner-form" href="#" data-form-email="<?php the_field('contact_link'); ?>">Contact Partner</a>
				</div><!--.partner-contact-->
			</div><!--.ad-widget.featured-partner-widget.sidebar-widget-->
		<?php endwhile; ?>
		<?php wp_reset_query(); ?>
	<?php endif; ?>

	<?php if (get_field('ad_type')) : ?>
		<div class="ad-widget sidebar-widget">
			<?php $ad_type = get_field('ad_type'); ?>
			<?php if ($ad_type == 'image') : ?>
				<?php if (have_rows('ad_image')) : ?>
					<?php while (have_rows('ad_image')) : the_row(); ?>
					<a class="ad-widget-link" href="<?php the_sub_field('link'); ?>" target="_blank">
						<?php $ad_img = get_sub_field('image'); ?>
						<img class="ad-widget-img" src="<?php echo $ad_img['url']; ?>" alt="<?php echo $ad_img['alt']; ?>" /><!--.ad-widget-img-->
					</a><!--.ad-widget-link-->
					<?php endwhile; ?>
				<?php endif; ?>
			<?php elseif ($ad_type == 'script') : ?>
				<?php the_field('ad_script'); ?>
			<?php endif; ?>
		</div><!--.ad-widget.sidebar-widget-->
	<?php endif; ?>

	<div id="helpful-posts-widget" class="sidebar-widget">
		<h3 class="widget-title">Helpful Articles</h3><!--.widget-title-->
		<?php $args = array(
			'post_type' => 'post'
		); ?>
		<?php $the_query = new WP_Query($args); ?>
		<?php if ($the_query->have_posts()) : ?>
			<?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
				<article class="helpful-post">
					<h4 class="helpful-post-title">
						<a class="helpful-post-link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h4><!--.helpful-post-title-->
				</article><!--.helpful-post-->
			<?php endwhile; ?>
			<?php wp_reset_query(); ?>
		<?php endif; ?>
	</div><!--#helpful-posts-widget.sidebar-widget-->

</aside><!-- #secondary -->
