<?php
/**
 * The template part for displaying results in search pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Manuscript
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->

	<footer class="entry-footer">
		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<span class="entry-author">
				<?php manuscript_posted_by(); ?>
			</span><!-- .entry-author -->
			<span class="entry-meta">
				<?php manuscript_posted_on(); ?>
			</span><!-- .entry-meta -->
			<span class="entry-tax">
				<?php manuscript_posted_with_categorization(); ?>
			</span><!-- .entry-tax -->
		<?php endif; // End if 'post' == get_post_type() ?>

		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'manuscript' ), __( '1 Comment', 'manuscript' ), __( '% Comments', 'manuscript' ) ); ?></span>
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'manuscript' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->