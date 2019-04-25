<?php
/**
 * Code for Freedom functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link http://codex.wordpress.org/Theme_Development
 * @link http://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * @link http://codex.wordpress.org/Plugin_API
 *
 * @package WordPress
 * @subpackage Code_for_Freedom
 * @since Code for Freedom 1.0
 */

$eventUrl = 'https://c4freedom.evenea.pl/';
$facebookEvent = 'https://www.facebook.com/events/1517059608509425/';

/**
 * Set up the content width value based on the theme's design.
 *
 * @see codeforfreedom_content_width()
 *
 * @since Code for Freedom 1.0
 */
if (!isset($content_width)) {
    $content_width = 474;
}

/**
 * Code for Freedom only works in WordPress 3.6 or later.
 */
if (version_compare($GLOBALS['wp_version'], '3.6', '<')) {
    require get_template_directory() . '/inc/back-compat.php';
}

if (!function_exists('codeforfreedom_setup')) :
    /**
     * Code for Freedom setup.
     *
     * Set up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support post thumbnails.
     *
     * @since Code for Freedom 1.0
     */
    function codeforfreedom_setup()
    {

        /*
         * Make Code for Freedom available for translation.
         *
         * Translations can be added to the /languages/ directory.
         * If you're building a theme based on Code for Freedom, use a find and
         * replace to change 'codeforfreedom' to the name of your theme in all
         * template files.
         */
        load_theme_textdomain('codeforfreedom', get_template_directory() . '/languages');

        // This theme styles the visual editor to resemble the theme style.
        add_editor_style(array('css/editor-style.css', codeforfreedom_font_url()));

        // Add RSS feed links to <head> for posts and comments.
        add_theme_support('automatic-feed-links');

        // Enable support for Post Thumbnails, and declare two sizes.
        add_theme_support('post-thumbnails');
        set_post_thumbnail_size(672, 372, true);
        add_image_size('codeforfreedom-full-width', 1038, 576, true);
        add_image_size('mentors_big', 190, 285, true);
        add_image_size('mentors_small', 96, 96, true);
        add_image_size('projects_big', 190, 285, true);

        // This theme uses wp_nav_menu() in two locations.
        register_nav_menus(array(
            'primary' => __('Top primary menu', 'codeforfreedom'),
            'secondary' => __('Secondary menu in left sidebar', 'codeforfreedom'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
        ));

        /*
         * Enable support for Post Formats.
         * See http://codex.wordpress.org/Post_Formats
         */
        add_theme_support('post-formats', array(
            'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery',
        ));

        // This theme allows users to set a custom background.
        add_theme_support('custom-background', apply_filters('codeforfreedom_custom_background_args', array(
            'default-color' => 'f5f5f5',
        )));

        // Add support for featured content.
        add_theme_support('featured-content', array(
            'featured_content_filter' => 'codeforfreedom_get_featured_posts',
            'max_posts' => 6,
        ));

        // This theme uses its own gallery styles.
        add_filter('use_default_gallery_style', '__return_false');
    }
endif; // codeforfreedom_setup
add_action('after_setup_theme', 'codeforfreedom_setup');

/**
 * Adjust content_width value for image attachment template.
 *
 * @since Code for Freedom 1.0
 */
function codeforfreedom_content_width()
{
    if (is_attachment() && wp_attachment_is_image()) {
        $GLOBALS['content_width'] = 810;
    }
}

add_action('template_redirect', 'codeforfreedom_content_width');

/**
 * Getter function for Featured Content Plugin.
 *
 * @since Code for Freedom 1.0
 *
 * @return array An array of WP_Post objects.
 */
function codeforfreedom_get_featured_posts()
{
    /**
     * Filter the featured posts to return in Code for Freedom.
     *
     * @since Code for Freedom 1.0
     *
     * @param array|bool $posts Array of featured posts, otherwise false.
     */
    return apply_filters('codeforfreedom_get_featured_posts', array());
}

/**
 * A helper conditional function that returns a boolean value.
 *
 * @since Code for Freedom 1.0
 *
 * @return bool Whether there are featured posts.
 */
function codeforfreedom_has_featured_posts()
{
    return !is_paged() && (bool)codeforfreedom_get_featured_posts();
}

/**
 * Register three Code for Freedom widget areas.
 *
 * @since Code for Freedom 1.0
 */
function codeforfreedom_widgets_init()
{
    require get_template_directory() . '/inc/widgets.php';
    register_widget('Code_for_Freedom_Ephemera_Widget');

    register_sidebar(array(
        'name' => __('Primary Sidebar', 'codeforfreedom'),
        'id' => 'sidebar-1',
        'description' => __('Main sidebar that appears on the left.', 'codeforfreedom'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h1 class="widget-title">',
        'after_title' => '</h1>',
    ));
    register_sidebar(array(
        'name' => __('Content Sidebar', 'codeforfreedom'),
        'id' => 'sidebar-2',
        'description' => __('Additional sidebar that appears on the right.', 'codeforfreedom'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h1 class="widget-title">',
        'after_title' => '</h1>',
    ));
    register_sidebar(array(
        'name' => __('Footer Widget Area', 'codeforfreedom'),
        'id' => 'sidebar-3',
        'description' => __('Appears in the footer section of the site.', 'codeforfreedom'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h1 class="widget-title">',
        'after_title' => '</h1>',
    ));
}

add_action('widgets_init', 'codeforfreedom_widgets_init');

/**
 * Register Lato Google font for Code for Freedom.
 *
 * @since Code for Freedom 1.0
 *
 * @return string
 */
function codeforfreedom_font_url()
{
    $font_url = '';
    /*
     * Translators: If there are characters in your language that are not supported
     * by Lato, translate this to 'off'. Do not translate into your own language.
     */
    if ('off' !== _x('on', 'Lato font: on or off', 'codeforfreedom')) {
        $font_url = add_query_arg('family', urlencode('Lato:300,400,700,900,300italic,400italic,700italic'), "//fonts.googleapis.com/css");
    }

    return $font_url;
}

/**
 * Enqueue scripts and styles for the front end.
 *
 * @since Code for Freedom 1.0
 */
function codeforfreedom_scripts()
{
    // Add Lato font, used in the main stylesheet.
    wp_enqueue_style('codeforfreedom-lato', codeforfreedom_font_url(), array(), null);

    // Add Genericons font, used in the main stylesheet.
    wp_enqueue_style('genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.0.2');

    // Load our main stylesheet.
    wp_enqueue_style('codeforfreedom-style', get_stylesheet_uri(), array('genericons'));

    // Load the Internet Explorer specific stylesheet.
    wp_enqueue_style('codeforfreedom-ie', get_template_directory_uri() . '/css/ie.css', array('codeforfreedom-style', 'genericons'), '20131205');
    wp_style_add_data('codeforfreedom-ie', 'conditional', 'lt IE 9');

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    if (is_singular() && wp_attachment_is_image()) {
        wp_enqueue_script('codeforfreedom-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array('jquery'), '20130402');
    }

    if (is_active_sidebar('sidebar-3')) {
        wp_enqueue_script('jquery-masonry');
    }

    if (is_front_page() && 'slider' == get_theme_mod('featured_content_layout')) {
        wp_enqueue_script('codeforfreedom-slider', get_template_directory_uri() . '/js/slider.js', array('jquery'), '20131205', true);
        wp_localize_script('codeforfreedom-slider', 'featuredSliderDefaults', array(
            'prevText' => __('Previous', 'codeforfreedom'),
            'nextText' => __('Next', 'codeforfreedom')
        ));
    }

    wp_enqueue_script('codeforfreedom-script', get_template_directory_uri() . '/js/functions.js', array('jquery'), '20140319', true);
}

add_action('wp_enqueue_scripts', 'codeforfreedom_scripts');

/**
 * Enqueue Google fonts style to admin screen for custom header display.
 *
 * @since Code for Freedom 1.0
 */
function codeforfreedom_admin_fonts()
{
    wp_enqueue_style('codeforfreedom-lato', codeforfreedom_font_url(), array(), null);
}

add_action('admin_print_scripts-appearance_page_custom-header', 'codeforfreedom_admin_fonts');

if (!function_exists('codeforfreedom_the_attached_image')) :
    /**
     * Print the attached image with a link to the next attached image.
     *
     * @since Code for Freedom 1.0
     */
    function codeforfreedom_the_attached_image()
    {
        $post = get_post();
        /**
         * Filter the default Code for Freedom attachment size.
         *
         * @since Code for Freedom 1.0
         *
         * @param array $dimensions {
         *     An array of height and width dimensions.
         *
         * @type int $height Height of the image in pixels. Default 810.
         * @type int $width Width of the image in pixels. Default 810.
         * }
         */
        $attachment_size = apply_filters('codeforfreedom_attachment_size', array(810, 810));
        $next_attachment_url = wp_get_attachment_url();

        /*
         * Grab the IDs of all the image attachments in a gallery so we can get the URL
         * of the next adjacent image in a gallery, or the first image (if we're
         * looking at the last image in a gallery), or, in a gallery of one, just the
         * link to that image file.
         */
        $attachment_ids = get_posts(array(
            'post_parent' => $post->post_parent,
            'fields' => 'ids',
            'numberposts' => -1,
            'post_status' => 'inherit',
            'post_type' => 'attachment',
            'post_mime_type' => 'image',
            'order' => 'ASC',
            'orderby' => 'menu_order ID',
        ));

        // If there is more than 1 attachment in a gallery...
        if (count($attachment_ids) > 1) {
            foreach ($attachment_ids as $attachment_id) {
                if ($attachment_id == $post->ID) {
                    $next_id = current($attachment_ids);
                    break;
                }
            }

            // get the URL of the next image attachment...
            if ($next_id) {
                $next_attachment_url = get_attachment_link($next_id);
            } // or get the URL of the first image attachment.
            else {
                $next_attachment_url = get_attachment_link(array_shift($attachment_ids));
            }
        }

        printf('<a href="%1$s" rel="attachment">%2$s</a>',
            esc_url($next_attachment_url),
            wp_get_attachment_image($post->ID, $attachment_size)
        );
    }
endif;

if (!function_exists('codeforfreedom_list_authors')) :
    /**
     * Print a list of all site contributors who published at least one post.
     *
     * @since Code for Freedom 1.0
     */
    function codeforfreedom_list_authors()
    {
        $contributor_ids = get_users(array(
            'fields' => 'ID',
            'orderby' => 'post_count',
            'order' => 'DESC',
            'who' => 'authors',
        ));

        foreach ($contributor_ids as $contributor_id) :
            $post_count = count_user_posts($contributor_id);

            // Move on if user has not published a post (yet).
            if (!$post_count) {
                continue;
            }
            ?>

            <div class="contributor">
                <div class="contributor-info">
                    <div class="contributor-avatar"><?php echo get_avatar($contributor_id, 132); ?></div>
                    <div class="contributor-summary">
                        <h2 class="contributor-name"><?php echo get_the_author_meta('display_name', $contributor_id); ?></h2>

                        <p class="contributor-bio">
                            <?php echo get_the_author_meta('description', $contributor_id); ?>
                        </p>
                        <a class="button contributor-posts-link"
                           href="<?php echo esc_url(get_author_posts_url($contributor_id)); ?>">
                            <?php printf(_n('%d Article', '%d Articles', $post_count, 'codeforfreedom'), $post_count); ?>
                        </a>
                    </div>
                    <!-- .contributor-summary -->
                </div>
                <!-- .contributor-info -->
            </div><!-- .contributor -->

        <?php
        endforeach;
    }
endif;

/**
 * Extend the default WordPress body classes.
 *
 * Adds body classes to denote:
 * 1. Single or multiple authors.
 * 2. Presence of header image.
 * 3. Index views.
 * 4. Full-width content layout.
 * 5. Presence of footer widgets.
 * 6. Single views.
 * 7. Featured content layout.
 *
 * @since Code for Freedom 1.0
 *
 * @param array $classes A list of existing body class values.
 * @return array The filtered body class list.
 */
function codeforfreedom_body_classes($classes)
{
    if (is_multi_author()) {
        $classes[] = 'group-blog';
    }

    if (get_header_image()) {
        $classes[] = 'header-image';
    } else {
        $classes[] = 'masthead-fixed';
    }

    if (is_archive() || is_search() || is_home()) {
        $classes[] = 'list-view';
    }

    if ((!is_active_sidebar('sidebar-2'))
        || is_page_template('page-templates/full-width.php')
        || is_page_template('page-templates/contributors.php')
        || is_attachment()
    ) {
        $classes[] = 'full-width';
    }

    if (is_active_sidebar('sidebar-3')) {
        $classes[] = 'footer-widgets';
    }

    if (is_singular() && !is_front_page()) {
        $classes[] = 'singular';
    }

    if (is_front_page() && 'slider' == get_theme_mod('featured_content_layout')) {
        $classes[] = 'slider';
    } elseif (is_front_page()) {
        $classes[] = 'grid';
    }

    return $classes;
}

add_filter('body_class', 'codeforfreedom_body_classes');

/**
 * Extend the default WordPress post classes.
 *
 * Adds a post class to denote:
 * Non-password protected page with a post thumbnail.
 *
 * @since Code for Freedom 1.0
 *
 * @param array $classes A list of existing post class values.
 * @return array The filtered post class list.
 */
function codeforfreedom_post_classes($classes)
{
    if (!post_password_required() && !is_attachment() && has_post_thumbnail()) {
        $classes[] = 'has-post-thumbnail';
    }

    return $classes;
}

add_filter('post_class', 'codeforfreedom_post_classes');

/**
 * Create a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @since Code for Freedom 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function codeforfreedom_wp_title($title, $sep)
{
    global $paged, $page;

    if (is_feed()) {
        return $title;
    }

    // Add the site name.
    $title .= get_bloginfo('name', 'display');

    // Add the site description for the home/front page.
    $site_description = get_bloginfo('description', 'display');
    if ($site_description && (is_home() || is_front_page())) {
        $title = "$title $sep $site_description";
    }

    // Add a page number if necessary.
    if ($paged >= 2 || $page >= 2) {
        $title = "$title $sep " . sprintf(__('Page %s', 'codeforfreedom'), max($paged, $page));
    }

    return $title;
}

add_filter('wp_title', 'codeforfreedom_wp_title', 10, 2);

if (is_home()) {
    echo '<script>
	     $("#primary-navigation li:contains(\'Home\')").addClass("current_page_item");
    	  </script>';
}

// Implement Custom Header features.
require get_template_directory() . '/inc/custom-header.php';

// Custom template tags for this theme.
require get_template_directory() . '/inc/template-tags.php';

// Add Theme Customizer functionality.
require get_template_directory() . '/inc/customizer.php';

/*
 * Add Featured Content functionality.
 *
 * To overwrite in a plugin, define your own Featured_Content class on or
 * before the 'setup_theme' hook.
 */
if (!class_exists('Featured_Content') && 'plugins.php' !== $GLOBALS['pagenow']) {
    require get_template_directory() . '/inc/featured-content.php';
}

/*
    An advanced substr but without breaking words in the middle.
    Comes in 3 flavours, one gets up to length chars as a maximum, the other with length chars as a minimum up to the next word, and the other considers removing final dots, commas and etcteteras for the sake of beauty (hahaha).
   This functions were posted by me some years ago, in the middle of the ages I had to use them in some corporations incorporated, with the luck to find them in some php not up to date mirrors. These mirrors are rarely being more not up to date till the end of the world... Well, may be am I the only person that finds usef not t bre word in th middl?

Than! (ks)

This is the calling syntax:

    snippet(phrase,[max length],[phrase tail])
    snippetgreedy(phrase,[max length before next space],[phrase tail])

*/

function snippet($text, $length = 64, $tail = "...")
{
    $text = trim($text);
    $txtl = strlen($text);
    if ($txtl > $length) {
        for ($i = 1; $text[$length - $i] != " "; $i++) {
            if ($i == $length) {
                return substr($text, 0, $length) . $tail;
            }
        }
        $text = substr($text, 0, $length - $i + 1) . $tail;
    }
    return $text;
}

// It behaves greedy, gets length characters ore goes for more

function snippetgreedy($text, $length = 64, $tail = "...")
{
    $text = trim($text);
    if (strlen($text) > $length) {
        for ($i = 0; $text[$length + $i] != " "; $i++) {
            if (!$text[$length + $i]) {
                return $text;
            }
        }
        $text = substr($text, 0, $length + $i) . $tail;
    }
    return $text;
}

// The same as the snippet but removing latest low punctuation chars,
// if they exist (dots and commas). It performs a later suffixal trim of spaces

function snippetwop($text, $length = 64, $tail = "...")
{
    $text = trim($text);
    $txtl = strlen($text);
    if ($txtl > $length) {
        for ($i = 1; $text[$length - $i] != " "; $i++) {
            if ($i == $length) {
                return substr($text, 0, $length) . $tail;
            }
        }
        for (; $text[$length - $i] == "," || $text[$length - $i] == "." || $text[$length - $i] == " "; $i++) {
            ;
        }
        $text = substr($text, 0, $length - $i + 1) . $tail;
    }
    return $text;
}

function upload_size_limit_filterw( $size ) {
	return 15360000*14; //Your Size in kb
}
add_filter( 'upload_size_limit', 'upload_size_limit_filterw',12 );
