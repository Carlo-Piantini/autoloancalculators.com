<h1 id="main-title">Auto Loan Calculator</h1><!--#main-title-->
<h2 id="main-subtitle">Estimate your car payment by using our calculator below.</h2><!--#main-subtitle-->
<form id="alc-calculator" class="site-form calculator-form" action="/" method="post">
    <label class="form-label" for="alc-price">Price
        <input id="alc-price" class="form-input" type="number" name="alc-price" placeholder="35000.00" step="0.01" /><!--#alc-price-->
    </label><!--.form-label-->
    <label class="form-label" for="alc-down-pymnt">Down Payment
        <input id="alc-down-pymnt" class="form-input" type="number" name="alc-down-pymnt" placeholder="7500.00" step="0.01" /><!--#alc-down-pymnt-->
    </label><!--.form-label-->
    <label class="form-label" for="alc-rate">Rate
        <input id="alc-rate" class="form-input" type="number" name="alc-rate" placeholder="5.0" step="0.01" /><!--#alc-rate-->
    </label><!--.form-label-->
    <label class="form-label" for="alc-term">Term (Yrs)
        <input id="alc-term" class="form-input" type="number" name="alc-term" placeholder="4" step="0.01" /><!--#alc-term-->
    </label><!--.form-label-->
    <label class="form-label" for="alc-rebate">Rebate
        <input id="alc-rebate" class="form-input" type="number" name="alc-rebate" placeholder="650.00" step="0.01" /><!--#alc-rebate-->
    </label><!--.form-label-->
    <label class="form-label" for="alc-trade-in">Value of Trade-In
        <input id="alc-trade-in" class="form-input" type="number" name="alc-trade-in" placeholder="6500.00" step="0.01" /><!--#alc-trade-in-->
    </label><!--.form-label-->
    <label class="form-label" for="alc-amnt-owed">Amount Owed on Trade-In
        <input id="alc-amnt-owed" class="form-input" type="number" name="alc-amnt-owed" placeholder="3000.00" step="0.01" /><!--#alc-price-->
    </label><!--.form-amnt-owed-->
    <label class="form-label" for="alc-sales-tax">Sales Tax Rate (%)
        <input id="alc-sales-tax" class="form-input" type="number" name="alc-sales-tax" placeholder="3.5" step="0.01" /><!--#alc-sales-tax-->
    </label><!--.form-label-->
    <input id="alc-submit" class="calculator-submit" type="submit" value="Calculate" />
</form><!--#alc-calculator-->

<?php get_template_part('template-parts/calculator-cta-btns'); ?>

<div id="alc-results" class="calculator-results">
    <h2 id="alc-results-title">Results</h2><!--#alc-results-title-->
    <div id="alc-results-header">
        <h3 class="alc-total-label">Estimated Monthly Car Payment</h3><!--.alc-total-label-->
        <h4 id="alc-mnthly-pymnt">$0.00</h4><!--#alc-mnthly-pymnt-->
        <h3 class="alc-total-label">Date of Payoff</h3><!-- .alc-total-label -->
        <h4 id="alc-payoff-date" class="alc-total-amnt">---</h4><!-- #alc-payoff-date.alc-total-amnt -->
    </div><!--#alc-results-header-->
    <div id="alc-result-totals" class="calculator-result-totals">
        <div id="alc-total-loan" class="total-item">
            <h3 class="alc-total-label">Total Loan Amount</h3><!--.alc-total-label-->
            <h4 class="alc-total-amnt">$0.00</h4><!--.alc-total-amnt-->
        </div><!--#alc-total-loan-->
        <div id="alc-total-interest" class="total-item">
            <h3 class="alc-total-label">Total Interest Paid</h3><!--.alc-total-label-->
            <h4 class="alc-total-amnt">$0.00</h4><!--.alc-total-amnt-->
        </div><!--#alc-total-interest-->
        <div id="alc-total-pymnts" class="total-item">
            <h3 class="alc-total-label">Total Payments</h3><!--.alc-total-label-->
            <h4 class="alc-total-amnt">$0.00</h4><!--.alc-total-amnt-->
        </div><!--#alc-total-pymnts-->
    </div><!--#alc-result-totals-->
</div><!--#alc-results-->