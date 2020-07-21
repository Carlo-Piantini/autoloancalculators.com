jQuery(document).ready(function($) {
    // Defining the model for the widget with the default values of the controller
    var widget_props = $('#calc-widget-ui #calculator-widget-container').data('widget-props');
    // console.log(widget_props);
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

    // Building out the models for the different skins available
    var skin = {
        sidebar : {
            num_cols : 'one-column',
            bg : '#fff',
            header_footer_bg : '#000',
            header_footer_txt : '#fff',
            txt : '#000',
            btn : '#043962',
            btn_txt : '#fff',
            border : '#000',
            border_radius: '0px',
        },
    }

    function updateWidget(widget) {
        var embedCode = `<script src="https://www.autoloancalculators.com/wp-content/themes/auto-loan-calculators/js/dist/calc-widget.min.js" type="text/javascript"></script><div id="calculator-widget-container" data-widget-props='{"title":"${widget.title}", "values":{"price":"${widget.values.price}", "down_pymnt":"${widget.values.down_pymnt}", "rate":"${widget.values.rate}", "term":"${widget.values.term}", "rebate":"${widget.values.rebate}", "trade_in":"${widget.values.trade_in}", "amnt_owed":"${widget.values.amnt_owed}", "sales_tax":"${widget.values.sales_tax}"}, "styles":{"custom":{"sidebar":{"num_cols":"${widget.styles.custom.sidebar.num_cols}", "bg":"${widget.styles.custom.sidebar.bg}", "header_footer_bg":"${widget.styles.custom.sidebar.header_footer_bg}", "header_footer_txt":"${widget.styles.custom.sidebar.header_footer_txt}", "txt":"${widget.styles.custom.sidebar.txt}", "btn":"${widget.styles.custom.sidebar.btn}", "btn_txt":"${widget.styles.custom.sidebar.btn_txt}", "border":"${widget.styles.custom.sidebar.border}", "border-radius":"${widget.styles.custom.sidebar.border_radius}"}, "results":{"bg":"${widget.styles.custom.results.bg}", "border":"${widget.styles.custom.results.border}", "txt":"${widget.styles.custom.results.txt}"}}}}'></div>`;
        var widget_string = JSON.stringify(widget);

        var calculator_widget = document.getElementById('calculator-widget-container');
        calculator_widget.setAttribute('data-widget-props', widget_string);
        // $('#calculator-widget-container').data('widget-props', widget_string);
        $('#calc-widget-code').val(embedCode);
    }

    // Initializing all of our color picker inputs through the iris.min.js lib
    $('.color-picker').iris({
        change: function(event, ui) {
            var style_prop = $(this).data('style-prop');
            var style_parent = $(this).parents('.style-parent').data('style-parent');
            
            widget.styles.custom[style_parent][style_prop] = ui.color.toString();
            widget.styles.default_skin = false;
            widget.styles.skin = 'custom-skin';

            switch (style_parent) {
                case 'sidebar':
                    switch (style_prop) {
                        case 'bg':
                            $('#calc-widget-ui #calculator-widget .calculator-form').css('background-color', widget.styles.custom[style_parent][style_prop]);
                            break;
                        case 'header_footer_bg':
                            $('#calc-widget-ui #calculator-widget #calculator-head').css('background-color', widget.styles.custom[style_parent][style_prop]);
                            $('#calc-widget-ui #calculator-widget #calculator-footer').css('background-color', widget.styles.custom[style_parent][style_prop]);
                            break;
                        case 'header_footer_txt':
                            $('#calc-widget-ui #calculator-widget #calculator-head h2').css('color', widget.styles.custom[style_parent][style_prop]);
                            $('#calc-widget-ui #calculator-widget #calculator-head h3').css('color', widget.styles.custom[style_parent][style_prop]);
                            break;
                        case 'txt':
                            $('#calc-widget-ui #calculator-widget .calculator-form label').css('color', widget.styles.custom[style_parent][style_prop]);
                            break;
                        case 'btn':
                            $('#calc-widget-ui #calculator-widget .widget-submit').css('background-color', widget.styles.custom[style_parent][style_prop]);
                            break;
                        case 'btn_txt':
                            $('#calc-widget-ui #calculator-widget .widget-submit').css('color', widget.styles.custom[style_parent][style_prop]);
                            break;
                        case 'border':
                            // $('#calculator-widget .calculator-form').css('border-left', `1px solid ${widget.styles.custom[style_parent][style_prop]}`);
                            // $('#calculator-widget .calculator-form').css('border-right', `1px solid ${widget.styles.custom[style_parent][style_prop]}`);

                            $('#calc-widget-ui #calculator-widget #calculator-head').css('border-top', `1px solid ${widget.styles.custom[style_parent][style_prop]}`);
                            $('#calc-widget-ui #calculator-widget #calculator-head').css('border-left', `1px solid ${widget.styles.custom[style_parent][style_prop]}`);
                            $('#calc-widget-ui #calculator-widget #calculator-head').css('border-right', `1px solid ${widget.styles.custom[style_parent][style_prop]}`);

                            $('#calc-widget-ui #calculator-widget #calculator-footer').css('border-bottom', `1px solid ${widget.styles.custom[style_parent][style_prop]}`);
                            $('#calc-widget-ui #calculator-widget #calculator-footer').css('border-left', `1px solid ${widget.styles.custom[style_parent][style_prop]}`);
                            $('#calc-widget-ui #calculator-widget #calculator-footer').css('border-right', `1px solid ${widget.styles.custom[style_parent][style_prop]}`);
                            break;
                    }
                    break;
                case 'results' :
                    switch (style_prop) {
                        case 'bg' :
                            $('#calc-widget-ui #calculator-widget .calculator-results').css('background-color', widget.styles.custom[style_parent][style_prop]);
                            break;
                        case 'border' :
                            $('#calc-widget-ui #calculator-widget .calculator-results').css('border', `1px solid ${widget.styles.custom[style_parent][style_prop]}`);
                            break;
                        case 'txt' :
                            $('#calc-widget-ui #calculator-widget .calculator-results').css('color', widget.styles.custom[style_parent][style_prop]);
                            break;
                    }
                    break;
            }            
            updateWidget(widget);
        }
    });
    $(document).click(function() {
        $('.color-picker').iris('hide');
    });
    $('.color-picker').click(function(event) {
        event.stopPropagation();
        $('.color-picker').iris('hide');
        $(this).iris('show');
    });

    $('#widget-style-border-radius').on('input', function() {
        var new_radius = $(this).val();
        widget.styles.custom.sidebar.border_radius = new_radius;
        $('#calc-widget-ui #calculator-widget #calculator-head').css("border-top-left-radius", `${widget.styles.custom.sidebar.border_radius}px`);
        $('#calc-widget-ui #calculator-widget #calculator-head').css("border-top-right-radius", `${widget.styles.custom.sidebar.border_radius}px`);
        $('#calc-widget-ui #calculator-widget #calculator-footer').css("border-bottom-left-radius", `${widget.styles.custom.sidebar.border_radius}px`);
        $('#calc-widget-ui #calculator-widget #calculator-footer').css("border-bottom-right-radius", `${widget.styles.custom.sidebar.border_radius}px`);
        updateWidget(widget);
    });

    $('.widget-column-input').click(function() {
        widget.styles.custom.sidebar.num_cols = $(this).val();
        $('#calc-widget-ui #calculator-widget').removeClass('one-column');
        $('#calc-widget-ui #calculator-widget').removeClass('two-column');
        $('#calc-widget-ui #calculator-widget').addClass(widget.styles.custom.sidebar.num_cols);
        updateWidget(widget);
    });

    $('#calc-selector-colors').change(function() {
        var selectedSkin = $(this).val();

        if (selectedSkin == 'blue') {
            selectedSkin = '#043962';
        } 

        skin.sidebar.header_footer_bg = selectedSkin;
        if (selectedSkin == 'custom') {
            $('#widget-styles').show();
        }
        else if (selectedSkin == 'white') {
            $('#widget-styles').hide();
            skin.sidebar.header_footer_txt = 'black';
            skin.sidebar.border = '1px solid #cdcdcd';
        }
        else {
            $('#widget-styles').hide();
            skin.sidebar.header_footer_txt = 'white';
            skin.sidebar.border = `1px solid ${selectedSkin}`;
        }
        widget.styles.custom.sidebar = skin.sidebar;
        $('#calc-widget-ui #calculator-widget .calculator-form').css('background-color', widget.styles.custom.sidebar.bg);
        $('#calc-widget-ui #calculator-widget #calculator-head').css('background-color', widget.styles.custom.sidebar.header_footer_bg);
        
        $('#calc-widget-ui #calculator-widget #calculator-head').css('border-left', widget.styles.custom.sidebar.border);
        $('#calc-widget-ui #calculator-widget #calculator-head').css('border-right', widget.styles.custom.sidebar.border);
        $('#calc-widget-ui #calculator-widget #calculator-head').css('border-top', widget.styles.custom.sidebar.border);
       
        $('#calc-widget-ui #calculator-widget #calculator-footer').css('border-bottom', widget.styles.custom.sidebar.border);
        $('#calc-widget-ui #calculator-widget #calculator-footer').css('border-left', widget.styles.custom.sidebar.border);
        $('#calc-widget-ui #calculator-widget #calculator-footer').css('border-right', widget.styles.custom.sidebar.border);

        $('#calc-widget-ui #calculator-widget #calculator-footer').css('background-color', widget.styles.custom.sidebar.header_footer_bg);
        $('#calc-widget-ui #calculator-widget #calculator-head h2').css('color', widget.styles.custom.sidebar.header_footer_txt);
        $('#calc-widget-ui #calculator-widget #calculator-head h3').css('color', widget.styles.custom.sidebar.header_footer_txt);
        $('#calc-widget-ui #calculator-widget .calculator-form label').css('color', widget.styles.custom.sidebar.txt);
        $('#calc-widget-ui #calculator-widget .widget-submit').css('background-color', widget.styles.custom.sidebar.btn);
        $('#calc-widget-ui #calculator-widget .widget-submit').css('color', widget.styles.custom.sidebar.btn_txt);
        // $('#calculator-widget').css('border', `1px solid ${widget.styles.custom.sidebar.border}`);
        $('#calc-widget-ui #calculator-widget .calculator-results').css('background-color', widget.styles.custom.results.bg);
        $('#calc-widget-ui #calculator-widget .calculator-results').css('border', `1px solid ${widget.styles.custom.results.border}`);
        $('#calc-widget-ui #calculator-widget .calculator-results').css('color', widget.styles.custom.results.txt);
        updateWidget(widget);
    });
    $('#calc-change-title').on('input', function() {
        var newTitle = $(this).val();
        widget.title = newTitle;
        $('#calc-widget-ui #calculator-widget-container #calculator-title').html(newTitle);
        updateWidget(widget);
    });
    $('#widget-values .widget-input input').on('change', function() {
        var widget_prop = $(this).data('widget-prop');
        var widget_id = widget_prop.replace('_', '-');
        var input_value = $(this).val();

        if ($(this).parent().hasClass('money-wrap')) {
            input_value = input_value.replace(',', '');
            input_value = parseFloat(input_value, 2);
            input_value = input_value.toLocaleString('en-US', { style: 'currency', currency: 'USD' });
            input_value = input_value.replace('$', '');
            $(this).val(input_value);
        }

        var newValue = input_value; // input_value.replace(',', '');
        widget.values[widget_prop] = newValue;
        // $(`#calculator-widget-container`).data(inputId, newValue);
        $(`#calc-widget-ui #calculator-widget-container #alc-${widget_id}`).val(newValue);
        updateWidget(widget);
    });

    // UI for the widget panels
    $('.calc-widget-tab').click(function(e) {
        e.preventDefault();
        $('#calc-widget-ui .calc-widget-tab').removeClass('active');
        $('#calc-widget-ui .calc-widget-panel').removeClass('active');
        $('#calc-widget-ui .calc-widget-tab').addClass('inactive');
        $('#calc-widget-ui .calc-widget-panel').addClass('inactive');

        var tab_target = $(this).data('target');
        $(this).removeClass('inactive');
        $(this).addClass('active');
        $(`#${tab_target}`).removeClass('inactive');
        $(`#${tab_target}`).addClass('active');
    });

    // UI for the buttons that allow you to modify the widget's default values
    $('.widget-ui-toggle').click(function(e) {
        e.preventDefault();
        if ($(this).attr('id') == 'widget-values-toggle') {
            $('#widget-styles-toggle').data('state', 'inactive')
            $('#widget-styles').removeClass('active');
            $('#widget-styles').addClass('inactive');
        }
        else if ($(this).attr('id') == 'widget-styles-toggle') {
            $('#widget-values-toggle').data('state', 'inactive');
            $('#widget-values').removeClass('active');
            $('#widget-values').addClass('inactive');
        }
        var state = $(this).data("state");
        var target = $(this).data("target");
        if (state == 'inactive') {
            $(this).data("state", "active");
            $(target).removeClass('inactive');
            $(target).addClass('active');
        }
        else if (state == 'active') {
            $(this).data("state", "inactive");
            $(target).removeClass('active');
            $(target).addClass('inactive');
        }
    });
});