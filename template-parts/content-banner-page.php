<?php
/**
 * Template part for displaying page content in template-{THEIA-SPEC}.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package aeris
 */
$categories = get_the_terms( $post->ID, 'theme');  
?>

<article id="post-<?php the_ID(); ?>">
    <div class="wrapper-content">
	<?php theme_aeris_show_categories($categories);?>
	<?php
		the_content();

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'theme-aeris' ),
			'after'  => '</div>',
		) );
	?>

	</div>
</article><!-- #post-## -->