<?php
/**
 * @package Manuscript
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">

		<?php if ( ! empty( $post->post_parent ) ) : ?>
			<p>
				<a href="<?php echo esc_url( get_permalink( $post->post_parent ) ); ?>" title="<?php echo esc_attr( sprintf( __( 'Return to %s', 'manuscript' ), strip_tags( get_the_title( $post->post_parent ) ) ) ); ?>" rel="gallery">
					<?php
					/* translators: %s - title of parent post */
					printf( __( '<span class="meta-nav"><</span> %s', 'manuscript' ), get_the_title( $post->post_parent ) );
					?>
				</a>
			</p>
		<?php endif; ?>


		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
	
		<div class="entry-attachment">

			<?php echo wp_get_attachment_image( $post->ID, 'large' ); ?>

			<?php if ( ! empty( $post->post_excerpt ) ) : ?>
			<div class="entry-caption">
				<?php the_excerpt(); ?>
			</div>
			<?php endif; ?>

		</div><!-- .entry-attachment -->

		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'manuscript' ),
				'after'  => '</div>',
			) );
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<span class="entry-author">
			<?php manuscript_posted_by(); ?>
		</span><!-- .entry-author -->
		<span class="entry-meta">
			<?php manuscript_posted_on(); ?>
		</span><!-- .entry-meta -->
		<?php edit_post_link( __( 'Edit', 'manuscript' ), '<span class="edit-link">', '</span>' ); ?>

	</footer><!-- .entry-footer -->

	<?php manuscript_attachment_nav() ?>

</article><!-- #post-## -->
