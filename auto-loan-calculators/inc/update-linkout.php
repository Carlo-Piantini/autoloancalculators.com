<?php 
// Make public AJAX function that updates the linkout data for the featured partners.
add_action( 'wp_ajax_update_linkout', 'update_linkout' );
add_action( 'wp_ajax_nopriv_update_linkout', 'update_linkout');
// Define the function for the update
function update_linkout() {
    if (isset($_POST['linkout_type']) && isset($_POST['partner_ID'])) {
        $linkout_type = $_POST['linkout_type']; // Whether the linkout is from a button or a sidebar image
        $partner_ID = $_POST['partner_ID']; // The ID of the featured partner post in question
        // Use the linkout type and the post ID to grab the correct meta-data
        switch ($linkout_type) {
            case "button" :
                $linkout_key = 'button_linkout_clicks';
            break;
            case "sidebar" :
                $linkout_key = 'sidebar_linkout_clicks';
            break;
        }
        $linkout_clicks = get_post_meta($partner_ID, $linkout_key, true);
        $linkout_clicks++;
        update_post_meta($partner_ID, $linkout_key, $linkout_clicks);
        echo $linkout_clicks;
        die();
    }
}
?>