<form id="email-results-form">
    <h3 class="form-header">Sending Your Results!</h3><!--.form-header-->
    <p class="form-description">Please submit your email, and we'll forward the results of your inquiry.</p><!--.form-description-->
    <hr/>
    <label class="form-label" for="email-results-field">
        <span class="form-copy">Your Email</span><!--.form-copy-->
        <input id="email-results-field" class="form-input" name="email-results-field" type="email" placeholder="Your Email" data-email-label="Email" /><!--#email-field.form-input-->
    </label><!--.form-label-->
    <input id="email-results-submit" type="submit" value="Submit"><div class="break"></div>
    <img class="loading-icon" src="<?php echo get_template_directory_uri(); ?>/images/animations/loading.gif" alt="Your form submission is currently loading!"/>
</form><!--#email-results-form-->