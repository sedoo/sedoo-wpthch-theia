<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package aeris
 */

get_header(); 

//get_template_part( 'template-parts/header-content', 'archive' );
// recup le slug du term courant
$term = get_queried_object();
/**
 * WP_Query pour lister la page Theme correspondante
*/
$args = array(
	'post_type' => array('page'),
	'post_status'           => array( 'publish' ),
	'posts_per_page'        => 1,            // -1 pour liste sans limite
	// 'post__not_in'          => array($postID),    //exclu le post courant
	'tax_query' => array(
		array(
			'taxonomy' => 'theme',
			'field'    => 'slug',
			'terms'    => $term->slug,
		),
	),
);
$the_query = new WP_Query( $args );
while ( $the_query->have_posts() ) {
	$the_query->the_post();

?>
<div id="breadcrumbs">
	<div class="wrapper">
		<?php 
		// Show breadcrumb if checked in customizer
		if ( get_theme_mod( 'theme_aeris_breadcrumb' ) == "true") {
			if (function_exists('the_breadcrumb')) the_breadcrumb(); 
		}
		?>		
	</div>
</div>
<div class="site-branding" 
    <?php 
    if (get_the_post_thumbnail_url()) {
    ?>
    style="background-image:url(
    <?php the_post_thumbnail_url( 'full' ); ?>
    );">
    <?php 
    }
    ?>
    <div>    
        <h1 class="site-title" rel="bookmark" style="<?php ?>"><span><?php  the_archive_title(); ?></span></h1>
    </div>
</div><!-- .site-branding -->


<div id="content-area" class="wrapper archives">
	<main id="main" class="site-main" role="main">

		<section role="theme-embed-page">
			
		
			<article  id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header>
					<?php //theia_wpthchild_show_categories($themes, $themeSlugRewrite);?>
					<?php //theme_aeris_show_categories($categories);?>
					<?php //theia_wpthchild_show_categories($typeProduits, $typeProduitsSlugRewrite);?>
					
				</header>
				<section>
					<!-- <svg>
						<use xlink:href="agriculture">
					</svg> -->
					<?php if($post->post_content != "") : ?>			
					<div class="post-excerpt">	    		            			            	                                                                                            
						<?php the_excerpt(); ?>
					</div>
					<p><a href="<?php the_permalink(); ?>" title="<?php the_title();?>">Lire la suite</a></p>
					<?php endif; ?>
				</section>
				<!-- <footer>
				</footer> -->
			</article>
			<?php
			} // End of the loop.
			?>				
		</section>
<?php 
	/* Restore original Post Data */
	wp_reset_postdata();
	?>


		<?php
		/**
		 * WP_Query pour lister les posts ET les CTP

			*/
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$args = array(
			'post_type' => array('post', 'ces', 'products'),
			'post_status'           => array( 'publish' ),
			'posts_per_page'        => 9,            // -1 pour liste sans limite
			'paged'					=> $paged,
			// 'post__not_in'          => array($postID),    //exclu le post courant
			'tax_query' => array(
				array(
					'taxonomy' => 'theme',
					'field'    => 'slug',
					'terms'    => $term->slug,
				),
			),
		);
		$the_query = new WP_Query( $args );

		// The Loop
		if ( $the_query->have_posts() ) { ?>

		<section role="listNews" class="posts">
			
		<?php
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
			?>
			<div class="post-container">
			<?php
				get_template_part( 'template-parts/content-theme', get_post_format() );

				// If comments are open or we have at least one comment, load up the comment template.
				// if ( comments_open() || get_comments_number() ) :
				// 	comments_template();
				// endif;
				?>
			</div>
			<?php
			} // End of the loop.
			?>				
		</section>
		<?php 
			the_posts_navigation();
			// next_posts_link( 'Older Entries', $the_query->max_num_pages );
			// previous_posts_link( 'Next Entries &raquo;' ); 
			/* Restore original Post Data */
			wp_reset_postdata();
			?>
		<?php
		} else {
			get_template_part( 'template-parts/content', 'none' );
		} 
		?>
	
	</main><!-- #main -->
	<?php 
	// get_sidebar();
	?>
</div><!-- #content-area -->
<?php
get_footer();
?>

