<?php
/**
 * The template used for displaying News and Tips post content
 *
 * @package WordPress
 * @subpackage Code_for_Freedom
 * @since Code for Freedom 1.0
 */
?>

<div class="post">
    <?php
    // Page thumbnail and title.
    the_title('<div class="subTitle">', '</div><!-- .entry-header -->');
    ?>
    <div class="content">
        <?php
        function my_strip_tags($content)
        {
            return strip_tags($content, '<p><span><a><b><strong><br><img><iframe><ul><ol><li>');
        }

        add_filter('the_content', 'my_strip_tags');

        the_content();
        ?>
    </div>
    <?php $back = $_SERVER['HTTP_REFERER'];
    if (isset($back) && $back != '') {
        echo '<a class="goBack" href="' . $back . '" target="_self">Go back</a>';
    } else {
        echo '<a class="goBack" href="/" target="_self">Go back</a>';
    }?>
    <!-- .entry-content -->
</div>