<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package Manuscript
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function manuscript_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
		'footer_widgets' => is_active_sidebar( 'sidebar-1' ),
	) );
}
add_action( 'after_setup_theme', 'manuscript_jetpack_setup' );
