<?php
/**
 * The Content Sidebar
 *
 * @package WordPress
 * @subpackage Code_for_Freedom
 * @since Code for Freedom 1.0
 */
?>
<div class="sidebarFront sidebar">
    <div class="news-and-tips">
        <div class="title">News and Tips</div>
        <div class="content">
            <?php
            $tips = get_posts(array('category' => get_cat_ID('News and Tips'), 'numberposts' => 5));

            foreach ($tips as $t) : setup_postdata($t);
                $tipDate = apply_filters('the_date', $t->post_date);
                $tipTitle = apply_filters('the_title', $t->post_title);
                echo '<a class="tip" href="' . $t->guid . '" target="_self"><div class="date">' . $tipDate . '</div><div class="subtitle">' . $tipTitle . '</div></a>';
            endforeach;
            ?>
        </div>
    </div>
    <div class="twitter">
        <?php get_sidebar('widget_twitter'); ?>
    </div>
    <div class="facebook">
        <?php get_sidebar('widget_facebook'); ?>
    </div>
</div>