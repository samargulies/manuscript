<?php
/**
 * Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * @package Manuscript
 */

/**
 * Setup the WordPress core custom header feature.
 *
 * @uses manuscript_header_style()
 * @uses manuscript_admin_header_style()
 * @uses manuscript_admin_header_image()
 */
function manuscript_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'manuscript_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '404040',
		'width'                  => 762,
		'height'                 => 140,
		'flex-height'            => true,
		'wp-head-callback'       => 'manuscript_header_style',
		'admin-head-callback'    => 'manuscript_admin_header_style',
		'admin-preview-callback' => 'manuscript_admin_header_image',
	) ) );
}
add_action( 'after_setup_theme', 'manuscript_custom_header_setup' );

if ( ! function_exists( 'manuscript_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see manuscript_custom_header_setup().
 */
function manuscript_header_style() {
	$header_text_color = get_header_textcolor();

	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
	if ( HEADER_TEXTCOLOR == $header_text_color ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == $header_text_color ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		.site-title,
		.bypostauthor .fn {
			color: #<?php echo $header_text_color; ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // manuscript_header_style

if ( ! function_exists( 'manuscript_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see manuscript_custom_header_setup().
 */
function manuscript_admin_header_style() {
	?>
	<style type="text/css">

		@font-face {
		    font-family: 'LatinModernMono';
		    src: url('<?php echo get_template_directory_uri(); ?>/fonts/lmmono10-regular-webfont.eot');
		    src: url('<?php echo get_template_directory_uri(); ?>/fonts/lmmono10-regular-webfont.eot?#iefix') format('embedded-opentype'),
		         url('<?php echo get_template_directory_uri(); ?>/fonts/lmmono10-regular-webfont.woff') format('woff'),
		         url('<?php echo get_template_directory_uri(); ?>/fonts/lmmono10-regular-webfont.ttf') format('truetype'),
		         url('<?php echo get_template_directory_uri(); ?>/fonts/lmmono10-regular-webfont.svg#LatinModernMono10Regular') format('svg');
		    font-weight: normal;
		    font-style: normal;
		}
		@font-face {
		    font-family: 'LatinModernMono';
		    src: url('<?php echo get_template_directory_uri(); ?>/fonts/lmmono10-italic-webfont.eot');
		    src: url('<?php echo get_template_directory_uri(); ?>/fonts/lmmono10-italic-webfont.eot?#iefix') format('embedded-opentype'),
		         url('<?php echo get_template_directory_uri(); ?>/fonts/lmmono10-italic-webfont.woff') format('woff'),
		         url('<?php echo get_template_directory_uri(); ?>/fonts/lmmono10-italic-webfont.ttf') format('truetype'),
		         url('<?php echo get_template_directory_uri(); ?>/fonts/lmmono10-italic-webfont.svg#LatinModernMono10Italic') format('svg');
		    font-weight: normal;
		    font-style: italic;
		}
		.admin-header-preview {
			font-size: 19px;
			font-family: "LatinModernMono", "Courier New", courier, monospace;
			line-height: 1.5;
			max-width: 800px;
			margin: 0 auto;
			padding: 1em;
			background: white;
		}
		.admin-header-preview img {
			border: none;
			max-width: 100%;
			height: auto;
		}
		.site-title {
			text-align: center;
			font-size: 40px;
			margin: 0;
		}
		.site-title a {
			text-decoration: none;
			color: inherit;
			font-weight: normal;
			margin: 0;
			padding: .1em .3em .15em 1em;
			padding: .1em 1em .15em 1em;
			display: inline-block;
			position: relative;
			z-index: 1;
		}

		.site-title a:hover {
			color: #404040;
		}

		.site-title .header-background {
			position: absolute;
			left: 0;
			top: 0;
			width: 100%;
			height: 100%;
			z-index: -1;
		}

		h2.site-description {
			text-align: center;
			font-weight: normal;
			font-style: italic;
			font-size: 19px;
			margin: 0 0 1.5em;
			padding: 0;
			line-height: 1.5;
		}

		@media (min-width: 800px) {
			.site-header {
				margin-top: 1.9em;
			}
			.site-title {
				margin-top: -.9em;
			}
		}
		@media (max-width: 600px) {
			.site-title {
				font-size: 28px;
				font-size: 2.8rem;
			}
		}
	</style>
	<?php
}
endif; // manuscript_admin_header_style

if ( ! function_exists( 'manuscript_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see manuscript_custom_header_setup().
 */
function manuscript_admin_header_image() {
	manuscript_header_style();
	manuscript_customize_css( true );
	?>
	<header id="masthead" class="site-header admin-header-preview" role="banner">
	<div class="site-branding">
		<h1 class="site-title">
			<a rel="home" onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<span><?php bloginfo( 'name' ); ?></span>
				<svg class="header-background" xmlns="http://www.w3.org/2000/svg" width="0" height="0" viewBox="0 0 481 116" preserveAspectRatio="none" version="1.1"><path class="background-path" d="M16 0L0 116 465 116 481 0 16 0Z" fill="#FFD996"></path></svg>
			</a>
		</h1>
		<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>

		<?php if ( get_header_image() ) : ?>
			<div class="site-header-image"
				<a onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
				</a>
			</div><!-- .site-header-image -->
		<?php endif; // End header image check. ?>

	</div>
	</header>
	<?php
}
endif; // manuscript_admin_header_image
