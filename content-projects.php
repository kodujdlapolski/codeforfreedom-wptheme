<?php
/**
 * The template used for displaying Projects post content
 *
 * @package WordPress
 * @subpackage Code_for_Freedom
 * @since Code for Freedom 1.0
 */
?>

<div class="post projectDetail">
    <?php the_title('<div class="subTitle">', '</div>'); ?>
    <div class="author">
        Project Leader: <strong><?php echo(get_post_meta(get_the_ID(), 'autor')[0]); ?></strong>
    </div>
	<?php codeforfreedom_post_thumbnail(); ?>
    <div class="content">
        <div class="content-title">Description:</div>
        <?php
        function my_strip_tags($content)
        {
            return strip_tags($content, '<p><span><a><b><strong><br><img><iframe><ul><ol><li>');
        }

        add_filter('the_content', 'my_strip_tags');

        the_content();
        ?>
    </div>

    <?php comments_template() ?>

    <?php $back = $_SERVER['HTTP_REFERER'];
    if (isset($back) && $back != '') {
        echo '<a class="goBack" href="' . $back . '" target="_self">Go back</a>';
    } else {
        echo '<a class="goBack" href="/" target="_self">Go back</a>';
    }?>
    <!-- .entry-content -->
</div>