<?php 
/*
** Template Name: Front Page
*/ 
?>

<?php get_header(); ?>
    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <?php get_template_part('calculators/auto-loan-calculator'); ?>
        </main><!-- #main -->
    </div><!-- #primary -->
<?php
get_sidebar();
get_footer(); ?>