<?php 
/*
** Template Name: Front Page
*/ 
?>

<?php if (is_user_logged_in()) : ?>
    <?php get_header(); ?>
        <div id="primary" class="content-area">
            <main id="main" class="site-main">
                <?php get_template_part('calculators/auto-loan-calculator'); ?>
            </main><!-- #main -->
        </div><!-- #primary -->
    <?php
    get_sidebar();
    get_footer(); ?>
<?php else : ?>
    <?php get_header(); ?>
<?php endif; ?>