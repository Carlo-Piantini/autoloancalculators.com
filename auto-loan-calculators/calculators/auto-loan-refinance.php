<h1 id="main-title">Auto Loan Refinance</h1><!--#main-title-->
<h2 id="main-subtitle">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h2><!--#main-subtitle-->
<form id="refinance-calculator" class="site-form calculator-form" action="/" method="post">
    <label class="form-label" for="refinance-mnthly-pymnt">Current Monthly Payment
        <input id="refinance-mnthly-pymnt" class="form-input" type="number" name="refinance-mnthly-pymnt" placeholder="377.00" step="0.01"     /><!--#refinance-mnthly-pymnt-->
    </label><!--.form-label-->
    <label class="form-label" for="refinance-loan-balance">Current Loan Balance
        <input id="refinance-loan-balance" class="form-input" type="number" name="refinance-loan-balance" placeholder="20000.00" step="0.01"     /><!--#refinance-loan-balance-->
    </label><!--.form-label-->
    <label class="form-label" for="refinance-interest-rate">Current Interest Rate
        <input id="refinance-interest-rate" class="form-input" type="number" name="refinance-interest-rate" placeholder="5.00" step="0.01"   /><!--#refinance-interest-rate-->
    </label><!--.form-label-->
    <label class="form-label" for="refinance-new-rate">New Loan Interest Rate
        <input id="refinance-new-rate" class="form-input" type="number" name="refinance-new-rate" placeholder="3.00" step="0.01"     /><!--#refinance-new-rate-->
    </label><!--.form-label-->
    <label class="form-label" for="refinance-new-term">New Loan Term (Yrs)
        <input id="refinance-new-term" class="form-input" type="number" name="refinance-new-term" placeholder="4" /><!--#refinance-new-term-->
    </label><!--.form-label-->
    <input id="refinance-submit" class="calculator-submit" type="submit" value="Calculate" />
</form><!--#refinance-calculator.site-form.calculator-form-->

<?php get_template_part('template-parts/calculator-cta-btns'); ?>

<div id="refinance-results" class="calculator-results">
    <h2 id="refinance-results-title">Results</h2><!--#refinance-results-title-->
    <div id="refinance-results-header">
        <h3 class="refinance-total-label">New Loan Payment</h3><!--.refinance-total-label-->
        <h4 id="refinance-new-pymnt">$0.00</h4><!--#refinance-new-pymnt-->
    </div><!--#refinance-results-header-->
    <div id="refinance-result-totals" class="calculator-result-totals">
        <div id="refinance-mnthly-savings" class="total-item">
            <h3 class="refinance-total-label">Monthly Payment Savings</h3><!--.refinance-total-label-->
            <h4 class="refinance-total-amnt">$0.00</h4><!--.refinance-total-amnt-->
        </div><!--#refinance-mnthly-savings-->
        <div id="refinance-difference-in-interest" class="total-item">
            <h3 class="refinance-total-label">Difference in Interest</h3><!--.refinance-total-label-->
            <h4 class="refinance-total-amnt">$0.00</h4><!--.refinance-total-amnt-->
        </div><!--#refinance-difference-in-interest-->
        <div id="refinance-new-total" class="total-item">
            <h3 class="refinance-total-label">New Loan Total Payments</h3><!--.refinance-total-label-->
            <h4 class="refinance-total-amnt">$0.00</h4><!--.refinance-total-amnt-->
        </div><!--#refinance-new-total-->
        <div id="refinance-payoff-date" class="total-item">
            <h3 class="refinance-total-label">Payoff Date New Loan</h3><!--.refinance-total-label-->
            <h4 class="refinance-total-amnt">---</h4><!--.refinance-total-amnt-->
        </div><!--#refinance-payoff-date-->
    </div><!--#refinance-result-totals-->
</div><!--#refinance-results-->