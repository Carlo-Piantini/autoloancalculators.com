<h1 id="main-title">Interest Rate Calculator</h1><!--#main-title-->
<a class="subtitle-menu-toggle inactive" href="#">More Calculators</a>
<h2 id="main-subtitle"><?php the_field('calculator_description'); ?></h2><!--#main-subtitle-->

<?php // <h3 class="calculator-error-msg"></h3><!--.calculator-error-msg--> ?>

<form id="auto-lir-calculator" class="site-form calculator-form" action="/" method="post">
    <label class="form-label" for="auto-lir-mnthly-pymnt">
        <span class="form-copy">Monthly Payment</span>
        <span class="form-field money-field">
            <input id="auto-lir-mnthly-pymnt" class="form-input" type="text" name="auto-lir-mnthly-pymnt" placeholder="0.00" data-email-label="Monthly Payment" /><!--#auto-lir-mnthly-pymnt-->
        </span>
    </label><!--.form-label-->
    <label class="form-label" for="auto-lir-down-pymnt">
        <span class="form-copy">Down Payment</span>
        <span class="form-field money-field">
            <input id="auto-lir-down-pymnt" class="form-input" type="text" name="auto-lir-down-pymnt" placeholder="0.00" value="0.00" data-email-label="Down Payment" /><!--#auto-lir-down-pymnt-->
        </span>
    </label><!--.form-label-->
    <label class="form-label" for="auto-lir-price">
        <span class="form-copy">Price of Car</span>
        <span class="form-field money-field">
            <input id="auto-lir-price" class="form-input" type="text" name="auto-lir-price" placeholder="0.00" data-email-label="Price of Car" /><!--#auto-lir-price-->
        </span>
    </label><!--.form-label-->
    <label class="form-label" for="auto-lir-trade-in">
        <span class="form-copy">Trade-In Value</span>
        <span class="form-field money-field">
            <input id="auto-lir-trade-in" class="form-input" type="text" name="auto-lir-trade-in" placeholder="0.00" value="0.00" data-email-label="Trade-In Value" /><!--#auto-lir-trade-in-->
        </span>
    </label><!--.form-label-->
    <label class="form-label" for="auto-lir-term">
        <span class="form-copy">Term</span>
        <span class="form-field year-field">
            <input id="auto-lir-term" class="form-input" type="number" name="auto-lir-term" placeholder="0" data-email-label="Term" /><!--#auto-lir-term-->
        </span>
    </label><!--.form-label-->
    <div class="break"></div><!--.break-->
    <input id="auto-lir-submit" class="calculator-submit" type="submit" value="Calculate" />
</form><!--#auto-lir-calculator.site-form.calculator-form-->

<?php get_template_part('template-parts/btns/calculator-cta-btns'); ?>

<div id="auto-lir-results" class="calculator-results">
    <h3 id="auto-lir-results-title" class="calculator-results-title">Results</h3><!--#auto-lir-results-title-->
    <div id="auto-lir-result-totals" class="calculator-result-totals">
        <div id="auto-lir-interest-rate" class="total-item" data-email-label="Interest Rate">
            <h3 class="total-amnt">0.00%</h3><!--.total-amnt-->
            <h4 class="total-label">Interest Rate</h4><!--.total-label-->
        </div><!--#auto-lir-interest-rate-->
        <div id="auto-lir-total-interest" class="total-item" data-email-label="Total Interest">
            <h3 class="total-amnt">$0.00</h3><!--.total-amnt-->
            <h4 class="total-label">Total Interest</h4><!--.total-label-->
        </div><!--#auto-lir-total-interest-->
        <div id="auto-lir-total-pymnts" class="total-item" data-email-label="Total Payments">
            <h3 class="total-amnt">$0.00</h3><!--.total-amnt-->
            <h4 class="total-label">Total Payments</h4><!--.total-label-->
        </div><!--#auto-lir-total-pymnts-->

        <?php get_template_part('template-parts/btns/bottom-cta-btns'); ?>
    </div><!--#auto-lir-result-totals-->
</div><!--#auto-lir-results-->