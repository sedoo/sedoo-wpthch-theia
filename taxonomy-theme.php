<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package aeris
 */

get_header(); 

get_template_part( 'template-parts/header-content', 'archive' );
// recup le slug du term courant
$term = get_queried_object();
?>
	<div id="content-area" class="wrapper archives">
		<main id="main" class="site-main" role="main">

            <?php
            /**
             * WP_Query pour lister les posts ET les pages
             */
            $args = array(
                'post_type' => array('post', 'page', 'ces', 'products'),
                'post_status'           => array( 'publish' ),
                'posts_per_page'        => 10,            // -1 pour liste sans limite
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

