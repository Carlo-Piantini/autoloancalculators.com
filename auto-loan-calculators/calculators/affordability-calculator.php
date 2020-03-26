<h1 id="main-title">Affordability Calculator</h1><!--#main-title-->
<h2 id="main-subtitle">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h2><!--#main-subtitle-->
<form id="affordability-calculator" class="site-form calculator-form" action="/" method="post">
    <label class="form-label" for="affordability-desired-pymnt">Desired Monthly Payment
        <input id="affordability-desired-pymnt" class="form-input" type="number" name="affordability-desired-pymnt" placeholder="377.42" step="0.01" /><!--#affordability-desired-pymnt-->
    </label><!--.form-label-->
    <label class="form-label" for="affordability-down-pymnt">Down Payment
        <input id="affordability-down-pymnt" class="form-input" type="number" name="affordability-down-pymnt" placeholder="0.00" step="0.01" /><!--#affordability-down-pymnt-->
    </label><!--.form-label-->
    <label class="form-label" for="affordability-trade-in">Value of Trade-In
        <input id="affordability-trade-in" class="form-input" type="number" name="affordability-trade-in" placeholder="6500.00" step="0.01" /><!--#affordability-trade-in-->
    </label><!--.form-label-->
    <label class="form-label" for="affordability-amnt-owed">Amount Owed on Trade-In
        <input id="affordability-amnt-owed" class="form-input" type="number" name="affordability-amnt-owed" placeholder="3000.00" step="0.01" /><!--#affordability-price-->
    </label><!--.form-amnt-owed-->
    <label class="form-label" for="affordability-term">Term (Yrs)
        <input id="affordability-term" class="form-input" type="number" name="affordability-term" placeholder="5" /><!--#affordability-term-->
    </label><!--.form-label-->
    <label class="form-label" for="affordability-interest-rate">Interest Rate (%)
        <input id="affordability-interest-rate" class="form-input" type="number" name="affordability-interest-rate" placeholder="5" step="0.01" /><!--#affordability-interest-rate-->
    </label><!--.form-label-->
    <input id="affordability-submit" class="calculator-submit" type="submit" value="Calculate" />
</form><!--#affordability-calculator-->

<?php get_template_part('template-parts/calculator-cta-btns'); ?>

<div id="affordability-results" class="calculator-results">
    <h2 id="affordability-results-title">Results</h2><!--#affordability-results-title-->
    <div id="affordability-results-header">
        <h3 class="affordability-total-label">Price of Car</h3><!--.affordability-total-label-->
        <h4 id="affordability-price">$0.00</h4><!--#affordability-price-->
    </div><!--#affordability-results-header-->
    <div id="affordability-result-totals" class="calculator-result-totals">
        <div id="affordability-total-loan" class="total-item">
            <h3 class="affordability-total-label">Total Loan Amount</h3><!--.affordability-total-label-->
            <h4 class="affordability-total-amnt">$0.00</h4><!--.affordability-total-amnt-->
        </div><!--#affordability-total-loan-->
        <div id="affordability-total-interest" class="total-item">
            <h3 class="affordability-total-label">Total Interest Paid</h3><!--.affordability-total-label-->
            <h4 class="affordability-total-amnt">$0.00</h4><!--.affordability-total-amnt-->
        </div><!--#affordability-total-interest-->
        <div id="affordability-total-pymnts" class="total-item">
            <h3 class="affordability-total-label">Total Payments</h3><!--.affordability-total-label-->
            <h4 class="affordability-total-amnt">$0.00</h4><!--.affordability-total-amnt-->
        </div><!--#affordability-total-pymnts-->
    </div><!--#affordability-result-totals-->
</div><!--#affordability-results-->