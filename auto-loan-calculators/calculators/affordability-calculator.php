<h1 id="main-title">Affordability Calculator</h1><!--#main-title-->
<a class="subtitle-menu-toggle inactive" href="#">More Calculators</a>
<h2 id="main-subtitle"><?php the_field('calculator_description'); ?></h2><!--#main-subtitle-->

<?php // <h3 class="calculator-error-msg"></h3><!--.calculator-error-msg--> ?>

<form id="affordability-calculator" class="site-form calculator-form" action="/" method="post">
    <label class="form-label" for="affordability-desired-pymnt">
        <span class="form-copy">Desired Monthly Payment</span>
        <span class="form-field money-field">
            <input required id="affordability-desired-pymnt" class="form-input" type="text" name="affordability-desired-pymnt" placeholder="0.00" data-email-label="Desired Monthly Payment" /><!--#affordability-desired-pymnt-->
        </span><!--.form-field-->
    </label><!--.form-label-->
    <label class="form-label" for="affordability-down-pymnt">
        <span class="form-copy">Down Payment</span>
        <span class="form-field money-field">
            <input id="affordability-down-pymnt" class="form-input" type="text" name="affordability-down-pymnt" placeholder="0.00" value="0.00" data-email-label="Down Payment" /><!--#affordability-down-pymnt-->
        </span><!--.form-field-->
    </label><!--.form-label-->
    <label class="form-label" for="affordability-trade-in">
        <span class="form-copy">Value of Trade-In</span>
        <span class="form-field money-field">
            <input id="affordability-trade-in" class="form-input" type="text" name="affordability-trade-in" placeholder="0.00" value="0.00" data-email-label="Value of Trade-In" /><!--#affordability-trade-in-->
        </span>
    </label><!--.form-label-->
    <label class="form-label" for="affordability-amnt-owed">
        <span class="form-copy">Amount Owed on Trade-In</span>
        <span class="form-field money-field">
            <input id="affordability-amnt-owed" class="form-input" type="text" name="affordability-amnt-owed" placeholder="0.00" value="0.00" data-email-label="Amount Owed on Trade-In" /><!--#affordability-price-->
        </span>
    </label><!--.form-amnt-owed-->
    <label class="form-label" for="affordability-term">
        <span class="form-copy">Term</span>
        <span class="form-field year-field">
            <input required id="affordability-term" class="form-input" type="number" name="affordability-term" placeholder="0" data-email-label="Term" /><!--#affordability-term-->
        </span>
    </label><!--.form-label-->
    <label class="form-label" for="affordability-interest-rate">
        <span class="form-copy">Interest Rate</span>
        <span class="form-field percent-field">
            <input required id="affordability-interest-rate" class="form-input" type="number" name="affordability-interest-rate" placeholder="0.0" step="0.1" data-email-label="Interest Rate" /><!--#affordability-interest-rate-->
        </span>
    </label><!--.form-label-->
    <input id="affordability-submit" class="calculator-submit" type="submit" value="Calculate" />
</form><!--#affordability-calculator-->

<?php get_template_part('template-parts/btns/calculator-cta-btns'); ?>

<div id="affordability-results" class="calculator-results">
    <h3 id="affordability-results-title" class="calculator-results-title">Results</h3><!--#affordability-results-title-->
    <div id="affordability-results-header" class="calculator-results-header">
        <div class="total-item" data-email-label="Price of Car">
            <h3 id="affordability-price" class="total-amnt">$0.00</h3><!--#affordability-price-->
            <h4 class="total-label">Price of Car</h4><!--.affordability-total-label-->
        </div>
        <hr/>
    </div><!--#affordability-results-header-->
    <div id="affordability-result-totals" class="calculator-result-totals">
        <div id="affordability-total-loan" class="total-item" data-email-label="Total Loan Amount">
            <h3 class="total-amnt">$0.00</h3><!--.total-amnt-->
            <h4 class="total-label">Total Loan Amount</h4><!--.total-label-->
        </div><!--#affordability-total-loan-->
        <div id="affordability-total-interest" class="total-item" data-email-label="Total Interest Paid">
            <h3 class="total-amnt">$0.00</h3><!--.total-amnt-->
            <h4 class="total-label">Total Interest Paid</h4><!--.total-label-->
        </div><!--#affordability-total-interest-->
        <div id="affordability-total-pymnts" class="total-item" data-email-label="Total Payments">
            <h3 class="total-amnt">$0.00</h3><!--.total-amnt-->
            <h4 class="total-label">Total Payments</h4><!--.total-label-->
        </div><!--#affordability-total-pymnts-->

        <?php get_template_part('template-parts/btns/bottom-cta-btns'); ?>
    </div><!--#affordability-result-totals-->
</div><!--#affordability-results-->