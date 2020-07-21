<?php 
/*
** Template Name: Calculator Page
*/ 
?>

<?php get_header(); ?>
    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <?php // setup the global post variable ?>
            <?php global $post; ?>
            <?php // pull out the page slug of the calculator content type using the post's name ?>
            <?php $page_slug = $post->post_name; ?>
            <?php // use the slug to grab the correct content type for the respective calculator ?>
            <?php get_template_part('calculators/' . $page_slug); ?>
        </main><!-- #main -->
    </div><!-- #primary -->
<?php
get_sidebar();
get_footer(); ?>