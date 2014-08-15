<?php
/**
 * @package Manuscript
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">

		<?php if ( has_post_thumbnail() ) : ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
				<?php the_post_thumbnail(); ?>
			</a>
		<?php endif; ?>

		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">></span>', 'manuscript' ) ); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'manuscript' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php manuscript_posted_with_format(); ?>
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