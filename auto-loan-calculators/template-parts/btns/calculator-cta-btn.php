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
?>

<?php if ($_SESSION['i'] < 1) : ?>
    <?php $partner = get_sub_field('featured_partner'); ?>
    <?php if ($partner) : ?>
        <?php $post = $partner; ?>
        <?php setup_postdata($post); ?>

        <?php $filter_settings = get_field('filter_settings'); ?>

        <?php if ($filter_settings == 'ad_only' || $filter_settings == 'both') : ?>
            <?php $partner_nationwide = get_field('nationwide'); ?>
            <?php $partner_state = get_field('state'); ?>

            <?php $button_type = get_field('button_type'); ?>

            <?php if ($partner_nationwide == 'yes') : ?>
                <?php $_SESSION['match_switch'] = true; ?>
            <?php endif; ?>

            <?php if (!$_SESSION['match_switch']) : ?>
                <?php if (have_rows('zip_codes')) : ?>
                    <?php while (have_rows('zip_codes')) : the_row(); ?>
                        <?php $partner_zip = get_sub_field('zip_code'); ?>
                        <?php if ($partner_zip == $result_zip) : ?>
                            <?php $_SESSION['match_switch'] = true; ?>
                        <?php endif; ?>
                    <?php endwhile; ?>
                <?php endif; ?>
            <?php endif; ?>

            <?php if (!$_SESSION['match_switch']) : ?>
                <?php if (have_rows('cities')) : ?>
                    <?php while (have_rows('cities')) : the_row(); ?>
                        <?php $partner_city = get_sub_field('city'); ?>
                        <?php if ($partner_city == $result_city) : ?>
                            <?php $_SESSION['match_switch'] = true; ?>
                        <?php endif; ?>
                    <?php endwhile; ?>
                <?php endif; ?>
            <?php endif; ?>

            <?php if (!$_SESSION['match_switch']) : ?>
                <?php if (have_rows('states')) : ?>
                    <?php while (have_rows('states')) : the_row(); ?>
                        <?php $partner_state = get_sub_field('state'); ?>
                        <?php if ($partner_state == $result_state) : ?>
                            <?php $_SESSION['match_switch'] = true; ?>
                        <?php endif; ?>
                    <?php endwhile; ?>
                <?php endif; ?>
            <?php endif; ?>

            <?php if ($_SESSION['match_switch']) : ?>
                <?php if ($button_type == 'link') : ?>
                    <?php $partner_ID = get_the_ID(); ?>
                    <a class="calculator-cta-btn linkout-btn" data-linkout-type="button" data-partner-id="<?php echo $partner_ID; ?>" href="<?php the_field('button_link'); ?>" target="_blank"><?php the_field('button_label'); ?></a>
                <?php elseif ($button_type == 'modal') : ?>
                    <?php $partner_logo = get_field('logo'); ?>
                    <?php $post_id = get_the_ID(); ?>
                    <?php $account_number = get_post_meta($post_id, 'account_number'); ?>
                    <a class="calculator-cta-btn featured-modal-btn" href="#" data-partner-email="<?php the_field('featured_partner_email_address'); ?>" data-heading="Contact <?php the_title(); ?>" data-instructions="<?php the_field('instructions'); ?>" data-disclaimer="<?php the_field('disclaimer_text'); ?>" data-logo-src="<?php echo $partner_logo['url']; ?>" data-logo-alt="<?php echo $partner_logo['alt']; ?>" data-account-number="<?php echo $account_number[0]; ?>"><?php the_field('button_label'); ?></a>
                <?php endif; ?>
                <?php $_SESSION['i']++; ?>
            <?php endif; ?>
        <?php endif; ?>

        <?php wp_reset_postdata(); ?>
    <?php endif; ?>
<?php endif; ?>