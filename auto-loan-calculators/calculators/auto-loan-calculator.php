<h1 id="main-title">Auto Loan Calculator</h1><!--#main-title-->
<a class="subtitle-menu-toggle inactive" href="#">More Calculators</a>
<h2 id="main-subtitle"><?php the_field('calculator_description'); ?></h2><!--#main-subtitle-->

<?php // <h3 class="calculator-error-msg"></h3><!--.calculator-error-msg--> ?>

<form id="alc-calculator" class="site-form calculator-form" action="/" method="post">
    <label class="form-label" for="alc-price">
        <span class="form-copy">Price</span><!--.form-copy-->
        <span class="form-field money-field">
            <input required id="alc-price" class="form-input" type="text" name="alc-price" placeholder="0.00" data-email-label="Price" /><!--#alc-price-->
        </span><!--.form-field-->
    </label><!--.form-label-->
    <label class="form-label" for="alc-down-pymnt">
        <span class="form-copy">Down Payment</span><!--.form-copy-->
        <span class="form-field money-field">
            <input id="alc-down-pymnt" class="form-input" type="text" name="alc-down-pymnt" placeholder="0.00" value="0.00" data-email-label="Down Payment" /><!--#alc-down-pymnt-->
        </span><!--.form-field-->
    </label><!--.form-label-->
    <label class="form-label" for="alc-rate">
        <span class="form-copy">Rate</span><!--.form-copy-->
        <span class="form-field percent-field">
            <input required id="alc-rate" class="form-input" type="number" name="alc-rate" placeholder="0.0" step="0.1" data-email-label="Rate" /><!--#alc-rate-->
        </span><!--.form-field-->
    </label><!--.form-label-->
    <label class="form-label" for="alc-term">
        <span class="form-copy">Term</span><!--.form-copy-->
        <span class="form-field year-field">
            <input required id="alc-term" class="form-input" type="number" name="alc-term" placeholder="0" data-email-label="Term" /><!--#alc-term-->
        </span><!--.form-field-->
    </label><!--.form-label-->
    <label class="form-label" for="alc-rebate">
        <span class="form-copy">Rebate</span><!--.form-copy-->
        <span class="form-field money-field">
            <input id="alc-rebate" class="form-input" type="text" name="alc-rebate" placeholder="0.00" value="0.00" data-email-label="Rebate" /><!--#alc-rebate-->
        </span><!--.form-field-->
    </label><!--.form-label-->
    <label class="form-label" for="alc-trade-in">
        <span class="form-copy">Value of Trade-In</span><!--.form-copy-->
        <span class="form-field money-field">
            <input id="alc-trade-in" class="form-input" type="text" name="alc-trade-in" placeholder="0.00" value="0.00" data-email-label="Value of Trade-In" /><!--#alc-trade-in-->
        </span><!--.form-field-->
    </label><!--.form-label-->
    <label class="form-label" for="alc-amnt-owed">
        <span class="form-copy">Amount Owed on Trade-In</span><!--.form-copy-->
        <span class="form-field money-field">
            <input id="alc-amnt-owed" class="form-input" type="text" name="alc-amnt-owed" placeholder="0.00" value="0.00" data-email-label="Amount Owed on Trade-In" /><!--#alc-price-->
        </span><!--.form-field-->
    </label><!--.form-amnt-owed-->
    <label class="form-label" for="alc-sales-tax">
        <span class="form-copy">Sales Tax Rate</span><!--.form-copy-->
        <span class="form-field percent-field">
            <input id="alc-sales-tax" class="form-input" type="number" name="alc-sales-tax" placeholder="0.0" value="0.0" step="0.1" data-email-label="Sales Tax Rate" /><!--#alc-sales-tax-->
        </span><!--.form-field-->
    </label><!--.form-label-->
    <input id="alc-submit" class="calculator-submit" type="submit" value="Calculate" />
</form><!--#alc-calculator-->

<?php get_template_part('template-parts/btns/calculator-cta-btns'); ?>

<div id="alc-results" class="calculator-results">
    <h3 id="alc-results-title" class="calculator-results-title">Results</h3><!--#alc-results-title-->
    <div id="alc-results-header" class="calculator-results-header">
        <div class="total-item" data-email-label="Estimated Monthly Car Payment">
            <h3 id="alc-mnthly-pymnt" class="total-amnt">$0.00</h3><!--#alc-mnthly-pymnt-->
            <h4 class="total-label">Estimated Monthly Car Payment</h4><!--.total-label-->
        </div>
        <div class="total-item" data-email-label="Date of Payoff">
            <h3 id="alc-payoff-date" class="total-amnt">---</h3><!-- #alc-payoff-date.total-amnt -->
            <h4 class="total-label">Date of Payoff</h4><!-- .total-label -->
        </div>
        <hr/>
    </div><!--#alc-results-header-->
    <div id="alc-result-totals" class="calculator-result-totals">
        <div id="alc-total-loan" class="total-item" data-email-label="Total Loan Amount">
            <h3 class="total-amnt">$0.00</h3><!--.total-amnt-->
            <h4 class="total-label">Total Loan Amount</h4><!--.total-label-->
        </div><!--#alc-total-loan-->
        <div id="alc-total-interest" class="total-item" data-email-label="Total Interest Paid">
            <h3 class="total-amnt">$0.00</h3><!--.total-amnt-->
            <h4 class="total-label">Total Interest Paid</h4><!--.total-label-->
        </div><!--#alc-total-interest-->
        <div id="alc-total-pymnts" class="total-item" data-email-label="Total Payments">
            <h3 class="total-amnt">$0.00</h3><!--.total-amnt-->
            <h4 class="total-label">Total Payments</h4><!--.total-label-->
        </div><!--#alc-total-pymnts-->

        <?php get_template_part('template-parts/btns/bottom-cta-btns'); ?>
    </div><!--#alc-result-totals-->
</div><!--#alc-results-->