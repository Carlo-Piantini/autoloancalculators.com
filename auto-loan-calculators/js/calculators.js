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
                    var price = $('#alc-price').val(); // B8 in the excel sheet
                    var down_payment = $('#alc-down-pymnt').val(); // B9 in the excel sheet
                    var interest_rate = $('#alc-rate').val(); // B10 in the excel sheet
                    var term = $('#alc-term').val(); // B11 in the excel sheet
                    var rebate = $('#alc-rebate').val(); // B12 in the excel sheet
                    var trade_in = $('#alc-trade-in').val(); // B13 in the excel sheet
                    var amnt_owed = $('#alc-amnt-owed').val(); // B14 in the excel sheet
                    var sales_tax = $('#alc-sales-tax').val(); // B15 in the excel sheet

                    var loan_amnt = price * (1 + parseFloat(sales_tax, 2)/100) - down_payment - rebate - trade_in + parseFloat(amnt_owed, 2);

                    var pv = loan_amnt;
                    var nper = term * 12;
                    var rate = interest_rate / 100 / 12;

                    var mnthly_pymnt = pmt(rate, nper, pv);
                    var total_pymnt = mnthly_pymnt * nper;
                    var total_interest = total_pymnt - loan_amnt;

                    var current_date = new Date();
                    var current_month = current_date.getMonth();
                    var month_names = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                    current_month = month_names[current_month];
                    var current_year = current_date.getFullYear();
                    var date_payoff = current_month + ' ' + (parseInt(current_year) + parseInt(term));

                    var results = {
                        result_fields : {
                            mnthly_pymnt : {
                                result_id : '#alc-mnthly-pymnt',
                                result_value : '$' + parseFloat(mnthly_pymnt).toFixed(2),
                            },
                            payoff_date : {
                                result_id : '#alc-payoff-date',
                                result_value : new_payoff_date(term),
                            },
                            loan_amnt : {
                                result_id : '#alc-total-loan .alc-total-amnt',
                                result_value : '$' + parseFloat(loan_amnt).toFixed(),
                            },
                            total_interest : {
                                result_id : '#alc-total-interest .alc-total-amnt',
                                result_value : '$' + parseFloat(total_interest).toFixed(2),
                            },
                            total_pymnt : {
                                result_id : '#alc-total-pymnt .alc-total-amnt',
                                result_value : '$' + parseFloat(total_pymnt).toFixed(2),
                            },
                        },
                    }
                    update_results_new(results);
                    // Update the calculator results HTML
                    // update_results(parseFloat(mnthly_pymnt).toFixed(2), date_payoff, parseFloat(loan_amnt).toFixed(2), parseFloat(total_interest).toFixed(2), parseFloat(total_pymnt).toFixed(2));
                    break;
                // Calculates the ersults if the form is the Affordability Calculator
                case '#affordability-calculator':
                    var desired_pymnt = $('#affordability-desired-pymnt').val();
                    var down_pymnt = $('#affordability-down-pymnt').val();
                    var trade_in = $('#affordability-trade-in').val();
                    var amnt_owed = $('#affordability-amnt-owed').val();
                    var term = $('#affordability-term').val();
                    var interest_rate = $('#affordability-interest-rate').val();
                    
                    var adjusted_rate = parseFloat(interest_rate / 100 / 12).toFixed(4);
                    var adjusted_term = term * 12;

                    var total_pymnt = (desired_pymnt * term * 12).toFixed(2);

                    // Calculates the present value, based on the formula provided by Excel
                    // https://support.office.com/en-us/article/pv-function-23879d31-0e02-4321-be01-da16e8168cbd
                    // Won't provide exact match to Excel due to rounding differences with floats
                    // Formula for the Present Value (in this context, type == 0 because payment comes at end of the month, based on formula from Excel sheet)
                    // pv * (1 + rate)^nper + pmt(1 + rate * type) * ((1 + rate)^nper - 1)/rate) = 0
                    // pv * (1 + rate)^nper = -(pmt(1 + rate * type) * ((1 + rate)^nper - 1)/rate))
                    // pv = -(pmt(1 + rate * type) * ((1 + rate)^nper - 1)/rate)) / (1 + rate)^nper
                    // We can ignore the negative, because here it simply expresses a debt rather than a credit
                    var a = desired_pymnt; // pmt(1 + rate * type) == pmt(1) because type == 0, and rate * 0 == 0
                    var b = Math.pow((1 + parseFloat(adjusted_rate)), adjusted_term).toFixed(4); // (1 + rate)^nper 
                    var c = ((b - 1) / adjusted_rate).toFixed(4); // ((1 + rate)^nper - 1) / rate
                    var price = (((a * c) / b) - down_pymnt - trade_in + parseFloat(amnt_owed)).toFixed(2);

                    var loan_amnt = price;
                    var total_interest = (total_pymnt - loan_amnt).toFixed(2);
                    update_results(price, 0, loan_amnt, total_interest, total_pymnt);
                    break;
                case '#refinance-calculator':
                    var mnthly_pymnt = $('#refinance-mnthly-pymnt').val();
                    var loan_balance = $('#refinance-loan-balance').val();
                    var interest_rate = $('#refinance-interest-rate').val();
                    var current_term = $('#refinance-current-term').val();
                    var new_rate = $('#refinance-new-rate').val();
                    var new_term = $('#refinance-new-term').val();

                    var pv = loan_balance;
                    var nper = new_term * 12;
                    var rate = new_rate / 100 / 12;

                    var new_pymnt = pmt(rate, nper, pv);
                    var interest_difference = 0; // ((current_term * mnthly_pymnt) - loan_balance) - (new_pymnt * nper - loan_balance);
                    var mnthly_savings = mnthly_pymnt - new_pymnt;
                    var new_total = new_pymnt * nper;
                    var results = {
                        result_fields : {
                            new_pymnt : {
                                result_id : '#refinance-new-pymnt',
                                result_value : '$' + parseFloat(new_pymnt, 2).toFixed(2),
                            },
                            mnthly_savings : {
                                result_id : '#refinance-mnthly-savings .refinance-total-amnt',
                                result_value : '$' + parseFloat((-1 * mnthly_savings), 2).toFixed(2),
                            },
                            difference_in_interest : {
                                result_id : '#refinance-difference-in-interest .refinance-total-amnt',
                                result_value : '$' + parseFloat((-1 * interest_difference), 2).toFixed(2),
                            },
                            new_total : {
                                result_id : '#refinance-new-total .refinance-total-amnt',
                                result_value : '$' + parseFloat(new_total, 2).toFixed(2),
                            },
                            payoff_date : {
                                result_id : '#refinance-payoff-date .refinance-total-amnt',
                                result_value : new_payoff_date(new_term),
                            },
                        },
                    }
                    update_results_new(results);
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

    function new_payoff_date(term) {
        var current_date = new Date();
        var current_month = current_date.getMonth();
        var month_names = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        current_month = month_names[current_month];
        var current_year = current_date.getFullYear();
        var date_payoff = current_month + ' ' + (parseInt(current_year) + parseInt(term));
        return date_payoff;
    }

    function update_results_new(results) {
        console.log(results);
        for (var result_fields in results) {
            for (var field in results[result_fields]) {
                var result_id;
                var result_value;
                for (var key in results[result_fields][field]) {
                    if (key == 'result_id') {
                        result_id = results[result_fields][field][key];
                    }
                    else if (key == 'result_value') {
                        result_value = results[result_fields][field][key];
                    }
                }
                $(result_id).html(result_value);
            }
        }
    }

    function update_results(monthly_pymnt, date_payoff, loan_amnt, total_interest, total_pymnt) {
        var results_id = $('.calculator-results').attr('id');
        switch (results_id) {
            case 'alc-results':
                $('#alc-monthly-pymnt').html('$' + monthly_pymnt);
                $('#alc-date-payoff').html(date_payoff);
                $('#alc-total-loan .alc-total-amnt').html('$' + loan_amnt);
                $('#alc-total-interest .alc-total-amnt').html('$' + total_interest);
                $('#alc-total-pymnts .alc-total-amnt').html('$' + total_pymnt);
                break;
            case 'affordability-results':
                $('#affordability-price').html('$' + monthly_pymnt);
                $('#affordability-total-loan .affordability-total-amnt').html('$' + loan_amnt);
                $('#affordability-total-interest .affordability-total-amnt').html('$' + total_interest);
                $('#affordability-total-pymnts .affordability-total-amnt').html('$' + total_pymnt);
                break;
        }
    }
    
    // PMT = P * (r(1 + r)^n) / (1 + r)^n - 1
    // PMT = pv * (rate * (1 + rate)^nper) / ((1 + rate)^nper - 1)
    function pmt(rate, nper, pv) {
        var a = pv;
        var b = Math.pow((1 + parseFloat(rate, 2)), nper);
        var c = rate * b;
        var d = b - 1;
        var pmt = (a * c / d);
        return pmt;
    }
});