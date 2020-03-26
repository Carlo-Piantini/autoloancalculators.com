<?php 
/*
** Template Name: Calculator Page
*/ 
?>

<?php if (is_user_logged_in()) : ?>
    <?php get_header(); ?>
        <div id="primary" class="content-area">
            <main id="main" class="site-main">
                <?php global $post; ?>
                <?php $page_slug = $post->post_name; ?>
                <?php get_template_part('calculators/' . $page_slug); ?>
                <div id="bottom-cta-btns">
                    <a class="bottom-cta-btn" href="#">Email Me</a><!--.bottom-cta-btn-->
                    <a class="bottom-cta-btn" href="#">Amortize Table</a><!--.bottom-cta-btn-->
                </div><!--#bottom-cta-btns-->
            </main><!-- #main -->
        </div><!-- #primary -->
    <?php
    get_sidebar();
    get_footer(); ?>
<?php else : ?>
    <?php get_header(); ?>
<?php endif; ?>