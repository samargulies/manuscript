<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Manuscript
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">

		<?php get_sidebar(); ?>

		<div class="site-info">
			<?php printf( __( '%1$s: A WordPress theme by %2$s.', 'manuscript' ), '<strong>Manuscript</strong>', '<a href="http://www.belabor.org/" rel="designer">Sam Margulies</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
