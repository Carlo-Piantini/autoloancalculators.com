<?php
// Define AJAX function calls for the form.
add_action( 'wp_ajax_form_processor', 'form_processor' );
add_action( 'wp_ajax_nopriv_form_processor', 'form_processor');
// Function to process the form submission
function form_processor() {
    // Grab the form data from the AJAX JSON.
    if (isset($_POST['form_data'])) {
        $form_data = $_POST['form_data'];
    }
    // Check to make sure all fields have input.
    $error_data['flag'] = false;
    $error_data['invalid_fields'] = array();
    $error_testing = [];
    $form_fields = $form_data['form_fields'];
    foreach ($form_fields as $field) {
        if (empty($field['value']) || $field['value'] = '') {
            $error_data['flag'] = true;
            $error_data['form_issue'] = 'empty_fields';
            array_push($error_data['invalid_fields'], $field['id']);
        }
    }
    if ($error_data['flag'] == true) {
        $error_data['error_msg'] = 'There are empty fields in the form, please fill them out.';
        echo json_encode($error_data);
        die();
    }
    // Check to make sure that the partner and user emails are valid, and not spam.
    $error_data['spam_fields'] = array();
    foreach ($form_fields as $field) {
        if ($field['id'] == 'email-field') {
            if (!filter_var($field['value'], FILTER_VALIDATE_EMAIL)) {
                $error_data['flag'] = true;
                $error_data['form_issue'] = 'invalid-email';
                $error_data['error_msg'] = 'Please input a valid email address.';
                array_push($error_data['invalid_fields'], 'email-field');
                echo json_encode($error_data);
                die();
            }
        }
    }
    // Checks to see if the user phone number is valid
    if ($form_data['form_key'] == 'featured-partner' || $form_data['form_key'] == 'contact') {
        foreach ($form_fields as $field) {
            if ($field['id'] == 'phone-field') {
                $filtered_phone = filter_var($field['value'], FILTER_SANITIZE_NUMBER_INT);
                $test_phone = str_replace("-", "", $filtered_phone);
                if (strlen($test_phone) < 10 || strlen($test_phone) > 14) {
                    $error_data['flag'] = true;
                    $error_data['form_issue'] = 'invalid-phone';
                    $error_data['error_msg'] = 'Please input a valid phone number.';
                    array_push($error_data['invalid_fields'], 'phone-field');
                    echo json_encode($error_data);
                    die();
                }
            }
        }
    }
    // If the form data passes all validations, create the notification email and send it.
    if ($error_data['flag'] == false) {
        $to = $subject = '';
        switch ($form_data['form_id']) {
            case 'contact-form' : 
                $to = 'info@autoloancalculators.com';
                $subject = 'Submission from the "Contact Us" Form';
                break;
            case 'featured-partner-form' : 
                $to = $form_data['partner_email'];
                if (isset($form_data['account_number']) && $form_data['account_number'] != '') {
                    $subject = 'New Lead from AutoLoanCalculators.com - Account Number ' . $form_data['account_number'];
                } else {
                    $subject = 'New Lead from AutoLoanCalculators.com';
                }
                break;
            case 'new-car-form' : 
                $to = 'leads@autoloancalculators.com';
                $subject = 'New Lead from AutoLoanCalculators.com';
                break;
        }
        $body = 'Form submission from http://www.autoloancalculators.com<br/>';
        foreach ($form_fields as $field) {
            $body .= $field['label'] . ' : ' . $field['value'] . '<br/>';
        }
        $headers = array('Content-Type: text/html; charset=UTF-8');

        if (wp_mail($to, $subject, $body, $headers)) {
            $result = true;
            echo json_encode($result);
            die();
        }
        else {
            $error_data['flag'] = true;
            $error_data['error_msg'] = "The email submission failed.";
            echo json_encode($error_data);
            die();
        }
    }
}
?>