<?php
/*
* Template Name: News and Tips Template
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
            <div class="news-and-tips frontPost row">
                <div class="title">News and Tips</div>
                <ul>
                    <?php
                    $newsTips = get_posts(array('category' => get_cat_ID('News and Tips'), 'numberposts' => -1));

                    foreach ($newsTips as $n) : setup_postdata($n);
                        if ($n->post_status == 'publish') {
                            $newsDate = apply_filters('the_date', $n->post_date_gmt);
                            $newsTitle = apply_filters('the_title', $n->post_title);
                            $newsContent = snippet(strip_tags($n->post_content), 800);
                            $block = '<li>';
                            $block .= '<div class="date">' . $newsDate . '</div>';
                            $block .= '<div class="subTitle">' . $newsTitle . '</div>';
                            $block .= '<div class="content">' . $newsContent . '</div>';
                            $block .= '<a href="' . get_permalink($n->ID) . '" href="_self" class="readmore">Read more</a>';
                            $block .= '</li>';

                            echo $block;
                        }
                    endforeach;
                    ?>
                </ul>
            </div>
        </div>
        <div class="main-sidebar col-xs-12 col-sm-3 col-sm-offset-1">
            <?php get_sidebar('news-and-tips'); ?>
        </div>
    </div>
<?php

get_footer();