var jQuery;
if (window.jQuery === undefined || window.jQuery.fn.jquery !== '1.12.4') {
    var script_tag = document.createElement('script');
    script_tag.setAttribute("type","text/javascript");
    script_tag.setAttribute("src", "https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js");
    if (script_tag.readyState) {
        script_tag.onreadystatechange = function () { // For old versions of IE
            if (this.readyState == 'complete' || this.readyState == 'loaded') {
                scriptLoadHandler();
            }
        };
        } else { // Other browsers
        script_tag.onload = scriptLoadHandler;
        }
        // Try to find the head, otherwise default to the documentElement
        (document.getElementsByTagName("head")[0] || document.documentElement).appendChild(script_tag);
}
else {
    // The jQuery version on the window is the one we want to use
    jQuery = window.jQuery;
    main();
}

function scriptLoadHandler() {
    // Restore $ and window.jQuery to their previous values and store the
    // new jQuery in our local jQuery variable
    jQuery = window.jQuery.noConflict(true);
    // Call our main function
    main(); 
}

/******** Our main function ********/
function main() { 
    document.cookie = "SameSite=None;Secure";
    jQuery(document).ready(function($) { 
        /******* Load CSS *******/
        var css_link = $('<link>', { 
            rel: 'stylesheet', 
            type: 'text/css', 
            href: 'https://www.autoloancalculators.com/wp-content/themes/auto-loan-calculators/css/dist/calc-widget.min.css' 
        });
        css_link.appendTo('head');
        // Grabbing the controller data from the 'widget-props' attribute of the widget container
        var widget_props = $('#calculator-widget-container').data('widget-props');
        
        // console.log(typeof(widget_props));
        // widget_props = JSON.parse(widget_props);
        // Building out the model for our view using the data from the controller
        var widget = {
            title : widget_props.title,
            values : {
                price : widget_props.values.price,
                down_pymnt : widget_props.values.down_pymnt,
                rate : widget_props.values.rate,
                term : widget_props.values.term,
                rebate : widget_props.values.rebate,
                trade_in: widget_props.values.trade_in,
                amnt_owed : widget_props.values.amnt_owed,
                sales_tax : widget_props.values.sales_tax,
            },
            styles : {
                custom : {
                    sidebar : {
                        num_cols : widget_props.styles.custom.sidebar.num_cols,
                        bg : widget_props.styles.custom.sidebar.bg,
                        header_footer_bg : widget_props.styles.custom.sidebar.header_footer_bg,
                        header_footer_txt : widget_props.styles.custom.sidebar.header_footer_txt,
                        txt : widget_props.styles.custom.sidebar.txt,
                        btn : widget_props.styles.custom.sidebar.btn,
                        btn_txt : widget_props.styles.custom.sidebar.btn_txt,
                        border : widget_props.styles.custom.sidebar.border,
                        border_radius : widget_props.styles.custom.sidebar.border_radius,
                    },
                    results : {
                        bg : widget_props.styles.custom.results.bg,
                        border : widget_props.styles.custom.results.border,
                        txt : widget_props.styles.custom.results.txt,
                    },
                }
            }
        }
        // Pulling out the data for the values and styles from the widget model for easier access/syntax
        var values = widget.values;
        var sidebar = widget.styles.custom.sidebar;
        var results = widget.styles.custom.results;

        var price_input;
        var rate_input;
        var term_input;

        if (parseInt(values.price) == 0) {
            price_input = `<input required id="alc-price" class="form-input" type="text" name="alc-price" placeholder="0.00" step="0.01" /><!--#alc-price-->`
        }
        else {
            price_input = `<input required id="alc-price" class="form-input" type="text" name="alc-price" placeholder="0.00" step="0.01" value="${values.price}" /><!--#alc-price-->`;
        }

        if (parseInt(values.rate) == 0) {
            rate_input = '<input required id="alc-rate" class="form-input" type="number" name="alc-rate" placeholder="0.0" step="0.1" /><!--#alc-rate-->';
        }
        else {
            rate_input = `<input required id="alc-rate" class="form-input" type="number" name="alc-rate" placeholder="0.0" value="${values.rate}" step="0.1" /><!--#alc-rate-->`;
        }

        if (parseInt(values.term) == 0) {
            term_input = '<input required id="alc-term" class="form-input" type="number" name="alc-term" placeholder="0" /><!--#alc-term--></label>';
        }
        else {
            term_input = `<input required id="alc-term" class="form-input" type="number" name="alc-term" placeholder="0" value="${values.term}" /><!--#alc-term--></label>`
        }

        var widget_html = `
        <div id="calculator-widget" class="${sidebar.num_cols}">
            <header style="background-color:${sidebar.header_footer_bg};border-top-left-radius:${sidebar.border_radius};border-top-right-radius:${sidebar.border_radius};border-top:1px solid ${sidebar.border};border-left:1px solid ${sidebar.border};border-right:1px solid ${sidebar.border};" id="calculator-head">
                <h2 style="color:${sidebar.header_footer_txt}" id="calculator-title">${widget.title}</h2><!--#calculator-title-->
                <h3 class="calculator-error-msg" style="color:${sidebar.header_footer_txt}"></h3><!--.calculator-error-msg-->
            </header><!--#calculator-head-->
            <form id="alc-calculator" class="site-form calculator-form" action="/" method="post" style="background:${sidebar.bg};">
                <label class="form-label" for="alc-price" style="color:${sidebar.txt}">
                    <span class="form-copy">Price</span>
                    <span class="form-field money-field">${price_input}</span>
                </label><!--.form-label-->
                <label class="form-label" for="alc-down-pymnt" style="color:${sidebar.txt}">
                    <span class="form-copy">Down Payment</span>
                    <span class="form-field money-field">
                        <input id="alc-down-pymnt" class="form-input" type="text" name="alc-down-pymnt" placeholder="0.00" value="${values.down_pymnt}" step="0.01" /><!--#alc-down-pymnt-->
                    </span>
                </label><!--.form-label-->
                <label class="form-label" for="alc-rate" style="color:${sidebar.txt}">
                    <span class="form-copy">Rate</span>
                    <span class="form-field percent-field">${rate_input}</span>
                </label><!--.form-label-->
                <label class="form-label" for="alc-term" style="color:${sidebar.txt}">
                    <span class="form-copy">Term</span>
                    <span class="form-field year-field">${term_input}</span>
                </label><!--.form-label-->
                <label class="form-label" for="alc-rebate" style="color:${sidebar.txt}">
                    <span class="form-copy">Rebate</span>
                    <span class="form-field money-field">
                        <input id="alc-rebate" class="form-input" type="text" name="alc-rebate" placeholder="0.00" value="${values.rebate}" step="0.01" /><!--#alc-rebate-->
                    </span>
                </label><!--.form-label-->
                <label class="form-label" for="alc-trade-in" style="color:${sidebar.txt}">
                    <span class="form-copy">Value of Trade-In</span>
                    <span class="form-field money-field">
                        <input id="alc-trade-in" class="form-input" type="text" name="alc-trade-in" placeholder="0.00" value="${values.trade_in}" step="0.01" /><!--#alc-trade-in-->
                    </span>
                </label><!--.form-label-->
                <label class="form-label" for="alc-amnt-owed" style="color:${sidebar.txt}">
                    <span class="form-copy">Amount Owed</span>
                    <span class="form-field money-field">
                        <input id="alc-amnt-owed" class="form-input" type="text" name="alc-amnt-owed" placeholder="0.00" value="${values.amnt_owed}" step="0.01" /><!--#alc-price-->
                    </span>
                </label><!--.form-amnt-owed-->
                <label class="form-label" for="alc-sales-tax" style="color:${sidebar.txt}">
                    <span class="form-copy">Sales Tax Rate</span>
                    <span class="form-field percent-field">
                        <input id="alc-sales-tax" class="form-input" type="number" name="alc-sales-tax" placeholder="0.0" value="${values.sales_tax}" step="0.1" /><!--#alc-sales-tax-->
                    </span>
                </label><!--.form-label-->
                <input style="background-color:${sidebar.btn};color:${sidebar.btn_txt}" id="alc-submit" class="widget-submit" type="submit" value="Calculate" />
                <div id="alc-results" class="calculator-results" style="background-color:${results.bg}; border:1px solid ${results.border}; color:${results.txt}">
                    <div id="alc-result-totals" class="calculator-result-totals">
                        <div id="alc-mnthly-pymnt">
                            <h3 class="alc-total-amnt">$0.00</h3><!--#alc-total-amnt-->
                            <h4 class="alc-total-label">Estimated Monthly Car Payment</h4><!--.alc-total-label-->
                        </div><!--#alc-total-amnt-->
                        <div id="alc-total-loan">
                            <h3 class="alc-total-amnt">$0.00</h3><!--.alc-total-amnt-->
                            <h4 class="alc-total-label">Total Loan Amount</h4><!--.alc-total-label-->
                        </div><!--#alc-total-loan-->
                    </div><!--#alc-result-totals-->
                </div><!--#alc-results-->
                <span class="small-link-text">Powered by <a href="https://www.autoloancalculators.com">autoloancalculators.com</a></span>
            </form><!--#alc-calculator-->
            <footer id="calculator-footer" style="background-color:${sidebar.header_footer_bg};border-bottom-left-radius:${sidebar.border_radius};border-bottom-right-radius:${sidebar.border_radius};border-bottom:1px solid ${sidebar.border};border-left:1px solid ${sidebar.border};border-right:1px solid ${sidebar.border};"></footer><!--#calculator-footer-->
        </div><!--#calculator-widget-->`;
        $('#calculator-widget-container').html(widget_html);

        $('#alc-calculator .form-input').change(function() {
            var input_value = $(this).val();
            if ($(this).parent().hasClass('money-field')) {
                input_value = input_value.replace(',', '');
                input_value = parseFloat(input_value, 2);
                input_value = input_value.toLocaleString('en-US', { style: 'currency', currency: 'USD' });
                input_value = input_value.replace('$', '');
                $(this).val(input_value);
            }
        });

        $('#calculator-widget-container .widget-submit').click(function(e) {
            // Prevent default action on button click and form submission
            e.preventDefault();
            // Grabts the ID of the calculator form
            var form_id = $(this).parent('form').attr('id');
            form_id = '#' + form_id;
            // Runs form validation on each of the inputs, and if it passes, proceeds to calculate the results
            if (validate_form(form_id) == true) {
                var price = sanitize_currency($('#calculator-widget-container #alc-price').val()); // B8 in the excel sheet
                var down_pymnt = sanitize_currency($('#calculator-widget-container #alc-down-pymnt').val()); // B9 in the excel sheet
                var interest_rate = $('#calculator-widget-container #alc-rate').val(); // B10 in the excel sheet
                var term = $('#calculator-widget-container #alc-term').val(); // B11 in the excel sheet
                var rebate = sanitize_currency($('#calculator-widget-container #alc-rebate').val()); // B12 in the excel sheet
                var trade_in = sanitize_currency($('#calculator-widget-container #alc-trade-in').val()); // B13 in the excel sheet
                var amnt_owed = sanitize_currency($('#calculator-widget-container #alc-amnt-owed').val()); // B14 in the excel sheet
                var sales_tax = $('#calculator-widget-container #alc-sales-tax').val(); // B15 in the excel sheet

                var loan_amnt = price * (1 + parseFloat(sales_tax, 2)/100) - down_pymnt - rebate - trade_in + parseFloat(amnt_owed, 2);

                var present_value = loan_amnt;
                var num_per = term * 12;
                var adj_rate = interest_rate / 100 / 12;

                var mnthly_pymnt = pmt(adj_rate, num_per, present_value);

                var results = {
                    result_fields : {
                        mnthly_pymnt : {
                            result_id : '#calculator-widget-container #alc-mnthly-pymnt .alc-total-amnt',
                            result_value : mnthly_pymnt.toLocaleString('en-US', { style: 'currency', currency: 'USD' }),
                        },
                        loan_amnt : {
                            result_id : '#calculator-widget-container #alc-total-loan .alc-total-amnt',
                            result_value : loan_amnt.toLocaleString('en-US', { style: 'currency', currency: 'USD' }),
                        }
                    },
                }
                update_results(results);
                $('#calculator-widget #alc-calculator #alc-results').show();
            }
        });

        function sanitize_currency(value) {
            var clean_val = value.replace(',', '');
            clean_val = parseFloat(clean_val, 2);
            return clean_val;
        }

        function validate_form(form_id) {
            $('#calculator-widget-container ' + form_id + ' .form-input').removeClass('error-field');
            var valid = true;
            $('#calculator-widget-container ' + form_id + ' .form-input').each(function() {
                if (!$(this).val()) {
                    $(this).addClass('error-field');
                    $('#calculator-widget-container .calculator-error-msg').html("Please fill in the highlighted fields.");
                    valid = false;
                }
                if (valid) {
                    $('#calculator-widget-container .calculator-error-msg').html('');
                }
            });
            return valid;
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
    });
}
