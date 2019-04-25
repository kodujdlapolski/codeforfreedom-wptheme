<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one
 * of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query,
 * e.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
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
        <div class="main-content col-xs-12 col-sm-7 col-md-8">
            <?php
            if (is_front_page()) {
                get_template_part('front');
            } else if (have_posts()) :
                // Start the Loop.
                while (have_posts()) : the_post();
                    /*
                     * Include the post format-specific template for the content. If you want to
                     * use this in a child theme, then include a file called called content-___.php
                     * (where ___ is the post format) and that will be used instead.
                     */
                    get_template_part('content', get_post_format());

                endwhile;
            else :
                // If no content, include the "No posts found" template.
                get_template_part('content', 'none');
            endif;
            ?>
        </div>
        <div class="main-sidebar col-xs-12 col-sm-4 col-md-3 col-sm-offset-1">
            <?php get_sidebar('front'); ?>
        </div>
    </div>
<?php

get_footer();