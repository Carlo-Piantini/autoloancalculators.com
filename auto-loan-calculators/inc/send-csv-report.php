<?php
/* cronjob command for the cPanel
** /usr/local/bin/ea-php56 /home/kjq8ief6z9m1/public_html/autoloancalculators.com/wp-content/themes/auto-loan-calculators/inc/send-csv-report.php
*/

// Loading in PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require dirname(__FILE__) . '/libs/phpmailer/src/Exception.php';
require dirname(__FILE__) . '/libs/phpmailer/src/PHPMailer.php';
require dirname(__FILE__) . '/libs/phpmailer/src/SMTP.php';

// Load in the core functionality of WP to be able to use our loops and queries
require (explode("wp-content", __FILE__)[0] . "wp-load.php");

function send_csv_report() {
    // Grabbing the date to create a unique filename for each report
    $file_date = date('m-d-y');
    // Setting the filename for the future .csv report and creating a path for the temp file to be sent in the email
    $file_name = 'linkout-clicks-' . $file_date . '-report';
    $tmp_name = tempnam(sys_get_temp_dir(), $file_name . '_') . '.csv';
    echo $tmp_name;
    // Going to create a new WP loop based on a custom WP Query to grab all of the featured partner data
    $args = array(
        'post_type' => 'partner',
    );
    $query = new WP_Query($args);
    $partner_data = [];
    $partner_data[0] = array('Title', 'Account Name', 'Account Number', 'Sidebar Linkout Clicks', 'Button Linkout Clicks');
    if ($query->have_posts()) {
        $i = 1; // var to keep the index of the posts
        while ($query->have_posts()) {
            $query->the_post();
            $partner_ID = get_the_ID(); // Grab the ID of the featured partner post
            // Use the partner ID to grab all of the meta data and include it as the next element in the array
            $partner_data[$i] = array(get_the_title(), get_post_meta($partner_ID, 'account_name', true), get_post_meta($partner_ID, 'account_number', true), get_post_meta($partner_ID, 'sidebar_linkout_clicks', true), get_post_meta($partner_ID, 'button_linkout_clicks', true));
            // After grabbing the proper data, going to reset the data back to zero for the new month
            update_post_meta($partner_ID, 'sidebar_linkout_clicks', '0');
            update_post_meta($partner_ID, 'button_linkout_clicks', '0');
            $i++; // Update the index var
        }
        wp_reset_query(); // Reset the post query when we're done with the loop
    }
    // Open a new temporary .csv file to write all of our partner data to
    $csv_output = fopen($tmp_name, 'w');
    foreach ($partner_data as $data_row) {
        fputcsv($csv_output, $data_row);
    }
    // Use PHPMailer to create a new email and send the .csv file as an attachment, then close out the file
    $mail = new PHPMailer(true);
    try {
        $mail->isHTML(true);
        $mail->Subject = "Monthly Linkout Click Data";
        $mail->Body = "Attached below is the monthly report on linkout click data for all featured partners.";
        $mail->setFrom('info@autoloancalculators.com', 'AutoLoanCalculators');
        $mail->addAddress('info@autoloancalculators.com');
        $mail->addAddress('carlo.piantini@gmail.com');
        $mail->addReplyTo('info@autoloancalculators.com');
        $mail->addAttachment($tmp_name);
        $mail->send();
        echo 'Message has been sent.';
    } catch (Exception $e) {
        echo "Message couldn't be sent.";
    }
    unlink($tmp_name);
    fclose($csv_output);
}
// Call the function and send out the .csv file
send_csv_report();
?>