<?php
/**
 * @package Manuscript
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php if ( has_post_thumbnail() ) {	the_post_thumbnail(); } ?>
		
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php manuscript_posted_with_format(); ?>

			<?php manuscript_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'manuscript' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<div class="entry-author">
			<?php manuscript_posted_by(); ?>
		</div><!-- .entry-author -->
		<div class="entry-tax">
			<?php manuscript_posted_with_categorization(); ?>
		</div><!-- .entry-tax -->
		<?php edit_post_link( __( 'Edit', 'manuscript' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
