<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage Code_for_Freedom
 * @since Code for Freedom 1.0
 */

get_header();
get_template_part('front-banner');
?>

    <div id="main" class="container"><!-- #main container -->
        <div class="main-content col-xs-12 col-sm-8">
            <div class="frontPost row">
                <div class="title"><?php _e('Not Found', 'codeforfreedom'); ?></div>
                <div class="content">
                    <p><?php _e('It looks like nothing was found at this location. Maybe try a search?', 'codeforfreedom'); ?></p>

                    <?php get_search_form(); ?>
                </div>
            </div>
        </div>
        <div class="main-sidebar col-xs-12 col-sm-3 col-sm-offset-1">
            <?php get_sidebar('front'); ?>
        </div>
    </div>
<?php

get_footer();