<h1 id="main-title">Auto Loan Interest Rate</h1><!--#main-title-->
<h2 id="main-subtitle">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h2><!--#main-subtitle-->
<form id="auto-lir-calculator" class="site-form calculator-form" action="/" method="post">
    <label class="form-label" for="auto-lir-mnthly-pymnt">Monthly Payment
        <input id="auto-lir-mnthly-pymnt" class="form-input" type="number" name="auto-lir-mnthly-pymnt" placeholder="377.00" step="0.01"     /><!--#auto-lir-mnthly-pymnt-->
    </label><!--.form-label-->
    <label class="form-label" for="auto-lir-down-pymnt">Down Payment
        <input id="auto-lir-down-pymnt" class="form-input" type="number" name="auto-lir-down-pymnt" placeholder="0.00" step="0.01"     /><!--#auto-lir-down-pymnt-->
    </label><!--.form-label-->
    <label class="form-label" for="auto-lir-price">Price of Car
        <input id="auto-lir-price" class="form-input" type="number" name="auto-lir-price" placeholder="20000.00" step="0.01"   /><!--#auto-lir-price-->
    </label><!--.form-label-->
    <label class="form-label" for="auto-lir-trade-in">Trade-In Value
        <input id="auto-lir-trade-in" class="form-input" type="number" name="auto-lir-trade-in" placeholder="0.00" step="0.01"     /><!--#auto-lir-trade-in-->
    </label><!--.form-label-->
    <label class="form-label" for="auto-lir-term">Term (Yrs)
        <input id="auto-lir-term" class="form-input" type="number" name="auto-lir-term" placeholder="5" /><!--#auto-lir-term-->
    </label><!--.form-label-->
    <input id="auto-lir-submit" class="calculator-submit" type="submit" value="Calculate" />
</form><!--#auto-lir-calculator.site-form.calculator-form-->

<?php get_template_part('template-parts/calculator-cta-btns'); ?>

<div id="auto-lir-results" class="calculator-results">
    <h2 id="auto-lir-results-title">Results</h2><!--#auto-lir-results-title-->
    <div id="auto-lir-result-totals" class="calculator-result-totals">
        <div id="auto-lir-interest-rate" class="total-item">
            <h3 class="auto-lir-total-label">Interest Rate</h3><!--.auto-lir-total-label-->
            <h4 class="auto-lir-total-amnt">0.00%</h4><!--.auto-lir-total-amnt-->
        </div><!--#auto-lir-interest-rate-->
        <div id="auto-lir-total-interest" class="total-item">
            <h3 class="auto-lir-total-label">Total Interest</h3><!--.auto-lir-total-label-->
            <h4 class="auto-lir-total-amnt">$0.00</h4><!--.auto-lir-total-amnt-->
        </div><!--#auto-lir-total-interest-->
        <div id="auto-lir-total-pymnts" class="total-item">
            <h3 class="auto-lir-total-label">Total Payments</h3><!--.auto-lir-total-label-->
            <h4 class="auto-lir-total-amnt">$0.00</h4><!--.auto-lir-total-amnt-->
        </div><!--#auto-lir-total-pymnts-->
    </div><!--#auto-lir-result-totals-->
</div><!--#auto-lir-results-->