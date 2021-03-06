<?php
/**
 * Manuscript Theme Customizer
 *
 * @package Manuscript
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function manuscript_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// Add Accent Color to Customizer
	$wp_customize->add_setting( 'accent_color' , array(
		'default'     => '#b5e7fc',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'   => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent_color', array(
		'label'        => __( 'Accent Color', 'manuscript' ),
		'section'    => 'colors',
		'settings'   => 'accent_color',
	) ) );

	// Add Link Color to Customizer
	$wp_customize->add_setting( 'link_color' , array(
		'default'     => '#ffef8b',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'   => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
		'label'        => __( 'Link Color', 'manuscript' ),
		'section'    => 'colors',
		'settings'   => 'link_color',
	) ) );
}
add_action( 'customize_register', 'manuscript_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function manuscript_customize_preview_js() {
	wp_enqueue_script( 'manuscript_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20140815', true );
}
add_action( 'customize_preview_init', 'manuscript_customize_preview_js' );

/**
 * Print CSS from customizer
 */
function manuscript_customize_css( $is_header_preview ) {
	// Accent Color
	if( '#b5e7fc' !== get_theme_mod('accent_color') && false !== get_theme_mod('accent_color') ) {
		?>
		<style type="text/css">
			.site-title .background-path {
				fill: <?php echo get_theme_mod('accent_color'); ?>; 
			}
			.sticky {
				border-color: <?php echo get_theme_mod('accent_color'); ?>;
			}
			.bypostauthor .fn {
				background-color: <?php echo get_theme_mod('accent_color'); ?>;
			}
		</style>
		<?php
	}
	// Link Color
	if( '#ffef8b' !== get_theme_mod('link_color') && false !== get_theme_mod('accent_color') ) {
		?>
		<style type="text/css">
			<?php if( $is_header_preview !== true ) { ?>

			a, .entry-footer .comments-link a {
				box-shadow: inset 0 -2px 0 <?php echo get_theme_mod('link_color'); ?>;
			}
			.entry-title a {
				box-shadow: inset 0 -.4em 0 <?php echo get_theme_mod('link_color'); ?>;
			}
			.entry-content a,
			.comment-content a {
				box-shadow: inset 0 -5px 0 <?php echo get_theme_mod('link_color'); ?>;
			}
			a:hover,
			a:focus,
			a:active,
			.main-navigation ul ul li:hover > a,
			.page-links a {
				background-color: <?php echo get_theme_mod('link_color'); ?>;
			}

			.post-format-link a:hover,
			.post-format-link a:focus,
			.post-format-link a:active {
				color: <?php echo get_theme_mod('link_color'); ?>;
			}
			
			.site-main .attachment-navigation .nav-previous a::after,
			.site-main .attachment-navigation .nav-next a::after {
				color: <?php echo get_theme_mod('link_color'); ?>;
			}
			
			<?php } ?>

			.site-title a:hover .background-path,
			.site-title a:focus .background-path,
			.site-title a:active .background-path  {
				fill: <?php echo get_theme_mod('link_color'); ?>;
			}
		</style>
		<?php
	}
}
add_action( 'wp_head', 'manuscript_customize_css');


