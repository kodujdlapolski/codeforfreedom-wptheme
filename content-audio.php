<?php
/**
 * The template for displaying posts in the Audio post format
 *
 * @package WordPress
 * @subpackage Code_for_Freedom
 * @since Code for Freedom 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php codeforfreedom_post_thumbnail(); ?>

    <header class="entry-header">
        <?php if (in_array('category', get_object_taxonomies(get_post_type())) && codeforfreedom_categorized_blog()) : ?>
            <div class="entry-meta">
                <span
                    class="cat-links"><?php echo get_the_category_list(_x(', ', 'Used between list items, there is a space after the comma.', 'codeforfreedom')); ?></span>
            </div><!-- .entry-meta -->
        <?php
        endif;

        if (is_single()) :
            the_title('<h1 class="entry-title">', '</h1>');
        else :
            the_title('<h1 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h1>');
        endif;
        ?>

        <div class="entry-meta">
			<span class="post-format">
				<a class="entry-format"
                   href="<?php echo esc_url(get_post_format_link('audio')); ?>"><?php echo get_post_format_string('audio'); ?></a>
			</span>

            <?php codeforfreedom_posted_on(); ?>

            <?php if (!post_password_required() && (comments_open() || get_comments_number())) : ?>
                <span
                    class="comments-link"><?php comments_popup_link(__('Leave a comment', 'codeforfreedom'), __('1 Comment', 'codeforfreedom'), __('% Comments', 'codeforfreedom')); ?></span>
            <?php endif; ?>

            <?php edit_post_link(__('Edit', 'codeforfreedom'), '<span class="edit-link">', '</span>'); ?>
        </div>
        <!-- .entry-meta -->
    </header>
    <!-- .entry-header -->

    <div class="entry-content">
        <?php
        the_content(__('Continue reading <span class="meta-nav">&rarr;</span>', 'codeforfreedom'));
        wp_link_pages(array(
            'before' => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'codeforfreedom') . '</span>',
            'after' => '</div>',
            'link_before' => '<span>',
            'link_after' => '</span>',
        ));
        ?>
    </div>
    <!-- .entry-content -->

    <?php the_tags('<footer class="entry-meta"><span class="tag-links">', '', '</span></footer>'); ?>
</article><!-- #post-## -->
