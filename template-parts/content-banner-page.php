<?php
/**
 * Template part for displaying page content in template-{THEIA-SPEC}.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package aeris
 */
$themes = get_the_terms( $post->ID, 'theme');  
$themeSlugRewrite = "theme";

$products = get_the_terms( $post->ID, 'typeproduct');  
$productsSlugRewrite = "typeofproduct";
?>

<article id="post-<?php the_ID(); ?>">
    <div class="wrapper-content">
	<?php theia_wpthchild_show_categories($themes, $themeSlugRewrite);?><hr>
	<?php theia_wpthchild_show_categories($products, $productsSlugRewrite);?>
	<?php
		the_content();

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'theme-aeris' ),
			'after'  => '</div>',
		) );
	?>

	</div>
</article><!-- #post-## -->