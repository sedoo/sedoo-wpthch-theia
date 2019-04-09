<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package aeris
 */

?>

<article id="post-<?php the_ID(); ?>">
	
    <div class="wrapper-content">
	<?php
		the_content();

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'theme-aeris' ),
			'after'  => '</div>',
		) );
	?>

	</div>
</article><!-- #post-## -->
