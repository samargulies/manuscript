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
				<h1 class="page-title">
					<?php
						if ( is_category() ) :
							single_cat_title();

						elseif ( is_tag() ) :
							printf( __( 'Tagged %s', 'manuscript' ), '<span>' . single_tag_title('', false) . '</span>' );

						elseif ( is_author() ) :
							
							// If the Co-Authors Plus plugin is active, let its template tag take over the author output
							// This  allows for guest author archives with the plugin
							// (see http://vip.wordpress.com/documentation/incorporate-co-authors-plus-template-tags-into-your-theme/)
							if ( function_exists( 'coauthors' ) ) {
								printf( __( 'By %s', 'manuscript' ), '<span class="vcard">' . coauthors( null, null, null, null, false ) . '</span>' );
							} else {
								printf( __( 'By %s', 'manuscript' ), '<span class="vcard">' . get_the_author() . '</span>' );
							}

						elseif ( is_day() ) :
							printf( __( 'From %s', 'manuscript' ), '<span>' . get_the_date() . '</span>' );

						elseif ( is_month() ) :
							printf( __( 'From %s', 'manuscript' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'manuscript' ) ) . '</span>' );

						elseif ( is_year() ) :
							printf( __( 'From %s', 'manuscript' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'manuscript' ) ) . '</span>' );

						elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
							_e( 'Asides', 'manuscript' );

						elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
							_e( 'Galleries', 'manuscript' );

						elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
							_e( 'Images', 'manuscript' );

						elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
							_e( 'Videos', 'manuscript' );

						elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
							_e( 'Quotes', 'manuscript' );

						elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
							_e( 'Links', 'manuscript' );

						elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
							_e( 'Statuses', 'manuscript' );

						elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
							_e( 'Audios', 'manuscript' );

						elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
							_e( 'Chats', 'manuscript' );

						else :
							_e( 'Archives', 'manuscript' );

						endif;
					?>
				</h1>
				<?php
					// Show an optional term description.
					$term_description = term_description();
					if ( ! empty( $term_description ) ) :
						printf( '<div class="taxonomy-description">%s</div>', $term_description );
					endif;
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
