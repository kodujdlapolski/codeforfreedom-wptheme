<?php
/*
* Template Name: Mentors Template
* @package WordPress
* @subpackage Code_for_Freedom
* @since Code for Freedom 1.0
*/

get_header();

// Include the featured content template.
get_template_part('front-banner');
?>
    <div id="main" class="container"><!-- #main container -->
        <div class="main-content col-xs12 col-sm-8">
            <div class="mentors frontPost row">
                <div class="title">Mentors</div>
                <div class="content">
                    <?php
                    $mentors = get_posts(array('category' => get_cat_ID('Mentors'), 'numberposts' => -1));

                    foreach ($mentors as $m) : setup_postdata($m);
                        //var_export($m);
                        $mentorBackground = get_the_post_thumbnail($m->ID, 'mentors_small');
                        if (empty($mentorBackground)) { // check if the post has a Post Thumbnail assigned to it.
                            $mentorBackground = '<img src="' . get_template_directory_uri() . '/images/mentors/blank96.png" />';
                        }
                        $mentorsName = apply_filters('the_title', $m->post_title);
                        $mentorsDiaspora = (get_post_meta($m->ID, 'diaspora')[0]);
                        $mentorsTwitter = (get_post_meta($m->ID, 'twitter')[0]);
                        $mentorsContent = strip_tags(apply_filters('the_content', $m->post_content), '<p><span><a><b><strong><br><img>');
                        $projectBlock = '<div id="' . $m->post_name . '" class="mentor col-xs-12 col-md-4">';
                        $projectBlock .= '<div class="mentorImg">' . $mentorBackground . '</div>';
                        $projectBlock .= '<div class="mentorTitle">' . $mentorsName . '</div>';
                        if (isset($mentorsDiaspora))
                            $projectBlock .= '<div class="mentorDiaspora"><a href="https://joindiaspora.com/u/' . $mentorsDiaspora . '" target="_blank">Diaspora: ' . $mentorsDiaspora . '</a></div>';
                        if (isset($mentorsTwitter))
                            $projectBlock .= '<div class="mentorTwitter"><a href="https://twitter.com/' . $mentorsTwitter . '" target="_blank">@' . $mentorsTwitter . '</a></div>';
                        $projectBlock .= '<div class="mentorContent">' . $mentorsContent . '</div>';
                        $projectBlock .= '</div>';

                        echo $projectBlock;
                    endforeach;
                    ?>
                </div>
            </div>
        </div>
        <div class="main-sidebar col-xs-12 col-sm-3 col-sm-offset-1">
            <?php get_sidebar('front'); ?>
        </div>
    </div>
<?php

get_footer();