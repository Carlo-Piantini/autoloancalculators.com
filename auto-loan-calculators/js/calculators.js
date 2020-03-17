jQuery(document).ready(function($) {
    $('.calculator-submit').click(function(e) {
        // Prevent default action on button click and form submission
        e.preventDefault();
        // Grabts the ID of the calculator form
        var form_id = $(this).parent('form').attr('id');
        form_id = '#' + form_id;
        // Runs form validation on each of the inputs, and if it passes, proceeds to calculate the results
        if (validate_form(form_id) == true) {
            switch (form_id) {
                // Calculates the results if the form is the Auto Loan Calculator
                case '#alc-calculator':
                    var interest_rate = $('#alc-rate').val(); // B10 in the excel sheet
                    interest_rate = interest_rate/100/12;

                    var term = $('#alc-term').val(); // B11 in the excel sheet
                    term = term * 12;

                    var sales_tax = $('#alc-sales-tax').val(); // B15 in the excel sheet
                    var price = $('#alc-price').val(); // B8 in the excel sheet
                    var down_payment = $('#alc-down-pymnt').val(); // B9 in the excel sheet
                    var rebate = $('#alc-rebate').val(); // B12 in the excel sheet
                    var trade_in = $('#alc-trade-in').val(); // B13 in the excel sheet
                    var amnt_owed = $('#alc-amnt-owed').val(); // B14 in the excel sheet
                    var loan_amnt = price * (1 + parseFloat(sales_tax, 2)/100) - down_payment - rebate - trade_in + parseFloat(amnt_owed, 2);

                    var interest = interest_rate * loan_amnt;

                    interest_rate = parseFloat(interest_rate, 2) + 1;
                    var invert_term = -term;
                    var computed_term = Math.pow(interest_rate, invert_term);
                    computed_term = 1 - computed_term;

                    var monthly_pymnt = interest/computed_term;
                    var total_pymnt = monthly_pymnt * term;
                    var total_interest = total_pymnt - loan_amnt;
                    // Update the calculator results HTML
                    update_results(parseFloat(monthly_pymnt).toFixed(2), parseFloat(loan_amnt).toFixed(2), parseFloat(total_interest).toFixed(2), parseFloat(total_pymnt).toFixed(2));
                break;
            }
        }
    });

    function validate_form(form_id) {
        var valid = true;
        $(form_id + ' .form-input').each(function() {
            if (!$(this).val()) {
                console.log($(this).attr('id') + ' has no valid input');
                valid = false;
            }
        });
        return valid;
    }

    function update_results(monthly_pymnt, loan_amnt, total_interest, total_pymnt) {
        var results_id = $('.calculator-results').attr('id');
        switch (results_id) {
            case 'alc-results':
                $('#alc-monthly-pymnt').html('$' + monthly_pymnt);
                $('#alc-total-loan .alc-total-amnt').html('$' + loan_amnt);
                $('#alc-total-interest .alc-total-amnt').html('$' + total_interest);
                $('#alc-total-pymnts .alc-total-amnt').html('$' + total_pymnt);
            break;
        }
    }
});