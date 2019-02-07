<?php
/*
Template Name: page produits
*/
?>


<?php
/**
 * template pour les pages des CES (affiche thématiques et produits liés)
 *
 *
 * @package aeris
 */

get_header(); 

while ( have_posts() ) : the_post();

	get_template_part( 'template-parts/header-content', 'page' );
?>

	<div id="content-area" class="wrapper sidebar">
		<main id="main" class="site-main" role="main">
    <article id="post-<?php the_ID(); ?>">

    <div class="wrapper-content">
	<?php
		the_content();

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'theme-aeris' ),
			'after'  => '</div>',
		) );
	?>

	</div><!-- wrapper-content -->
</article>


		</main>

<aside>
      <?php 
      if (pll_current_language() == "en") {
         echo "<h1>Related products</h1>\n";
      }
      else {
         echo "<h1>Produits associés</h1>\n";
      }

			get_template_part( 'template-parts/content', 'produits' );

      if (pll_current_language() == "en") {
         echo "<h1>Related SECs</h1>\n";
      }
      else {
         echo "<h1>CES associés</h1>\n";
      }
      get_template_part( 'template-parts/content', 'ces' );

      // If comments are open or we have at least one comment, load up the comment template.
      if ( comments_open() || get_comments_number() ) :
        comments_template();
      endif;

			
			?>
</aside>


	</div><!-- #content-area -->


<?php
endwhile; // End of the loop.
// get_sidebar();
get_footer();
