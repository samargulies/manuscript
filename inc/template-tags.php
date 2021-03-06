<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Manuscript
 */

if ( ! function_exists( 'manuscript_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function manuscript_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'manuscript' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav"><</span> Older posts', 'manuscript' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">></span>', 'manuscript' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'manuscript_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function manuscript_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'manuscript' ); ?></h1>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav"><</span>&nbsp;%title', 'Previous post link', 'manuscript' ) );
				next_post_link(     '<div class="nav-next">%link</div>',     _x( '%title&nbsp;<span class="meta-nav">></span>', 'Next post link',     'manuscript' ) );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'manuscript_attachment_nav' ) ) :
/**
 * Display navigation to next/previous attachment when applicable.
 */
function manuscript_attachment_nav() {
	?>
	<nav class="navigation attachment-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Image navigation', 'manuscript' ); ?></h1>
		<div class="nav-links">
			<div class="nav-previous"><?php previous_image_link(); ?></div>
			<div class="nav-next"> <?php next_image_link(); ?></div>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'manuscript_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time.
 */
function manuscript_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		_x( 'Posted on %s', 'post date', 'manuscript' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span>';

}
endif;

if ( ! function_exists( 'manuscript_posted_by' ) ) :

/**
 * Prints HTML with meta information for the current author.
 */
function manuscript_posted_by() {
	
	// If the Co-Authors Plus plugin is active, let its template tag take over the author output
	// (see http://vip.wordpress.com/documentation/incorporate-co-authors-plus-template-tags-into-your-theme/)
	if ( function_exists( 'coauthors_posts_links' ) ) {
		
		$byline = sprintf(
			_x( 'By %s', 'post author', 'manuscript' ),
			coauthors_posts_links( null, null, null, null, false )
		);
		
	} else {
		
		$byline = sprintf(
			_x( 'By %s', 'post author', 'manuscript' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);
		
	}

	echo '<span class="byline"> ' . $byline . '</span>';

}
endif;

if ( ! function_exists( 'manuscript_posted_with_categorization' ) ) :

/**
 * Prints HTML with category and tag information.
 */
function manuscript_posted_with_format() {
	if( has_post_format() ) {
		$format = get_post_format();
		?>
		<span class="post-format-link">
			<a href="<?php echo get_post_format_link( $format ); ?>" title="<?php esc_attr( printf( __( '%1$s posts', 'manuscript' ), get_post_format_string( $format ) ) ); ?>">
			<span class="genericon genericon-<?php echo $format; ?>"></span></a>
		</span>
		<?php
	}
}

/**
 * Prints HTML with category and tag information.
 */
function manuscript_posted_with_categorization() {

	/* translators: used between list items, there is a space after the comma */
	$categories_list = get_the_category_list( __( ', ', 'manuscript' ) );
	if ( $categories_list && manuscript_categorized_blog() ) :
		?>
		<span class="cat-links">
			<?php printf( __( 'Categories: %1$s', 'manuscript' ), $categories_list ); ?>
		</span>
	<?php 
	endif; // End if categories
	/* translators: used between list items, there is a space after the comma */
	$tags_list = get_the_tag_list( '', __( ', ', 'manuscript' ) );
	if ( $tags_list ) :
		?>
		<span class="tag-links">
			<?php printf( __( 'Tags: %1$s', 'manuscript' ), $tags_list ); ?>
		</span>
	<?php 
	endif; // End if $tags_list 
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function manuscript_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'manuscript_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'manuscript_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so manuscript_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so manuscript_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in manuscript_categorized_blog.
 */
function manuscript_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'manuscript_categories' );
}
add_action( 'edit_category', 'manuscript_category_transient_flusher' );
add_action( 'save_post',     'manuscript_category_transient_flusher' );

/**
 * Returns true if a blog has any pages
 *
 * @return bool
 */
function manuscript_site_has_pages() {

	if ( false === ( $all_the_cool_pages = get_transient( 'manuscript_pages' ) ) ) {

		$all_the_cool_pages = get_pages( array(
			'hierarchical' => false,

			// We only need to know if there is at least one page.
			'number' => 1
		) );


		// Count the number of pages.
		$all_the_cool_pages = count( $all_the_cool_pages );

		set_transient( 'manuscript_pages', $all_the_cool_pages );

	}
	// If this blog has more than 0 pages return true, if it has no pages so return false.
	return $all_the_cool_pages > 0;
}

/**
 * Flush out the transients used in manuscript_site_has_pages.
 */
function manuscript_page_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'manuscript_pages' );
}
add_action( 'trash_page', 'manuscript_page_transient_flusher' );
add_action( 'publish_page', 'manuscript_page_transient_flusher' );

/**
 *  Custom callback for wp_nav_menu to call wp_page_menu(), but only if we 
 *  have any pages at all on the site 
 */
function manuscript_page_menu() {
	if( manuscript_site_has_pages() ) {
		wp_page_menu();
	}
}
