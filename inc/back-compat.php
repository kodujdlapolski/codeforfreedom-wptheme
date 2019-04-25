<?php
/**
 * Code for Freedom back compat functionality
 *
 * Prevents Code for Freedom from running on WordPress versions prior to 3.6,
 * since this theme is not meant to be backward compatible beyond that
 * and relies on many newer functions and markup changes introduced in 3.6.
 *
 * @package WordPress
 * @subpackage Code_for_Freedom
 * @since Code for Freedom 1.0
 */

/**
 * Prevent switching to Code for Freedom on old versions of WordPress.
 *
 * Switches to the default theme.
 *
 * @since Code for Freedom 1.0
 */
function codeforfreedom_switch_theme()
{
    switch_theme(WP_DEFAULT_THEME, WP_DEFAULT_THEME);
    unset($_GET['activated']);
    add_action('admin_notices', 'codeforfreedom_upgrade_notice');
}

add_action('after_switch_theme', 'codeforfreedom_switch_theme');

/**
 * Add message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * Code for Freedom on WordPress versions prior to 3.6.
 *
 * @since Code for Freedom 1.0
 */
function codeforfreedom_upgrade_notice()
{
    $message = sprintf(__('Code for Freedom requires at least WordPress version 3.6. You are running version %s. Please upgrade and try again.', 'codeforfreedom'), $GLOBALS['wp_version']);
    printf('<div class="error"><p>%s</p></div>', $message);
}

/**
 * Prevent the Theme Customizer from being loaded on WordPress versions prior to 3.6.
 *
 * @since Code for Freedom 1.0
 */
function codeforfreedom_customize()
{
    wp_die(sprintf(__('Code for Freedom requires at least WordPress version 3.6. You are running version %s. Please upgrade and try again.', 'codeforfreedom'), $GLOBALS['wp_version']), '', array(
        'back_link' => true,
    ));
}

add_action('load-customize.php', 'codeforfreedom_customize');

/**
 * Prevent the Theme Preview from being loaded on WordPress versions prior to 3.4.
 *
 * @since Code for Freedom 1.0
 */
function codeforfreedom_preview()
{
    if (isset($_GET['preview'])) {
        wp_die(sprintf(__('Code for Freedom requires at least WordPress version 3.6. You are running version %s. Please upgrade and try again.', 'codeforfreedom'), $GLOBALS['wp_version']));
    }
}

add_action('template_redirect', 'codeforfreedom_preview');
