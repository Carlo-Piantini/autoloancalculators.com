<div id="calculator-cta-btns">
    <?php // start a session to pass the variables from one script to another ?>
    <?php session_start(); ?>
    <?php $_SESSION['i'] = 0; ?>
    <?php $_SESSION['match_switch'] = false; ?>
    <?php if (have_rows('featured_partners_button_1', 'options')) : ?>
        <?php while (have_rows('featured_partners_button_1', 'options')) : the_row(); ?>
            <?php get_template_part('template-parts/btns/calculator-cta-btn'); ?>
        <?php endwhile; ?>
    <?php endif; ?>

    <?php // Reset the session variables and generate the second calculator cta button ?>
    <?php $_SESSION['i'] = 0; ?>
    <?php $_SESSION['match_switch'] = false; ?>
    <?php if (have_rows('featured_partners_button_2', 'options')) : ?>
        <?php while (have_rows('featured_partners_button_2', 'options')) : the_row(); ?>
            <?php get_template_part('template-parts/btns/calculator-cta-btn'); ?>
        <?php endwhile; ?>
    <?php endif; ?>
</div><!--calculator-cta-btns-->