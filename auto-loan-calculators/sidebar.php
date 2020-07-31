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

	<a id="embed-widget-btn" class="modal-btn" data-modal="widget-modal" href="#">Free Auto Loan Calculator For Your Website</a><!--#embed-widget-btn-->

	<?php
		// Setting up the URL info the for the cURL request to the IP location API
		$ip_address = $_SERVER['REMOTE_ADDR'];
		$access_key = '18b19bb66fdbc1efd30acc384d8d9da6';
		// Opening up the cURL request and setting it up for data transfer
		$ch = curl_init('http://api.ipstack.com/'.$ip_address.'?access_key='.$access_key.'');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// Grab the data and close out the cURL request
		$json = curl_exec($ch);
		curl_close($ch);
		// Decode JSON response:
		$api_result = json_decode($json, true);

		// Store the zipcode, city, and state of the IP address in local variables
		$result_zip = $api_result['zip'];
		$result_city = $api_result['city'];
		$result_state = $api_result['region_name'];

		// Include DB connection for the mile-radius zip-code locator
		require('inc/phpsqlsearch_dbinfo.php');		

		// Setup the args for the custom WP_Query to generate the featured partner based on IP
		function my_posts_where_zip( $where ) {
			$where = str_replace("meta_key = 'zip_codes_$", "meta_key LIKE 'zip_codes_%", $where);
			return $where;
		}
		add_filter('posts_where', 'my_posts_where_zip');

		function my_posts_where_city( $where ) {
			$where = str_replace("meta_key = 'cities_$", "meta_key LIKE 'cities_%", $where);
			return $where;
		}
		add_filter('posts_where', 'my_posts_where_city');

		function my_posts_where_state( $where ) {
			$where = str_replace("meta_key = 'states_$", "meta_key LIKE 'states_%", $where);
			return $where;
		}
		add_filter('posts_where', 'my_posts_where_state');
		// Create the custom WP query for the location-targeted featured partners
		$args = array(
			'posts_per_page'	=> 1,
			'post_type' 		=> 'partner',
			'meta_query'		=> array(
				'relation'		=> 'AND',
				array(
					'key'			=> 'filter_settings',
					'compare'		=> '!=',
					'value'			=> 'ad_only'
				),
				array(
					'relation'		=> 'OR',
					array(
						'key'		=> 'nationwide',
						'compare'	=> '=',
						'value'		=> 'yes'
					),
					array(
						'key'		=> 'cities_$_city',
						'compare'	=> '=',
						'value'		=> $result_city
					),
					array(
						'key'		=> 'states_$_state',
						'compare'	=> '=',
						'value'		=> $result_state
					),
					array(
						'key'		=> 'zip_codes_$_zip_code',
						'compare'	=> '=',
						'value'		=> $result_zip
					),
				),
			),
		);
		$args_i = 3; // Going to add each of the returned database zipcodes within radius to the new WP Query to search for partner entries connected to those zips
		foreach ($query_zipcodes as $query_zipcode) {
			$args['meta_query'][1][$args_i] = array(
				'key'		=> 'zip_codes_$_zip_code',
				'compare'	=> '=',
				'value'		=> $query_zipcode,
			);
			$args_i++;
		}
		// Initialize the new query
		$partner_query = new WP_Query($args);
	?>
	<?php if ($partner_query->have_posts()) : ?>
		<?php while ($partner_query->have_posts()) : $partner_query->the_post(); ?>
			<div class="ad-widget featured-partner-widget sidebar-widget">
				<?php if (get_field('sidebar_ad_type') == 'text') : ?>
					<h4 class="partner-header">Featured Partner</h4><!--.partner-header-->
					<div class="partner-content">
						<?php $logo = get_field('logo'); ?>
						<?php $account_number = get_post_meta($post->ID, 'account_number'); ?>
						<a class="partner-link" href="<?php the_field('link'); ?>" target="_blank"><img class="partner-logo" src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>" /><!--.partner-logo--></a>
						<div class="partner-copy">
							<?php if (get_field('show_name') == 'yes') : ?>
								<h5 class="partner-title"><?php the_title(); ?></h5><!--.partner-title-->
							<?php endif; ?>
							<?php if (get_field('optional_text')) : ?>
								<p class="partner-opt-text"><?php the_field('optional_text'); ?></p>
							<?php endif; ?>
							<div class="partner-contact">
								<a class="partner-phone" href="tel:<?php the_field('phone_number'); ?>"><?php the_field('phone_number'); ?></a>
								<a class="featured-modal-btn" href="#" data-partner-email="<?php the_field('featured_partner_email_address'); ?>" data-heading="Contact <?php the_title(); ?>" data-instructions="<?php the_field('instructions'); ?>" data-disclaimer="<?php the_field('disclaimer_text'); ?>" data-account-number="<?php echo $account_number[0]; ?>"><?php the_field('contact_label'); ?></a>
							</div><!--.partner-contact-->
						</div><!--.partner-copy-->
					</div><!--.partner-content-->
				<?php elseif (get_field('sidebar_ad_type') == 'image') : ?>
					<?php if (get_field('button_type_sidebar') == 'link') : ?>
						<?php $partner_ID = get_the_ID(); ?>
						<a class="linkout-btn" data-linkout-type="sidebar" data-partner-id="<?php echo $partner_ID; ?>" href="<?php the_field('button_link_sidebar'); ?>" target="_blank">
							<?php $ad_image = get_field('ad_image'); ?>
							<img class="ad-image" src="<?php echo $ad_image['url']; ?>" alt="<?php echo $ad_image['alt'] ?>" />
						</a>
					<?php elseif (get_field('button_type_sidebar') == 'modal') : ?>
						<?php $account_number = get_post_meta($post->ID, 'account_number'); ?>
						<a class="featured-modal-btn" href="#" data-partner-email="<?php the_field('featured_partner_email_address'); ?>" data-heading="Contact <?php the_title(); ?>" data-instructions="<?php the_field('instructions'); ?>" data-disclaimer="<?php the_field('disclaimer_text'); ?>" data-account-number="<?php echo $account_number[0]; ?>">
							<?php $ad_image = get_field('ad_image'); ?>
							<img class="ad-image" src="<?php echo $ad_image['url']; ?>" alt="<?php echo $ad_image['alt'] ?>" />
						</a>
					<?php endif; ?>
				<?php endif; ?>
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
		<?php if (have_rows('helpful_posts', 'options')) : ?>
			<div id="helpful-posts">
				<?php while (have_rows('helpful_posts', 'options')) : the_row(); ?>
					<?php $post_obj = get_sub_field('post'); ?>
					<?php if ($post_obj) : ?>
						<?php $post = $post_obj; ?>
						<?php setup_postdata($post); ?>
						<article class="helpful-post">
							<h4 class="helpful-post-title">
								<a class="helpful-post-link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h4><!--.helpful-post-title-->
						</article><!--.helpful-post-->
						<?php wp_reset_postdata(); ?>
					<?php endif; ?>
				<?php endwhile; ?>
			</div><!--#helpful-posts-->
		<?php endif; ?>
	</div><!--#helpful-posts-widget.sidebar-widget-->

</aside><!-- #secondary -->
