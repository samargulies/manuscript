<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Manuscript
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_attachment_link(); ?>
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'manuscript' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<footer class="entry-footer">
		<?php edit_post_link( __( 'Edit', 'manuscript' ), '<span class="edit-link">', '</span>' ); ?>
		<nav id="image-navigation" class="navigation" role="navigation">
			<span class="previous-image"><?php previous_image_link( false, __( '< Previous', 'manuscript' ) ); ?></span>
			<span class="next-image"><?php next_image_link( false, __( 'Next >', 'manuscript' ) ); ?></span>
		</nav><!-- #image-navigation -->
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
