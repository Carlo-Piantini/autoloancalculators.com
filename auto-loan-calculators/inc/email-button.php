<?php
// Define AJAX function calls for the form.
add_action( 'wp_ajax_email_button', 'email_button' );
add_action( 'wp_ajax_nopriv_email_button', 'email_button');
// Function to process the form submission
function email_button() {
    // Check for calculator data
    if (isset($_POST['calculator_data'])) {
        // Grab the calculator data from the AJAX JSON.
        $calculator_data = $_POST['calculator_data'];
        // Pull out the various arrays from the calculator data into distinct vars
        $input_fields = $calculator_data['input_fields'];
        $result_fields = $calculator_data['result_fields'];
        $user_email = $calculator_data['user_email'];
        $calc_flag = $calculator_data['calc_flag'];
        $calc_id = $calculator_data['calc_id'];
        // Setup error flags for validation processes
        $error_data['flag'] = false;
        // Check to make sure the calculator has been properly filled out
        if ($calc_flag == 'invalid') {
            $error_data['flag'] = true;
            $error_data['form_issue'] = 'empty_calc';
            $error_data['error_msg'] = "Please fill out one of our calculators to receive your results.";
        }
        // Check to make sure that the user has input an email address
        if (empty($user_email)) {
            $error_data['flag'] = true;
            $error_data['form_issue'] = 'empty_field';
            $error_data['error_msg'] = "Please provide us with your email address to receive your results.";
        }
        // Check to make sure that the input is a valid email address
        if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
            $error_data['flag'] = true;
            $error_data['form_issue'] = 'invalid_email';
            $error_data['error_msg'] = 'Please input a valid email address to receive your results.';
        }
        // If the error flag has been thrown, then return the error data and kill the processor
        if ($error_data['flag'] == true) {
            echo json_encode($error_data);
            die();
        }

        // If the form data passes all validations, create the notification email and send it.
        if ($error_data['flag'] == false) {
            $new_lead = array(
                'post_title' => $user_email,
                'post_content' => '',
                'post_status' => 'publish',
                'post_type' => 'leads',
            ); 
            switch ($calc_id) {
                case 'alc-calculator' :
                    $new_lead['post_category'] = array(4);
                    $lead_id = wp_insert_post($new_lead);

                    update_field('price', $input_fields[0]['value'], $lead_id);
                    update_field('down_payment', $input_fields[1]['value'], $lead_id);
                    update_field('rate', $input_fields[2]['value'], $lead_id);
                    update_field('term', $input_fields[3]['value'], $lead_id);
                    update_field('rebate', $input_fields[4]['value'], $lead_id);
                    update_field('value_of_trade-in', $input_fields[5]['value'], $lead_id);
                    update_field('amount_owed_on_trade-in', $input_fields[6]['value'], $lead_id);
                    update_field('sales_tax_rate', $input_fields[7]['value'], $lead_id);

                    update_field('estimated_monthly_car_payment', $result_fields[0]['value'], $lead_id);
                    update_field('date_of_payoff', $result_fields[1]['value'], $lead_id);
                    update_field('total_loan_amount', $result_fields[2]['value'], $lead_id);
                    update_field('total_interest_paid', $result_fields[3]['value'], $lead_id);
                    update_field('total_payments', $result_fields[4]['value'], $lead_id);
                    break;
                case 'affordability-calculator' :
                    $new_lead['post_category'] = array(5);
                    $lead_id = wp_insert_post($new_lead);

                    update_field('desired_monthly_payment', $input_fields[0]['value'], $lead_id);
                    update_field('down_payment', $input_fields[1]['value'], $lead_id);
                    update_field('value_of_trade-in', $input_fields[2]['value'], $lead_id);
                    update_field('amount_owed_on_trade-in', $input_fields[3]['value'], $lead_id);
                    update_field('term', $input_fields[4]['value'], $lead_id);
                    update_field('interest_rate', $input_fields[5]['value'], $lead_id);

                    update_field('price_of_car', $result_fields[0]['value'], $lead_id);
                    update_field('total_loan_amount', $result_fields[1]['value'], $lead_id);
                    update_field('total_interest_paid', $result_fields[2]['value'], $lead_id);
                    update_field('total_payments', $result_fields[3]['value'], $lead_id);
                    break;
                case 'refinance-calculator' :
                    $new_lead['post_category'] = array(6);
                    $lead_id = wp_insert_post($new_lead);

                    update_field('current_monthly_payment', $input_fields[0]['value'], $lead_id);
                    update_field('current_loan_balance', $input_fields[1]['value'], $lead_id);
                    update_field('current_interest_rate', $input_fields[2]['value'], $lead_id);
                    update_field('new_loan_interest_rate', $input_fields[3]['value'], $lead_id);
                    update_field('new_loan_term', $input_fields[4]['value'], $lead_id);
                    
                    update_field('new_loan_payment', $result_fields[0]['value'], $lead_id);
                    update_field('monthly_payment_savings', $result_fields[1]['value'], $lead_id);
                    update_field('difference_in_interest', $result_fields[2]['value'], $lead_id);
                    update_field('new_loan_total_payments', $result_fields[3]['value'], $lead_id);
                    update_field('new_loan_payoff_date', $result_fields[4]['value'], $lead_id);
                    break;
                case 'auto-lease-calculator' :
                    $new_lead['post_category'] = array(7);
                    $lead_id = wp_insert_post($new_lead);

                    update_field('vehicle_price', $input_fields[0]['value'], $lead_id);
                    update_field('rebates_and_incentives', $input_fields[1]['value'], $lead_id);
                    update_field('down_payment', $input_fields[2]['value'], $lead_id);
                    update_field('interest_rate', $input_fields[3]['value'], $lead_id);
                    update_field('lease_term', $input_fields[4]['value'], $lead_id);
                    update_field('trade-in_value', $input_fields[5]['value'], $lead_id);
                    update_field('amount_owed_on_trade-in', $input_fields[6]['value'], $lead_id);
                    update_field('residual_value', $input_fields[7]['value'], $lead_id);
                    update_field('sales_tax_rate', $input_fields[8]['value'], $lead_id);

                    update_field('estimated_monthly_lease_payment', $result_fields[0]['value'], $lead_id);
                    update_field('monthly_depreciation', $result_fields[1]['value'], $lead_id);
                    update_field('monthly_lease_fee', $result_fields[2]['value'], $lead_id);
                    update_field('monthly_sales_tax', $result_fields[3]['value'], $lead_id);
                    update_field('total_lease_payment', $result_fields[4]['value'], $lead_id);
                    update_field('purchased_instead_of_leased_monthly_payment', $result_fields[5]['value'], $lead_id);
                    break;
                case 'auto-lir-calculator' :
                    $new_lead['post_category'] = array(8);
                    $lead_id = wp_insert_post($new_lead);

                    update_field('monthly_payment', $input_fields[0]['value'], $lead_id);
                    update_field('down_payment', $input_fields[1]['value'], $lead_id);
                    update_field('price_of_car', $input_fields[2]['value'], $lead_id);
                    update_field('trade-in_value', $input_fields[3]['value'], $lead_id);
                    update_field('term', $input_fields[4]['value'], $lead_id);
                    
                    update_field('interest_rate', $result_fields[0]['value'], $lead_id);
                    update_field('total_interest', $result_fields[1]['value'], $lead_id);
                    update_field('total_payments', $result_fields[2]['value'], $lead_id);
                    break;
            }

            $to = $user_email;
            $subject = 'Your Auto Loan Calculator Results';
            $body = 'Here are your calculator results from http://www.autoloancalculators.com<br/>';
            $body .= '********<br/>Inputs<br/>********<br/>';
            foreach ($input_fields as $field) {
                $body .= $field['label'] . ' : ' . $field['value'] . '<br/>';
            }
            $body .= '*********<br/>Results<br/>*********<br/>';
            foreach ($result_fields as $field) {
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
}
?>