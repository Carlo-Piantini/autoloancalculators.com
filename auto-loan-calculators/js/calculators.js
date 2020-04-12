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
                    var down_pymnt = $('#alc-down-pymnt').val(); // B9 in the excel sheet
                    var interest_rate = $('#alc-rate').val(); // B10 in the excel sheet
                    var term = $('#alc-term').val(); // B11 in the excel sheet
                    var rebate = $('#alc-rebate').val(); // B12 in the excel sheet
                    var trade_in = $('#alc-trade-in').val(); // B13 in the excel sheet
                    var amnt_owed = $('#alc-amnt-owed').val(); // B14 in the excel sheet
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
                                result_value : '$' + parseFloat(mnthly_pymnt).toFixed(2),
                            },
                            payoff_date : {
                                result_id : '#alc-payoff-date',
                                result_value : new_payoff_date(term),
                            },
                            loan_amnt : {
                                result_id : '#alc-total-loan .alc-total-amnt',
                                result_value : '$' + parseFloat(loan_amnt).toFixed(2),
                            },
                            total_interest : {
                                result_id : '#alc-total-interest .alc-total-amnt',
                                result_value : '$' + parseFloat(total_interest).toFixed(2),
                            },
                            total_pymnt : {
                                result_id : '#alc-total-pymnts .alc-total-amnt',
                                result_value : '$' + parseFloat(total_pymnt).toFixed(2),
                            },
                        },
                    }
                    update_results(results);
                    break;
                // Calculates the ersults if the form is the Affordability Calculator
                case '#affordability-calculator':
                    var desired_pymnt = $('#affordability-desired-pymnt').val();
                    var down_pymnt = $('#affordability-down-pymnt').val();
                    var trade_in = $('#affordability-trade-in').val();
                    var amnt_owed = $('#affordability-amnt-owed').val();
                    var term = $('#affordability-term').val();
                    var interest_rate = $('#affordability-interest-rate').val();
                    var total_pymnt = (desired_pymnt * term * 12).toFixed(2);

                    var pymnt = desired_pymnt;
                    var num_per = term * 12;
                    var adj_rate = interest_rate / 100 / 12;

                    var price = pv(adj_rate, num_per, pymnt) + parseFloat(down_pymnt, 2) + parseFloat(trade_in, 2) - amnt_owed;
                    var loan_amnt = price - trade_in + parseFloat(amnt_owed, 2) - down_pymnt;
                    var total_interest = (total_pymnt - loan_amnt).toFixed(2);
                    var results = {
                        result_fields : {
                            price : {
                                result_id : '#affordability-price',
                                result_value : '$' + parseFloat(price, 2).toFixed(2),
                            },
                            loan_amnt : {
                                result_id : '#affordability-total-loan .affordability-total-amnt',
                                result_value : '$' + parseFloat(loan_amnt, 2).toFixed(2),
                            },
                            total_interest : {
                                result_id : '#affordability-total-interest .affordability-total-amnt',
                                result_value : '$' + parseFloat(total_interest, 2).toFixed(2),
                            },
                            total_pymnt : {
                                result_id : '#affordability-total-pymnts .affordability-total-amnt',
                                result_value : '$' + parseFloat(total_pymnt, 2).toFixed(2),
                            },
                        },
                    }
                    update_results(results);
                    break;
                case '#refinance-calculator':
                    var mnthly_pymnt = $('#refinance-mnthly-pymnt').val();
                    var loan_balance = $('#refinance-loan-balance').val();
                    var interest_rate = $('#refinance-interest-rate').val();
                    var new_rate = $('#refinance-new-rate').val();
                    var new_term = $('#refinance-new-term').val();

                    var present_value = loan_balance;
                    var num_per = new_term * 12;
                    var adj_rate = interest_rate / 100 / 12;
                    var adj_new_rate = new_rate / 100 / 12;

                    var new_pymnt = pmt(adj_new_rate, num_per, present_value);
                    
                    var old_nper = nper(adj_rate, mnthly_pymnt, loan_balance);
                    var old_interest = (old_nper * mnthly_pymnt) - loan_balance;
                    var new_interest = (new_pymnt * new_term * 12) - loan_balance;
                    var interest_difference = old_interest - new_interest; 

                    var mnthly_savings = parseFloat(mnthly_pymnt, 2).toFixed(2) - parseFloat(new_pymnt, 2).toFixed(2);
                    var new_total = parseFloat(new_pymnt, 2).toFixed(2) * num_per;
                    var results = {
                        result_fields : {
                            new_pymnt : {
                                result_id : '#refinance-new-pymnt',
                                result_value : '$' + parseFloat(new_pymnt, 2).toFixed(2),
                            },
                            mnthly_savings : {
                                result_id : '#refinance-mnthly-savings .refinance-total-amnt',
                                result_value : '$' + parseFloat(mnthly_savings, 2).toFixed(2),
                            },
                            difference_in_interest : {
                                result_id : '#refinance-difference-in-interest .refinance-total-amnt',
                                result_value : '$' + parseFloat(interest_difference, 2).toFixed(2),
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
                    update_results(results);
                    break;
                case '#auto-lease-calculator':
                    var vehicle_price = $('#auto-lease-vehicle-price').val();
                    var rebates_incentives = $('#auto-lease-rebates-incentives').val();
                    var down_pymnt = $('#auto-lease-down-pymnt').val();
                    var interest_rate = $('#auto-lease-interest-rate').val();
                    var lease_term = $('#auto-lease-term').val();
                    var trade_value = $('#auto-lease-trade-value').val();
                    var amnt_owed = $('#auto-lease-amnt-owed').val();
                    var residual_value = $('#auto-lease-residual-value').val();
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
                                result_value : '$' + parseFloat(mnthly_lease).toFixed(2),
                            },
                            mnthly_depreciation : {
                                result_id : '#auto-lease-mnthly-depreciation .auto-lease-total-amnt',
                                result_value : '$' + parseFloat(mnthly_depreciation).toFixed(2),
                            },
                            finance_fee : {
                                result_id : '#auto-lease-finance-fee .auto-lease-total-amnt',
                                result_value : '$' + parseFloat(mnthly_fee).toFixed(2),
                            },
                            new_tax : {
                                result_id : '#auto-lease-mnthly-sales-tax .auto-lease-total-amnt',
                                result_value : parseFloat(new_tax).toFixed(2) + '%',
                            },
                            lease_pymnt : {
                                result_id : '#auto-lease-total-lease-pymnt .auto-lease-total-amnt',
                                result_value : '$' + parseFloat(total_pymnt).toFixed(2),
                            },
                            purchased_instead : {
                                result_id : '#auto-lease-purchased-instead .auto-lease-total-amnt',
                                result_value : '$' + parseFloat(purchased_instead).toFixed(2),
                            }
                        }
                    }
                    update_results(results);
                    break;
                case '#auto-lir-calculator':
                    var mnthly_pymnt = $('#auto-lir-mnthly-pymnt').val();
                    var down_pymnt = $('#auto-lir-down-pymnt').val();
                    var price = $('#auto-lir-price').val();
                    var trade_in = $('#auto-lir-trade-in').val();
                    var term = $('#auto-lir-term').val();

                    var adj_price = price - down_pymnt - trade_in;
                    var num_per = term * 12;

                    var interest_rate = rate(num_per, -mnthly_pymnt, adj_price) * 12 * 100;
                    var total_pymnt = mnthly_pymnt * term * 12;
                    var total_interest = total_pymnt - (price - down_pymnt - trade_in);

                    results = {
                        result_fields : {
                            interest_rate : {
                                result_id : '#auto-lir-interest-rate .auto-lir-total-amnt',
                                result_value : parseFloat(interest_rate).toFixed(2) + '%',
                            },
                            total_pymnt : {
                                result_id : '#auto-lir-total-pymnts .auto-lir-total-amnt',
                                result_value : '$' + parseFloat(total_pymnt, 2).toFixed(2),
                            },
                            total_interest : {
                                result_id : '#auto-lir-total-interest .auto-lir-total-amnt',
                                result_value : '$' + parseFloat(total_interest, 2).toFixed(2)
                            }
                        }
                    }
                    update_results(results);
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
        var a = present_value;
        var b = Math.pow((1 + parseFloat(adj_rate, 2)), num_per);
        var c = adj_rate * b;
        var d = b - 1;
        var pmt = (a * c / d);
        return pmt;
    }

    // FV = PMT * ((1 + r)^nper - 1) / r)
    // FV = PV * (1 + r)^nper
    // PV = FV / (1 + r)^nper
    function pv(adj_rate, num_per, pymnt) {
        var a = pymnt;
        var b = Math.pow((1 + parseFloat(adj_rate, 2)), num_per);
        var c = (b - 1) / adj_rate;
        var fv = a * c;
        var pv = fv / b;
        return pv;
    }

    // N = -log(1 - (r * FV / PMT)) / log(1 + r)
    // a = log(1 + r)
    // b = r * FV / PMT
    // c = (1 - b)
    function nper(adj_rate, pymnt, fv) {
        var a = Math.log10(1 + parseFloat(adj_rate, 2));
        var b = adj_rate * fv / pymnt;
        var c = 1 - b;
        var d = -(Math.log10(c));

        var nper = d / a;
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