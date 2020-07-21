<div id="bottom-cta-btns">
    <a id="bottom-email-btn" class="bottom-cta-btn" href="#" data-task="email_button" data-calc-flag="invalid"><span class="btn-icon"><?php get_template_part('images/icons/inline', 'envelope.svg'); ?></span>Email</a><!--.bottom-cta-btn-->
    <a id="bottom-print-btn" class="bottom-cta-btn" href="#" data-task="print_window"><span class="btn-icon"><?php get_template_part('images/icons/inline', 'printer.svg'); ?></span>Print</a><!--.bottom-cta-btn-->

    <div class="modal-wrap">
        <div class="modal-overlay"></div><!--.modal-overlay-->
        <div id="email-results-modal" class="modal-body">
            <a class="modal-close" href="#"></a><!--.modal-close-->
            <?php get_template_part('template-parts/forms/email-results-form'); ?>
        </div><!--#email-results-modal-->
    </div><!--.modal-wrap-->
</div><!--#bottom-cta-btns-->