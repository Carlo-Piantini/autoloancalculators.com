<form id="featured-partner-form" data-partner-email="" data-account-number="">
    <img class="form-logo"/><!--.form-logo-->
    <h3 class="form-header"></h3><!--.form-header-->
    <p class="form-instructions"></p><!--.form-instructions-->
    <label class="form-label" for="featured-name-field">
        <span class="form-copy">Name</span>
        <input id="featured-name-field" class="form-input" name="featured-name-field" type="text" placeholder="Name" data-email-label="Name" /><!--#name-field.form-input-->
    </label><!--.form-label-->
    <label class="form-label" for="featured-email-field">
        <span class="form-copy">Email</span>
        <input id="featured-email-field" class="form-input" name="featured-email-field" type="email" placeholder="Email" data-email-label="Email" /><!--#email-field.form-input-->
    </label><!--.form-label-->
    <label class="form-label" for="featured-phone-field">
        <span class="form-copy">Phone</span>
        <input id="featured-phone-field" class="form-input" name="featured-phone-field" type="text" placeholder="Phone" data-email-label="Phone" /><!--#name-field.form-input-->
    </label><!--.form-label-->
    <label class="form-label" for="featured-msg-field">
        <span class="form-copy">Message</span>
        <textarea id="featured-msg-field" class="form-input" name="featured-msg-field" placeholder="Message" data-email-label="Message"></textarea>
    </label><!--.form-label-->
    <p class="form-disclaimer"></p><!--.form-disclaimer-->
    <input class="form-submit" type="submit" value="Submit"><div class="break"></div>
    <img class="loading-icon" src="<?php echo get_template_directory_uri(); ?>/images/animations/loading.gif" alt="Your form submission is currently loading!"/>
</form><!--#featured-partner-form-->