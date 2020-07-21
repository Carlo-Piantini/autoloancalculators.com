jQuery(document).ready(function($) {
    // -----------------------------------------
    // Processor for 'Email' and 'Print' Buttons
    // -----------------------------------------
    $('.bottom-cta-btn').click(function(e) {
        e.preventDefault();
        var btn_task = $(this).data('task');
        if (btn_task == 'print_window') {
            window.print();
        }
        else if (btn_task == 'email_button') {
            $('#bottom-cta-btns .modal-wrap').addClass('active');
        }
    });
    $('#email-results-submit').click(function(e) {
        e.preventDefault();
        $('#email-results-form .loading-icon').show();
        var user_email = $('#email-results-field').val();
        var calc_flag = $('#bottom-email-btn').attr('data-calc-flag');
        if ($('#primary .calculator-form').length > 0) {
            var calc_id = $('#primary .calculator-form').attr('id');
            var input_fields = [];
            var result_fields = [];
            $('#primary .calculator-form .form-input').each(function(j) {
                var temp_val = $(this).val();
                if ($(this).parent().hasClass('money-field')) {
                    temp_val = `$${temp_val}`;
                }
                else if ($(this).parent().hasClass('percent-field')) {
                    temp_val = `${temp_val}%`;
                }
                else if ($(this).parent().hasClass('year-field')) {
                    temp_val = `${temp_val} Year`;
                }
                input_fields[j] = {
                    id      : $(this).attr('id'),
                    value   : temp_val,
                    label   : $(this).data('email-label'),
                }
            });
            $('#primary .calculator-results .total-item').each(function(l) {
                result_fields[l] = {
                    value   : $(this).children('.total-amnt').html(),
                    label   : $(this).data('email-label'),
                }
            });

            var calculator_data = {
                calc_id : calc_id,
                user_email : user_email,
                calc_flag : calc_flag,
                input_fields : input_fields,
                result_fields : result_fields,
            }
        
            $.ajax({
                type : 'POST',
                url : ajax.url,
                dataType : 'JSON',
                data : {
                    action : 'email_button',
                    calculator_data : calculator_data,
                },
                success : function(response) {
                    $('#email-results-form .loading-icon').hide();
                    if (response.flag == true) {
                        $('#email-results-form h4').remove();
                        $('#email-results-field').removeClass('error-field');
                        $('#email-results-form hr').after(`<h4 class="error-msg">${response.error_msg}</h4>`);
                        if (response.form_issue == 'invalid_email') {
                            $('#email-results-field').addClass('error-field');
                        }
                    }
                    else {
                        $('#email-results-form h4').remove();
                        $('#email-results-form .form-label').remove();
                        $('#email-results-form hr').after('<h4 class="success-msg">Thank you for your submission, your results are on their way!</h4>')
                    }
                }
            });
        }
    });

    $('.form-input').change(function() {
        if ($(this).parent().hasClass('money-field')) {
            var input_value = $(this).val();
            input_value = input_value.replace(',', '');
            input_value = parseFloat(input_value, 2);
            if (isNaN(input_value)) {
                input_value = '';
            }
            else {
                input_value = input_value.toLocaleString('en-US', { style: 'currency', currency: 'USD' });
                input_value = input_value.replace('$', '');
            }
            $(this).val(input_value);
        }
    });

    $('.calculator-submit').click(function(e) {
        // Prevent default action on button click and form submission
        e.preventDefault();
        // Grabts the ID of the calculator form
        var form_id = $(this).parent('form').attr('id');
        form_id = '#' + form_id;
        // Runs form validation on each of the inputs, and if it passes, proceeds to calculate the results
        if (validate_form(form_id) == true) {
            $('#bottom-email-btn').attr('data-calc-flag', 'valid');
            switch (form_id) {
                // Calculates the results if the form is the Auto Loan Calculator
                case '#alc-calculator':
                    var price = sanitize_currency($('#alc-price').val()); // B8 in the excel sheet
                    var down_pymnt = sanitize_currency($('#alc-down-pymnt').val()); // B9 in the excel sheet
                    var interest_rate = $('#alc-rate').val(); // B10 in the excel sheet
                    var term = $('#alc-term').val(); // B11 in the excel sheet
                    var rebate = sanitize_currency($('#alc-rebate').val()); // B12 in the excel sheet
                    var trade_in = sanitize_currency($('#alc-trade-in').val()); // B13 in the excel sheet
                    var amnt_owed = sanitize_currency($('#alc-amnt-owed').val()); // B14 in the excel sheet
                    var sales_tax = $('#alc-sales-tax').val(); // B15 in the excel sheet

                    var loan_amnt = price * (1 + parseFloat(sales_tax, 2)/100) - down_pymnt - rebate - trade_in + parseFloat(amnt_owed, 2);

                    var present_value = loan_amnt;
                    var num_per = term * 12;
                    var adj_rate = interest_rate / 100 / 12;

                    var mnthly_pymnt = pmt(adj_rate, num_per, present_value);
                    var total_pymnt = mnthly_pymnt * num_per;
                    var total_interest = total_pymnt - loan_amnt;

                    var results = {
                        result_fields : {
                            mnthly_pymnt : {
                                result_id : '#alc-mnthly-pymnt',
                                result_value : mnthly_pymnt.toLocaleString('en-US', { style: 'currency', currency: 'USD' }),
                            },
                            payoff_date : {
                                result_id : '#alc-payoff-date',
                                result_value : new_payoff_date(term),
                            },
                            loan_amnt : {
                                result_id : '#alc-total-loan .total-amnt',
                                result_value : loan_amnt.toLocaleString('en-US', { style: 'currency', currency: 'USD' }),
                            },
                            total_interest : {
                                result_id : '#alc-total-interest .total-amnt',
                                result_value : total_interest.toLocaleString('en-US', { style: 'currency', currency: 'USD' }),
                            },
                            total_pymnt : {
                                result_id : '#alc-total-pymnts .total-amnt',
                                result_value : total_pymnt.toLocaleString('en-US', { style: 'currency', currency: 'USD' }),
                            },
                        },
                    }
                    update_results(results);
                    break;
                // Calculates the ersults if the form is the Affordability Calculator
                case '#affordability-calculator':
                    var desired_pymnt = sanitize_currency($('#affordability-desired-pymnt').val());
                    var down_pymnt = sanitize_currency($('#affordability-down-pymnt').val());
                    var trade_in = sanitize_currency($('#affordability-trade-in').val());
                    var amnt_owed = sanitize_currency($('#affordability-amnt-owed').val());
                    var term = $('#affordability-term').val();
                    var interest_rate = $('#affordability-interest-rate').val();
                    var total_pymnt = sanitize_currency((desired_pymnt * term * 12).toFixed(2));

                    var pymnt = desired_pymnt;
                    var num_per = term * 12;
                    var adj_rate = interest_rate / 100 / 12;

                    var price = pv(adj_rate, num_per, pymnt) + parseFloat(down_pymnt, 2) + parseFloat(trade_in, 2) - amnt_owed;
                    var loan_amnt = price - trade_in + parseFloat(amnt_owed, 2) - down_pymnt;
                    var total_interest = sanitize_currency((total_pymnt - loan_amnt).toFixed(2));
                    var results = {
                        result_fields : {
                            price : {
                                result_id : '#affordability-price',
                                result_value : price.toLocaleString('en-US', { style: 'currency', currency: 'USD' }),
                            },
                            loan_amnt : {
                                result_id : '#affordability-total-loan .total-amnt',
                                result_value : loan_amnt.toLocaleString('en-US', { style: 'currency', currency: 'USD' }),
                            },
                            total_interest : {
                                result_id : '#affordability-total-interest .total-amnt',
                                result_value : total_interest.toLocaleString('en-US', { style: 'currency', currency: 'USD' }),
                            },
                            total_pymnt : {
                                result_id : '#affordability-total-pymnts .total-amnt',
                                result_value : total_pymnt.toLocaleString('en-US', { style: 'currency', currency: 'USD' }),
                            },
                        },
                    }
                    update_results(results);
                    break;
                case '#refinance-calculator':
                    var mnthly_pymnt = sanitize_currency($('#refinance-mnthly-pymnt').val());
                    var loan_balance = sanitize_currency($('#refinance-loan-balance').val());
                    var interest_rate = $('#refinance-interest-rate').val();
                    var new_rate = $('#refinance-new-rate').val();
                    var new_term = $('#refinance-new-term').val();

                    var present_value = loan_balance;
                    var num_per = new_term * 12;
                    var adj_rate = interest_rate / 100 / 12;
                    var adj_new_rate = new_rate / 100 / 12;

                    var new_pymnt = pmt(adj_new_rate, num_per, present_value);
                    
                    var old_nper = nper(adj_rate, mnthly_pymnt, loan_balance);
                    console.log(old_nper);
                    var old_interest = (old_nper * mnthly_pymnt) - loan_balance;
                    var new_interest = (new_pymnt * new_term * 12) - loan_balance;
                    var interest_difference = old_interest - new_interest; 

                    var mnthly_savings = parseFloat(mnthly_pymnt, 2).toFixed(2) - parseFloat(new_pymnt, 2).toFixed(2);
                    var new_total = parseFloat(new_pymnt, 2).toFixed(2) * num_per;
                    var results = {
                        result_fields : {
                            new_pymnt : {
                                result_id : '#refinance-new-pymnt',
                                result_value : new_pymnt.toLocaleString('en-US', { style: 'currency', currency: 'USD' }),
                            },
                            mnthly_savings : {
                                result_id : '#refinance-mnthly-savings .total-amnt',
                                result_value : mnthly_savings.toLocaleString('en-US', { style: 'currency', currency: 'USD' }),
                            },
                            difference_in_interest : {
                                result_id : '#refinance-difference-in-interest .total-amnt',
                                result_value : interest_difference.toLocaleString('en-US', { style: 'currency', currency: 'USD' }),
                            },
                            new_total : {
                                result_id : '#refinance-new-total .total-amnt',
                                result_value : new_total.toLocaleString('en-US', { style: 'currency', currency: 'USD' }),
                            },
                            payoff_date : {
                                result_id : '#refinance-payoff-date .total-amnt',
                                result_value : new_payoff_date(new_term),
                            },
                        },
                    }
                    update_results(results);
                    break;
                case '#auto-lease-calculator':
                    var vehicle_price = sanitize_currency($('#auto-lease-vehicle-price').val());
                    var rebates_incentives = sanitize_currency($('#auto-lease-rebates-incentives').val());
                    var down_pymnt = sanitize_currency($('#auto-lease-down-pymnt').val());
                    var interest_rate = $('#auto-lease-interest-rate').val();
                    var lease_term = $('#auto-lease-term').val();
                    var trade_value = sanitize_currency($('#auto-lease-trade-value').val());
                    var amnt_owed = sanitize_currency($('#auto-lease-amnt-owed').val());
                    var residual_value = sanitize_currency($('#auto-lease-residual-value').val());
                    var sales_tax = $('#auto-lease-sales-tax').val();

                    var comp_a = (vehicle_price - rebates_incentives - down_pymnt - trade_value + parseFloat(amnt_owed, 2));

                    var mnthly_fee = comp_a;
                    mnthly_fee = (mnthly_fee + parseFloat(residual_value, 2)) * (interest_rate / 100 / 24);

                    var mnthly_lease = comp_a;
                    mnthly_lease = ((mnthly_lease - residual_value) / (lease_term * 12)) + parseFloat(mnthly_fee, 2);
                    mnthly_lease = mnthly_lease * (1 + parseFloat((sales_tax / 100), 2));

                    var mnthly_depreciation = comp_a;
                    mnthly_depreciation = (mnthly_depreciation - residual_value) / (lease_term * 12);

                    var new_tax = comp_a;
                    new_tax = (new_tax - residual_value) / (lease_term * 12);
                    new_tax = (new_tax + parseFloat(mnthly_fee, 2)) * (sales_tax / 100);

                    var total_pymnt = mnthly_lease * lease_term * 12;

                    var adj_rate = interest_rate / 100 / 12;
                    var num_per = lease_term * 12;
                    var present_value = (1 + (sales_tax / 100)) * vehicle_price - down_pymnt - rebates_incentives - trade_value + parseFloat(amnt_owed, 2);
                    var purchased_instead = pmt(adj_rate, num_per, present_value);
                    
                    var results = {
                        result_fields : {
                            mnthly_pymnt : {
                                result_id : '#auto-lease-mnthly-pymnt',
                                result_value : mnthly_lease.toLocaleString('en-US', { style: 'currency', currency: 'USD' }),
                            },
                            mnthly_depreciation : {
                                result_id : '#auto-lease-mnthly-depreciation .total-amnt',
                                result_value : mnthly_depreciation.toLocaleString('en-US', { style: 'currency', currency: 'USD' }),
                            },
                            finance_fee : {
                                result_id : '#auto-lease-finance-fee .total-amnt',
                                result_value : mnthly_fee.toLocaleString('en-US', { style: 'currency', currency: 'USD' }),
                            },
                            new_tax : {
                                result_id : '#auto-lease-mnthly-sales-tax .total-amnt',
                                result_value : parseFloat(new_tax).toFixed(2) + '%',
                            },
                            lease_pymnt : {
                                result_id : '#auto-lease-total-lease-pymnt .total-amnt',
                                result_value : total_pymnt.toLocaleString('en-US', { style: 'currency', currency: 'USD' }),
                            },
                            purchased_instead : {
                                result_id : '#auto-lease-purchased-instead .total-amnt',
                                result_value : purchased_instead.toLocaleString('en-US', { style: 'currency', currency: 'USD' }),
                            }
                        }
                    }
                    update_results(results);
                    break;
                case '#auto-lir-calculator':
                    var mnthly_pymnt = sanitize_currency($('#auto-lir-mnthly-pymnt').val());
                    var down_pymnt = sanitize_currency($('#auto-lir-down-pymnt').val());
                    var price = sanitize_currency($('#auto-lir-price').val());
                    var trade_in = sanitize_currency($('#auto-lir-trade-in').val());
                    var term = $('#auto-lir-term').val();

                    var adj_price = price - down_pymnt - trade_in;
                    var num_per = term * 12;

                    var interest_rate = rate(num_per, -mnthly_pymnt, adj_price) * 12 * 100;

                    var total_pymnt = mnthly_pymnt * term * 12;
                    var total_interest = total_pymnt - (price - down_pymnt - trade_in);

                    results = {
                        result_fields : {
                            interest_rate : {
                                result_id : '#auto-lir-interest-rate .total-amnt',
                                result_value : parseFloat(interest_rate).toFixed(2) + '%',
                            },
                            total_pymnt : {
                                result_id : '#auto-lir-total-pymnts .total-amnt',
                                result_value : total_pymnt.toLocaleString('en-US', { style: 'currency', currency: 'USD' }),
                            },
                            total_interest : {
                                result_id : '#auto-lir-total-interest .total-amnt',
                                result_value : total_interest.toLocaleString('en-US', { style: 'currency', currency: 'USD' })
                            }
                        }
                    }
                    update_results(results);
                    break;
            }
        }
    });

    function validate_form(form_id) {
        $(`.site-main ${form_id} .form-input`).removeClass('error-field');
        var valid = true;
        $(`.site-main ${form_id} .form-input`).each(function() {
            if (!$(this).val()) {
                $(this).addClass('error-field');
                $('.calculator-error-msg').html("Please fill in the highlighted fields.");
                valid = false;
                $('#bottom-email-btn').attr('data-calc-flag', 'invalid');
            }
        });
        return valid;
    }

    function sanitize_currency(value) {
        var clean_val = value.replace(',', '');
        clean_val = parseFloat(clean_val, 2);
        return clean_val;
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

    function update_results(results) {
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
    
    // PMT = P * (r(1 + r)^n) / (1 + r)^n - 1
    // PMT = pv * (rate * (1 + rate)^nper) / ((1 + rate)^nper - 1)
    function pmt(adj_rate, num_per, present_value) {
        var pmt;
        if (adj_rate == 0) {
            pmt = present_value / num_per;
        } else {
            var a = present_value;
            var b = Math.pow((1 + parseFloat(adj_rate, 2)), num_per);
            var c = adj_rate * b;
            var d = b - 1;
            pmt = (a * c / d);
        }
        return pmt;
    }

    // FV = PMT * ((1 + r)^nper - 1) / r)
    // FV = PV * (1 + r)^nper
    // PV = FV / (1 + r)^nper
    function pv(adj_rate, num_per, pymnt) {
        var pv;
        if (adj_rate == 0) {
            pv = pymnt * num_per;
        } else {
            var a = pymnt;
            var b = Math.pow((1 + parseFloat(adj_rate, 2)), num_per);
            var c = (b - 1) / adj_rate;
            var fv = a * c;
            pv = fv / b;
        }
        return pv;
    }

    // N = -log(1 - (r * FV / PMT)) / log(1 + r)
    // a = log(1 + r)
    // b = r * FV / PMT
    // c = (1 - b)
    function nper(adj_rate, pymnt, fv) {
        var nper;
        if (adj_rate == 0) {
            nper = fv / pymnt;
        } else {
            var a = Math.log10(1 + parseFloat(adj_rate, 2));
            var b = adj_rate * fv / pymnt;
            var c = 1 - b;
            var d = -(Math.log10(c));

            nper = d / a;
        }
        return nper;
    }

    // Javier Feliu's solution to implementing Excel's RATE function in JS
    var rate = function(nper, pmt, pv, fv, type, guess) {
        // Sets default values for missing parameters
        fv = typeof fv !== 'undefined' ? fv : 0;
        type = typeof type !== 'undefined' ? type : 0;
        guess = typeof guess !== 'undefined' ? guess : 0.1;
    
        // Sets the limits for possible guesses to any
        // number between 0% and 100%
        var lowLimit = 0;
        var highLimit = 1;
    
       // Defines a tolerance of up to +/- 0.00005% of pmt, to accept
       // the solution as valid.
       var tolerance = Math.abs(0.00000005 * pmt);
    
       // Tries at most 40 times to find a solution within the tolerance.
       for (var i = 0; i < 4000; i++) {
           // Resets the balance to the original pv.
           var balance = pv;
    
           // Calculates the balance at the end of the loan, based
           // on loan conditions.
           for (var j = 0; j < nper; j++ ) {
               if (type == 0) {
                   // Interests applied before payment
                   balance = balance * (1 + guess) + pmt;
               } else {
                   // Payments applied before insterests
                   balance = (balance + pmt) * (1 + guess);
               }
           }
    
           // Returns the guess if balance is within tolerance.  If not, adjusts
           // the limits and starts with a new guess.
           if (Math.abs(balance + fv) < tolerance) {
               return guess;
           } else if (balance + fv > 0) {
               // Sets a new highLimit knowing that
               // the current guess was too big.
               highLimit = guess;
           } else  {
               // Sets a new lowLimit knowing that
               // the current guess was too small.
               lowLimit = guess;
           }
    
           // Calculates the new guess.
           guess = (highLimit + lowLimit) / 2;
       }
    
       // Returns null if no acceptable result was found after 40 tries.
       return null;
    };
});