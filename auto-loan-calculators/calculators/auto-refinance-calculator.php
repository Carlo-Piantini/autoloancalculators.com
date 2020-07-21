<h1 id="main-title">Auto Refinance Calculator</h1><!--#main-title-->
<a class="subtitle-menu-toggle inactive" href="#">More Calculators</a>
<h2 id="main-subtitle"><?php the_field('calculator_description'); ?></h2><!--#main-subtitle-->

<?php // <h3 class="calculator-error-msg"></h3><!--.calculator-error-msg--> ?>

<form id="refinance-calculator" class="site-form calculator-form" action="/" method="post">
    <label class="form-label" for="refinance-mnthly-pymnt">
        <span class="form-copy">Current Monthly Payment</span>
        <span class="form-field money-field">
            <input id="refinance-mnthly-pymnt" class="form-input" type="text" name="refinance-mnthly-pymnt" placeholder="0.00" data-email-label="Current Monthly Payment" /><!--#refinance-mnthly-pymnt-->
        </span>
    </label><!--.form-label-->
    <label class="form-label" for="refinance-loan-balance">
        <span class="form-copy">Current Loan Balance</span>
        <span class="form-field money-field">
            <input id="refinance-loan-balance" class="form-input" type="text" name="refinance-loan-balance" placeholder="0.00" data-email-label="Current Loan Balance" /><!--#refinance-loan-balance-->
        </span>
    </label><!--.form-label-->
    <label class="form-label" for="refinance-interest-rate">
        <span class="form-copy">Current Interest Rate</span>
        <span class="form-field percent-field">
            <input id="refinance-interest-rate" class="form-input" type="number" name="refinance-interest-rate" placeholder="0.0" step="0.1" data-email-label="Current Interest Rate" /><!--#refinance-interest-rate-->
        </span>
    </label><!--.form-label-->
    <label class="form-label" for="refinance-new-rate">
        <span class="form-copy">New Loan Interest Rate</span>
        <span class="form-field percent-field">
            <input id="refinance-new-rate" class="form-input" type="number" name="refinance-new-rate" placeholder="0.0" step="0.1" data-email-label="New Loan Interest Rate" /><!--#refinance-new-rate-->
        </span>
    </label><!--.form-label-->
    <label class="form-label" for="refinance-new-term">
        <span class="form-copy">New Loan Term</span>
        <span class="form-field year-field">
            <input id="refinance-new-term" class="form-input" type="number" name="refinance-new-term" placeholder="0" data-email-label="New Loan Term" /><!--#refinance-new-term-->
        </span>
    </label><!--.form-label-->
    <div class="break"></div><!--.break-->
    <input id="refinance-submit" class="calculator-submit" type="submit" value="Calculate" />
</form><!--#refinance-calculator.site-form.calculator-form-->

<?php get_template_part('template-parts/btns/calculator-cta-btns'); ?>

<div id="refinance-results" class="calculator-results">
    <h3 id="refinance-results-title" class="calculator-results-title">Results</h3><!--#refinance-results-title-->
    <div id="refinance-results-header" class="calculator-results-header">
        <div class="total-item" data-email-label="New Loan Payment">
            <h3 id="refinance-new-pymnt" class="total-amnt">$0.00</h3><!--#refinance-new-pymnt-->
            <h4 class="total-label">New Loan Payment</h4><!--.refinance-total-label-->
        </div>
        <hr/>
    </div><!--#refinance-results-header-->
    <div id="refinance-result-totals" class="calculator-result-totals">
        <div id="refinance-mnthly-savings" class="total-item" data-email-label="Monthly Payment Savings">
            <h3 class="total-amnt">$0.00</h3><!--.total-amnt-->
            <h4 class="total-label">Monthly Payment Savings</h4><!--.total-label-->
        </div><!--#refinance-mnthly-savings-->
        <div id="refinance-difference-in-interest" class="total-item" data-email-label="Difference in Interest">
            <h3 class="total-amnt">$0.00</h3><!--.total-amnt-->
            <h4 class="total-label">Difference in Interest</h4><!--.total-label-->
        </div><!--#refinance-difference-in-interest-->
        <div id="refinance-new-total" class="total-item" data-email-label="New Loan Total Payments">
            <h3 class="total-amnt">$0.00</h3><!--.-amnt-->
            <h4 class="total-label">New Loan Total Payments</h4><!--.-label-->
        </div><!--#refinance-new-total-->
        <div id="refinance-payoff-date" class="total-item" data-email-label="Payoff Date New Loan">
            <h3 class="total-amnt">---</h3><!--.total-amnt-->
            <h4 class="total-label">Payoff Date New Loan</h4><!--.total-label-->
        </div><!--#refinance-payoff-date-->

        <?php get_template_part('template-parts/btns/bottom-cta-btns'); ?>
    </div><!--#refinance-result-totals-->
</div><!--#refinance-results-->