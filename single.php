<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package aeris
 */

get_header(); 

$format = get_post_format();
$categories = get_the_terms( $post->ID, 'category');  
$themes = get_the_terms( $post->ID, 'theme');  
$themeSlugRewrite = "theme";
$typeProduits = get_the_terms( $post->ID, 'typeproduct');  
$typeProduitsSlugRewrite = "typeofproduct";

while ( have_posts() ) : the_post();

	get_template_part( 'template-parts/header-content', 'page' );
?>

	<div id="content-area" class="wrapper sidebar">
		<main id="main" class="site-main" role="main">
		
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
									
				<header>
				<?php theia_wpthchild_show_categories($themes, $themeSlugRewrite);?>
				<?php theme_aeris_show_categories($categories);?>
				<?php theia_wpthchild_show_categories($typeProduits, $typeProduitsSlugRewrite);?>
				</header>			
			
			
				<section class="wrapper-content">
					<?php 
					the_content();
					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'theme-aeris' ),
						'after'  => '</div>',
					) );
					?>
		        </section>

				<footer>
					<p>
						<?php the_author();?> - <?php theme_aeris_meta();?>
					</p>
					<?php 
					the_post_navigation();
					?>
				</footer><!-- .entry-meta -->
			</article>
			<?php			

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
			?>

		</main><!-- #main -->
		
		<?php 
		get_sidebar();
		?>
	</div><!-- #primary -->
<?php
endwhile; // End of the loop.

// get_sidebar();
get_footer();
