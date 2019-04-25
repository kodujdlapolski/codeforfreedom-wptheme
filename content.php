<?php
/**
 * The template used for displaying post content
 *
 * @package WordPress
 * @subpackage Code_for_Freedom
 * @since Code for Freedom 1.0
 */
?>

<div class="post">
    <?php
    // Page thumbnail and title.
    codeforfreedom_post_thumbnail();
    the_title('<div class="subTitle">', '</div><!-- .entry-header -->');
    ?>
    <div class="content">
        <?php the_content(); ?>
    </div>
    <?php $back = $_SERVER['HTTP_REFERER'];
    if (isset($back) && $back != '') {
        echo '<a class="goBack" href="' . $back . '" target="_self">Go back</a>';
    } else {
        echo '<a class="goBack" href="/" target="_self">Go back</a>';
    }?>
    <!-- .entry-content -->
</div>