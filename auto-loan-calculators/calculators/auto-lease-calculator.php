<h1 id="main-title">Auto Lease Calculator</h1><!--#main-title-->
<a class="subtitle-menu-toggle inactive" href="#">More Calculators</a>
<h2 id="main-subtitle"><?php the_field('calculator_description'); ?></h2><!--#main-subtitle-->

<?php // <h3 class="calculator-error-msg"></h3><!--.calculator-error-msg--> ?>

<form id="auto-lease-calculator" class="site-form calculator-form" action="/" method="post">
    <label class="form-label" for="auto-lease-vehicle-price">
        <span class="form-copy">Vehicle Price</span>
        <span class="form-field money-field">
            <input id="auto-lease-vehicle-price" class="form-input" type="text" name="auto-lease-vehicle-price" placeholder="0.00" data-email-label="Vehicle Price" /><!--#auto-lease-vehicle-price-->
        </span>
    </label><!--.form-label-->
    <label class="form-label" for="auto-lease-rebates-incentives">
        <span class="form-copy">Rebates and Incentives</span>
        <span class="form-field money-field">
            <input id="auto-lease-rebates-incentives" class="form-input" type="text" name="auto-lease-rebates-incentives" placeholder="0.00" value="0.00" data-email-label="Rebates and Incentives" /><!--#auto-lease-rebates-incentives-->
        </span>
    </label><!--.form-label-->
    <label class="form-label" for="auto-lease-down-pymnt">
        <span class="form-copy">Down Payment</span>
        <span class="form-field money-field">
            <input id="auto-lease-down-pymnt" class="form-input" type="text" name="auto-lease-down-pymnt" placeholder="0.00" value="0.00" data-email-label="Down Payment" /><!--#auto-lease-down-pymnt-->
        </span>
    </label><!--.form-label-->
    <label class="form-label" for="auto-lease-interest-rate">
        <span class="form-copy">Interest Rate</span>
        <span class="form-field percent-field">
            <input id="auto-lease-interest-rate" class="form-input" type="number" name="auto-lease-interest-rate" placeholder="0.0" step="0.1" data-email-label="Interest Rate" /><!--#auto-lease-interest-rate-->
        </span>
    </label><!--.form-label-->
    <label class="form-label" for="auto-lease-term">
        <span class="form-copy">Lease Term</span>
        <span class="form-field year-field">
            <input id="auto-lease-term" class="form-input" type="number" name="auto-lease-lease-term" placeholder="0" data-email-label="Lease Term" /><!--#auto-lease-term-->
        </span>
    </label><!--.form-label-->
    <label class="form-label" for="auto-lease-trade-value">
        <span class="form-copy">Trade-In Value</span>
        <span class="form-field money-field">
            <input id="auto-lease-trade-value" class="form-input" type="text" name="auto-lease-trade-value" placeholder="0.00" value="0.00" data-email-label="Trade-In Value" /><!--#auto-lease-trade-value-->
        </span>
    </label><!--.form-label-->
    <label class="form-label" for="auto-lease-amnt-owed">
        <span class="form-copy">Amount Owed on Trade-In</span>
        <span class="form-field money-field">
            <input id="auto-lease-amnt-owed" class="form-input" type="text" name="auto-lease-amnt-owed" placeholder="0.00" value="0.00" data-email-label="Amount Owed on Trade-In" /><!--#auto-lease-amnt-owed-->
        </span>
    </label><!--.form-label-->
    <label class="form-label" for="auto-lease-residual-value">
        <span class="form-copy">Residual Value</span>
        <span class="form-field money-field">
            <input id="auto-lease-residual-value" class="form-input" type="text" name="auto-lease-residual-value" placeholder="0.00" data-email-label="Residual Value" /><!--#auto-lease-residual-value-->
        </span>
    </label><!--.form-label-->
    <label class="form-label" for="auto-lease-sales-tax">
        <span class="form-copy">Sales Tax Rate</span>
        <span class="form-field percent-field">
            <input id="auto-lease-sales-tax" class="form-input" type="number" name="auto-lease-sales-tax" placeholder="0.0" value="0.0" step="0.1" data-email-label="Sales Tax Rate" /><!--#auto-lease-sales-tax-->
        </span>
    </label><!--.form-label-->
    <div class="break"></div><!--.break-->
    <input id="auto-lease-submit" class="calculator-submit" type="submit" value="Calculate" />
</form><!--#auto-lease-calculator.site-form.calculator-form-->

<?php get_template_part('template-parts/btns/calculator-cta-btns'); ?>

<div id="auto-lease-results" class="calculator-results">
    <h3 id="auto-lease-results-title" class="calculator-results-title">Results</h3><!--#auto-lease-results-title-->
    <div id="auto-lease-results-header" class="calculator-results-header">
        <div class="total-item" data-email-label="Estimated Monthly Lease Payment">
            <h3 id="auto-lease-mnthly-pymnt" class="total-amnt">$0.00</h3><!--#auto-lease-new-pymnt-->
            <h4 class="total-label">Estimated Monthly Lease Payment</h4><!--.auto-lease-total-label-->
        </div>
        <hr/>
    </div><!--#auto-lease-results-header-->
    <div id="auto-lease-result-totals" class="calculator-result-totals">
        <div id="auto-lease-mnthly-depreciation" class="total-item" data-email-label="Monthly Depreciation">
            <h3 class="total-amnt">$0.00</h3><!--.total-amnt-->
            <h4 class="total-label">Monthly Depreciation</h4><!--.total-label-->
        </div><!--#auto-lease-mnthly-depreciation-->
        <div id="auto-lease-finance-fee" class="total-item" data-email-label="Monthly Lease/Finance Fee">
            <h3 class="total-amnt">$0.00</h3><!--.total-amnt-->
            <h4 class="total-label">Monthly Lease/Finance Fee</h4><!--.total-label-->
        </div><!--#auto-lease-finance-fee-->
        <div id="auto-lease-mnthly-sales-tax" class="total-item" data-email-label="Monthly Sales Tax">
            <h3 class="total-amnt">---</h3><!--.total-amnt-->
            <h4 class="total-label">Monthly Sales Tax</h4><!--.total-label-->
        </div><!--#auto-lease-mnthly-sales-tax-->
        <div id="auto-lease-total-lease-pymnt" class="total-item" data-email-label="Total Lease Payment">
            <h3 class="total-amnt">$0.00</h3><!--.total-amnt-->
            <h4 class="total-label">Total Lease Payment</h4><!--.total-label-->
        </div><!--#auto-lease-total-lease-pymnt-->
        <div id="auto-lease-purchased-instead" class="total-item" data-email-label="Purchased Instead of Lease Monthly Payment">
            <h3 class="total-amnt">$0.00</h3><!--.total-amnt-->
            <h4 class="total-label">Purchased Instead of Leased Monthly Payment</h4><!--.total-label-->
        </div><!--#auto-lease-purchased-instead-->

        <?php get_template_part('template-parts/btns/bottom-cta-btns'); ?>
    </div><!--#auto-lease-result-totals-->
</div><!--#auto-lease-results-->