<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Manuscript
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				
					<?php
						// If the Co-Authors Plus plugin is active, let its template tag take over the author output
						// This  allows for guest author archives with the plugin
						// (see http://vip.wordpress.com/documentation/incorporate-co-authors-plus-template-tags-into-your-theme/)
						if ( is_author() && function_exists( 'coauthors' ) ) :
							?>
							<h1 class="page-title">
								<?php
									printf( __( 'By %s', 'manuscript' ), '<span class="vcard">' . coauthors( null, null, null, null, false ) . '</span>' );
								?>
							</h1>
							<?php
						else :
						
							the_archive_title( '<h1 class="page-title">', '</h1>' );

						endif;
					?>
				
				<?php
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );
				?>

			<?php endwhile; ?>

			<?php manuscript_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_footer(); ?>
