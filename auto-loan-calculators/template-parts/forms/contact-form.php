<form id="contact-form">
    <h3 class="form-header"><?php the_field('form_title'); ?></h3><!--.form-header-->
    <p class="form-description"><?php the_field('form_description'); ?></p><!--.form-description-->
    <hr/>
    <label class="form-label" for="contact-name-field">
        <span class="form-copy">Your Name:</span><!--.form-copy-->
        <input id="contact-name-field" class="form-input" name="contact-name-field" type="text" placeholder="Your Name" data-email-label="Name" /><!--#name-field.form-input-->
    </label><!--.form-label--><br/>
    <label class="form-label" for="contact-email-field">
        <span class="form-copy">Your Email:</span><!--.form-copy-->
        <input id="contact-email-field" class="form-input" name="contact-email-field" type="email" placeholder="Your Email" data-email-label="Email" /><!--#email-field.form-input-->
    </label><!--.form-label--><br/>
    <label class="form-label" for="contact-msg-field">
        <span class="form-copy">Your Message:</span><!--.form-copy-->
        <textarea id="contact-msg-field" class="form-input" name="contact-msg-field" placeholder="Your Message" data-email-label="Message"></textarea>
    </label><!--.form-label-->
    <input class="form-submit" type="submit" value="Submit"><div class="break"></div>
    <img class="loading-icon" src="<?php echo get_template_directory_uri(); ?>/images/animations/loading.gif" alt="Your form submission is currently loading!"/>
    <p class="form-disclaimer"><?php the_field('form_disclaimer'); ?></p><!--.form-disclaimer-->
</form><!--#contact-form-->