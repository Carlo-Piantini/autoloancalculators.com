<div id="calc-widget-ui">
    <h3 class="form-header">Free Auto Calculator Widget</h3><!--.form-header-->
    <hr/>

    <div id="calc-widget-tabs">
        <a class="calc-widget-tab active" data-target="calc-widget-inputs"><span class="btn-icon"><?php get_template_part('images/icons/inline', 'cog.svg'); ?></span>Configure</a><!--.calc-widget-tab--> 
        <a class="calc-widget-tab inactive" data-target="calc-widget-preview"><span class="btn-icon"><?php get_template_part('images/icons/inline', 'eye.svg'); ?></span>Preview</a><!--.calc-widget-tab-->
    </div><!--#calc-widget-tabs-->
    <hr/>

    <div id="calc-widget-inputs" class="calc-widget-panel active">
        <div id="calc-widget-selector">
            <div class="widget-field">
                <span class="form-copy"><strong>1. </strong>Choose an Accent Color.</span>
                <select id="calc-selector-colors" name="calc-selector-colors">
                    <option selected value="black">Black</option>
                    <option value="blue">Blue</option>
                    <option value="green">Green</option>
                    <option value="grey">Grey</option>
                    <option value="orange">Orange</option>
                    <option value="red">Red</option>
                    <option value="white">White</option>
                    <option value="custom">Fully Customize Your Widget</option>
                </select><!--#calc-selector-colors-->
            </div><!--.widget-field-->
            <div class="widget-field">
                <p><strong>2. </strong>Please input a heading for the widget.</p>
                <input type="text" id="calc-change-title" name="calc-change-title" placeholder="Auto Loan Calculator" />
            </div><!--.widget-field-->

            <?php // <button id="widget-styles-toggle" class="widget-ui-toggle" data-state="inactive" data-target="#widget-styles"><strong>3. </strong>Set Custom Styles</button> ?>
            <button id="widget-values-toggle" class="widget-ui-toggle" data-state="inactive" data-target="#widget-values"><strong>3. </strong>Enter Desired Default Values</button>

            <div id="widget-style-columns">
                <p><strong>4. </strong>Number of Columns</p>
                <input id="widget-1-column" class="widget-column-input" type="radio" name="widget-column-input" value="one-column" checked="checked"/>
                <label class="widget-column-label" for="widget-1-column">1</label><!--.widget-column-label-->
                <input id="widget-2-column" class="widget-column-input" type="radio" name="widget-column-input" value="two-column"/>
                <label class="widget-column-label" for="widget-2-column">2</label><!--.widget-column-label-->
            </div><div class="break"></div><!--#widget-style-columns-->

            <div id="widget-values" class="inactive">
                <label class="widget-input">
                    <span class="form-copy">Price</span>
                    <span class="widget-input-wrap money-wrap">
                        <input id="widget-price" name="widget-price" type="text" value="0.00" placeholder="0.00" data-widget-prop="price" />
                    </span> 
                </label><!--.widget-input-->
                <label class="widget-input">
                    <span class="form-copy">Down Payment</span>
                    <span class="widget-input-wrap money-wrap">
                        <input id="widget-down-pymnt" name="widget-down-pymnt" type="text" value="0.00" placeholder="0.00" data-widget-prop="down_pymnt" /> 
                    </span>
                </label><!--.widget-input-->
                <label class="widget-input">
                    <span class="form-copy">Rate</span>
                    <span class="widget-input-wrap percent-wrap">
                        <input id="widget-rate" name="widget-rate" type="number" value="0.0" placeholder="0.0" step="0.1" data-widget-prop="rate" /> 
                    </span>
                </label><!--.widget-input-->
                <label class="widget-input">
                    <span class="form-copy">Term</span>
                    <span class="widget-input-wrap year-wrap">
                        <input id="widget-term" name="widget-term" type="number" value="0" placeholder="0" data-widget-prop="term" /> 
                    </span>
                </label><!--.widget-input-->
                <label class="widget-input">
                    <span class="form-copy">Rebate</span>
                    <span class="widget-input-wrap money-wrap">
                        <input id="widget-rebate" name="widget-rebate" type="text" value="0.00" placeholder="0.00" data-widget-prop="rebate" /> 
                    </span>
                </label><!--.widget-input-->
                <label class="widget-input">
                    <span class="form-copy">Value of Trade-In</span>
                    <span class="widget-input-wrap money-wrap">
                        <input id="widget-trade-in" name="widget-trade-in" type="text" value="0.00" placeholder="0.00" data-widget-prop="trade_in" /> 
                    </span>
                </label><!--.widget-input-->
                <label class="widget-input">
                    <span class="form-copy">Amount Owed</span>
                    <span class="widget-input-wrap money-wrap">
                        <input id="widget-amnt-owed" name="widget-amnt-owed" type="text" value="0.00" placeholder="0.00" data-widget-prop="amnt_owed" /> 
                    </span>
                </label><!--.widget-input-->
                <label class="widget-input">
                    <span class="form-copy">Sales Tax Rate</span>
                    <span class="widget-input-wrap percent-wrap">
                        <input id="widget-sales-tax" name="widget-sales-tax" type="number" value="0.0" placeholder="0.0" step="0.1" data-widget-prop="sales_tax" />
                    </span>
                </label><!--.widget-input-->
            </div><!--#widge-values-->
            
            <div id="widget-styles" class="inactive">
                <div id="widget-sidebar-styles" class="style-parent" data-style-parent="sidebar">
                    <p class="widget-head">Customize Widget</p><!--.widget-head-->
                    <div class="widget-body">
                        <label class="widget-style">
                            <span class="widget-copy">Accent Color</span>
                            <input type="text" class="color-picker" data-style-prop="header_footer_bg" value="#bada55" />
                        </label><!--.widget-style-->
                        <label class="widget-style">
                            <span class="widget-copy">Header Text Color</span>
                            <input type="text" class="color-picker" data-style-prop="header_footer_txt" value="#bada55" />
                        </label><!--.widget-style-->
                        <label class="widget-style">
                            <span class="widget-copy">Background Color</span>
                            <input type="text" class="color-picker" data-style-prop="bg" value="#bada55" />
                        </label><!--.widget-style-->
                        <label class="widget-style">
                            <span class="widget-copy">Text Color</span>
                            <input type="text" class="color-picker" data-style-prop="txt" value="#bada55" />
                        </label><!--.widget-style-->
                        <label class="widget-style">
                            <span class="widget-copy">Border Color</span>
                            <input type="text" class="color-picker" data-style-prop="border" value="#bada55" />
                        </label><!--.widget-style-->
                        <label class="widget-style">
                            <span class="widget-copy">Border Radius</span>
                            <input id="widget-style-border-radius" type="number" placeholder="0" value="0" />
                        </label><!--.widget-style-->
                        <label class="widget-style">
                            <span class="widget-copy">Button Background</span>
                            <input type="text" class="color-picker" data-style-prop="btn" value="#bada55" />
                        </label><!--.widget-style-->
                        <label class="widget-style">
                            <span class="widget-copy">Button Text Color</span>
                            <input type="text" class="color-picker" data-style-prop="btn_txt" value="#bada55" />
                        </label><!--.widget-style-->
                    </div><!--.widget-body-->
                </div>
                <div id="widget-results-styles" class="style-parent" data-style-parent="results">
                    <p class="widget-head">Customize Results</p><!--.widget-head-->
                    <div class="widget-body">
                        <label class="widget-style">
                            <span class="widget-copy">Background Color</span>
                            <input type="text" class="color-picker" data-style-prop="bg" value="#bada55" />
                        </label><!--.widget-style-->
                        <label class="widget-style">
                            <span class="widget-copy">Border Color</span>
                            <input type="text" class="color-picker" data-style-prop="border" value="#bada55" />
                        </label><!--.widget-style-->
                        <label class="widget-style">
                            <span class="widget-copy">Text Color</span>
                            <input type="text" class="color-picker" data-style-prop="txt" value="#bada55" />
                        </label><!--.widget-style-->
                    </div><!--.widget-body-->
                </div>
            </div><!--#widge-values-->
        </div>
        <div id="calc-widget-embed">
            <p><strong>5.</strong> Copy and paste the code below into your website:</p>
            <textarea id="calc-widget-code" placeholder="Copy and Paste this code onto your website when all your changes have been made."><script src="https://www.autoloancalculators.com/wp-content/themes/auto-loan-calculators/js/dist/calc-widget.min.js" type="text/javascript"></script><div id="calculator-widget-container" data-widget-props='{"title":"Auto Loan Calculator", "values":{"price":"0.00", "down_pymnt":"0.00", "rate":"0.0", "term":"0", "rebate":"0.00", "trade_in":"0.00", "amnt_owed":"0.00", "sales_tax":"0.0"}, "styles":{"skin":"black-skin", "default_skin":true, "custom":{"sidebar":{"num_cols":"one-column", "bg":"#fff", "header_footer_bg":"#000", "header_footer_txt":"#fff", "txt":"#000", "btn":"#043962", "btn_txt":"#fff", "border":"#000", "border_radius":"10px"}, "results":{"bg":"#fcfcfc", "border":"#dedede", "txt":"#333"}}}}'></div></textarea><!--#calc-widget-code-->
        </div><!--#calc-widget-embed-->
    </div>
    <div id="calc-widget-preview" class="calc-widget-panel inactive">
        <div id="calculator-widget-container" data-widget-props='{"title":"Auto Loan Calculator", "values":{"price":"0.00", "down_pymnt":"0.00", "rate":"0.0", "term":"0", "rebate":"0.00", "trade_in":"0.00", "amnt_owed":"0.00", "sales_tax":"0.0"}, "styles":{"skin":"black-skin", "default_skin":true, "custom":{"sidebar":{"num_cols":"one-column", "bg":"#fff", "header_footer_bg":"#000", "header_footer_txt":"#fff", "txt":"#000", "btn":"#043962", "btn_txt":"#fff", "border":"#000", "border_radius":"10px"}, "results":{"bg":"#fcfcfc", "border":"#dedede", "txt":"#333"}}}}'></div>
    </div><!--#calc-widget-preview-->
</div><!--#calc-widget-ui-->
