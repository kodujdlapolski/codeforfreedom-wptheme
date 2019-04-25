<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Code_for_Freedom
 * @since Code for Freedom 1.0
 */

get_header();

global $post;
$categories = get_the_category($post->ID);

// Include the featured content template.
get_template_part('front-banner');
?>
    <div id="main" class="container"><!-- #main container -->
        <div class="main-content col-xs-12 col-sm-8">
            <div class="single-post row">
                <?php if ($categories) { ?>
                    <h2 class="title">
                        <?php echo($categories[0]->name); ?>
                    </h2>
                <?php
                }
                while (have_posts()) : the_post();
                    if ($categories[0]->name == 'News and Tips') {
                        get_template_part('content-news-and-tips');
                    } elseif ($categories[0]->name == 'Projects') {
                        get_template_part('content-projects');
                    } else {
                        get_template_part('content', get_post_format());
                    }
                endwhile;
                ?>
            </div>
        </div>
        <div class="main-sidebar col-xs-12 col-sm-3 col-sm-offset-1">
            <?php if ($categories[0]->name == 'News and Tips') {
                get_sidebar('news-and-tips');
            } else {
                get_sidebar('front');
            } ?>
        </div>
    </div>

    <script>
        window.onload = function () {
            if (jQuery('#primary-navigation').find('li a:contains("<?php echo($categories[0]->name) ?>")')) {
                jQuery('#primary-navigation').find('li.current_page_item').removeClass('current_page_item');
                jQuery('#bottom-navigation').find('li.current_page_item').removeClass('current_page_item');
                jQuery('#primary-navigation').find('li a:contains("<?php echo($categories[0]->name) ?>")').parent().addClass('current-menu-item current_page_item');
                jQuery('#bottom-navigation').find('li a:contains("<?php echo($categories[0]->name) ?>")').parent().addClass('current-menu-item current_page_item');
            }
        }
    </script>

<?php
get_footer();
