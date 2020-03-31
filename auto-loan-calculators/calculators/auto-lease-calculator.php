<h1 id="main-title">Auto Lease Calculator</h1><!--#main-title-->
<h2 id="main-subtitle">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h2><!--#main-subtitle-->
<form id="auto-lease-calculator" class="site-form calculator-form" action="/" method="post">
    <label class="form-label" for="auto-lease-vehicle-price">Vehicle Price
        <input id="auto-lease-vehicle-price" class="form-input" type="number" name="auto-lease-vehicle-price" placeholder="33000.00" step="0.01" /><!--#auto-lease-vehicle-price-->
    </label><!--.form-label-->
    <label class="form-label" for="auto-lease-rebates-incentives">Rebates and Incentives
        <input id="auto-lease-rebates-incentives" class="form-input" type="number" name="auto-lease-rebates-incentives" placeholder="0.00" step="0.01" /><!--#auto-lease-rebates-incentives-->
    </label><!--.form-label-->
    <label class="form-label" for="auto-lease-down-pymnt">Down Payment
        <input id="auto-lease-down-pymnt" class="form-input" type="number" name="auto-lease-down-pymnt" placeholder="3000.00" step="0.01" /><!--#auto-lease-down-pymnt-->
    </label><!--.form-label-->
    <label class="form-label" for="auto-lease-interest-rate">Interest Rate (%)
        <input id="auto-lease-interest-rate" class="form-input" type="number" name="auto-lease-interest-rate" placeholder="2.40" step="0.01" /><!--#auto-lease-interest-rate-->
    </label><!--.form-label-->
    <label class="form-label" for="auto-lease-lease-term">Lease Term
        <input id="auto-lease-term" class="form-input" type="number" name="auto-lease-lease-term" placeholder="3" /><!--#auto-lease-term-->
    </label><!--.form-label-->
    <label class="form-label" for="auto-lease-trade-value">Trade-In Value
        <input id="auto-lease-trade-value" class="form-input" type="number" name="auto-lease-trade-value" placeholder="0.00" step="0.01" /><!--#auto-lease-trade-value-->
    </label><!--.form-label-->
    <label class="form-label" for="auto-lease-amnt-owed">Amount Owed on Trade-In
        <input id="auto-lease-amnt-owed" class="form-input" type="number" name="auto-lease-amnt-owed" placeholder="0.00" step="0.01" /><!--#auto-lease-amnt-owed-->
    </label><!--.form-label-->
    <label class="form-label" for="auto-lease-residual-value">Residual Value
        <input id="auto-lease-residual-value" class="form-input" type="number" name="auto-lease-residual-value" placeholder="21000.00" step="0.01" /><!--#auto-lease-residual-value-->
    </label><!--.form-label-->
    <label class="form-label" for="auto-lease-sales-tax">Sales Tax Rate (%)
        <input id="auto-lease-sales-tax" class="form-input" type="number" name="auto-lease-sales-tax" placeholder="0.00" step="0.01" /><!--#auto-lease-sales-tax-->
    </label><!--.form-label-->
    <input id="auto-lease-submit" class="calculator-submit" type="submit" value="Calculate" />
</form><!--#auto-lease-calculator.site-form.calculator-form-->

<?php get_template_part('template-parts/calculator-cta-btns'); ?>

<div id="auto-lease-results" class="calculator-results">
    <h2 id="auto-lease-results-title">Results</h2><!--#auto-lease-results-title-->
    <div id="auto-lease-results-header">
        <h3 class="auto-lease-total-label">Estimated Monthly Loan Payment</h3><!--.auto-lease-total-label-->
        <h4 id="auto-lease-mnthly-pymnt">$0.00</h4><!--#auto-lease-new-pymnt-->
    </div><!--#auto-lease-results-header-->
    <div id="auto-lease-result-totals" class="calculator-result-totals">
        <div id="auto-lease-mnthly-depreciation" class="total-item">
            <h3 class="auto-lease-total-label">Monthly Depreciation</h3><!--.auto-lease-total-label-->
            <h4 class="auto-lease-total-amnt">$0.00</h4><!--.auto-lease-total-amnt-->
        </div><!--#auto-lease-mnthly-depreciation-->
        <div id="auto-lease-finance-fee" class="total-item">
            <h3 class="auto-lease-total-label">Monthly Lease/Finance Fee</h3><!--.auto-lease-total-label-->
            <h4 class="auto-lease-total-amnt">$0.00</h4><!--.auto-lease-total-amnt-->
        </div><!--#auto-lease-finance-fee-->
        <div id="auto-lease-mnthly-sales-tax" class="total-item">
            <h3 class="auto-lease-total-label">Monthly Sales Tax</h3><!--.auto-lease-total-label-->
            <h4 class="auto-lease-total-amnt">---</h4><!--.auto-lease-total-amnt-->
        </div><!--#auto-lease-mnthly-sales-tax-->
        <div id="auto-lease-total-lease-pymnt" class="total-item">
            <h3 class="auto-lease-total-label">Total Lease Payment</h3><!--.auto-lease-total-label-->
            <h4 class="auto-lease-total-amnt">$0.00</h4><!--.auto-lease-total-amnt-->
        </div><!--#auto-lease-total-lease-pymnt-->
        <div id="auto-lease-purchased-instead" class="total-item">
            <h3 class="auto-lease-total-label">Purchased Instead of Leased Monthly Payment</h3><!--.auto-lease-total-label-->
            <h4 class="auto-lease-total-amnt">$0.00</h4><!--.auto-lease-total-amnt-->
        </div><!--#auto-lease-purchased-instead-->
    </div><!--#auto-lease-result-totals-->
</div><!--#auto-lease-results-->