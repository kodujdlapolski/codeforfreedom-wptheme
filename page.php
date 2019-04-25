<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Code_for_Freedom
 * @since Code for Freedom 1.0
 */

get_header();

// Include the featured content template.
get_template_part('front-banner');
?>
    <div id="main" class="container"><!-- #main container -->
        <div class="main-content col-xs-12 col-sm-8">
            <div class="single-post row">

                <?php
                // Start the Loop.
                while (have_posts()) : the_post();

                    // Include the page content template.
                    get_template_part('content', 'page');

                endwhile;
                ?>

            </div>
        </div>
        <div class="main-sidebar col-xs-12 col-sm-3 col-sm-offset-1">
            <?php get_sidebar('front'); ?>
        </div>
    </div>
<?php

get_footer();